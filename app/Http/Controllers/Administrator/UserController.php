<?php

namespace App\Http\Controllers\Administrator;

use App\Events\UserAccountEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\User\UserFilterRequest;
use App\Http\Requests\Auth\SignUpRequest;
use App\Models\PasswordResetTokens;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UserController extends Controller
{

    /**
     * User controller construct.
     */
    public function __construct()
    {
        parent::__construct('administrator');
    }

    /**
     * User list controller.
     *
     * @param UserFilterRequest $request The user filter request.
     * @return View The package type list page view.
     */
    public function index(UserFilterRequest $request): View
    {
        $userFilterData = $request->validated();

        $users = User::whereIn('profile', ['CUSTOMER', 'ADMINISTRATOR'])
            ->with(['country'])
            ->when($userFilterData['profile'] ?? '', function ($query) use ($userFilterData) {
                return $query->where('profile', $userFilterData['profile']);
            })
            ->when($userFilterData['status'] ?? '', function ($query) use ($userFilterData) {
                if ('ENABLE' == $userFilterData['status']) {
                    return $query->whereNotNull('activated_at');
                } else if ('DISABLE' == $userFilterData['status']) {
                    return $query->whereNull('activated_at');
                } else if ('TRASHED' == $userFilterData['status']) {
                    return $query->onlyTrashed();
                } else {
                    return $query;
                }
            })
            ->when($userFilterData['first_last_name'] ?? '', function ($query) use ($userFilterData) {
                return $query->where('first_name', 'LIKE', '%' . $userFilterData['first_last_name'] . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $userFilterData['first_last_name'] . '%');
            })
            ->when($userFilterData['email'] ?? '', function ($query) use ($userFilterData) {
                return $query->where('email', 'LIKE', '%' . $userFilterData['email'] . '%');
            })
            ->when($userFilterData['phone_number'] ?? '', function ($query) use ($userFilterData) {
                return $query->where('phone_number', 'LIKE', '%' . $userFilterData['phone_number'] . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view($this->profile . '.dashboard.user.index', ['users' => $users, 'input' => $request]);
    }

    /**
     * Create user form controller.
     *
     * @return View The user status form view.
     */
    public function createForm(): View
    {
        $user = new User();
        return view($this->profile . '.dashboard.user.form', ['user' => $user]);
    }

    /**
     * Create user traitement controller.
     *
     * @param SignUpRequest $request The sign-up form request.
     * @return RedirectResponse The redirect response.
     */
    public function create(SignUpRequest $request): RedirectResponse
    {
        $userData = $request->validated();
        $userData['has_default_password'] = $request->boolean('has_default_password');

        $defaultPassword = '';
        if ($userData['has_default_password']) {
            $userData['password'] = $defaultPassword = substr(md5(uniqid()), 0, 8);
            $userData['has_default_password'] = 1;
        }
        $userData['password'] = Hash::make($userData['password']);
        $userData['registration_number'] = uniqid('registration-');
        $user = User::create($userData);

        $token = '';

        if ($userData['profile'] == 'CUSTOMER') {
            try {
                $token = Str::random(64);
                PasswordResetTokens::create(['email' => $request->validated('email'), 'profile' => $request->validated('profile'), 'token' => $token, 'type' => 'VALIDATE-ACCOUNT']);
            } catch (QueryException) {
                $passwordResetToken = PasswordResetTokens::where('email', $request->validated('email'))->where('profile', $request->validated('profile'))->where('type', 'VALIDATE-ACCOUNT')->first();
                $token = $passwordResetToken->token;
            }
        }

        // Notification création de compte.
        $dataSignUp['title'] = __('Création de compte sur :app-name', ['app-name' => config('app.name')]);
        $dataSignUp['message'] = __('Création de compte sur :app-name', ['app-name' => config('app.name')]);
        $dataSignUp['view'] = 'mails.auth.sign-up';
        $dataSignUp['token'] = $token;
        event(new UserAccountEvent($user, $dataSignUp));

        // Notification mot de passe par défaut.
        if ($user->has_default_password) {
            $dataSignUpDefaultPassword['title'] = __('Mot de passe par défaut de votre compte sur :app-name', ['app-name' => config('app.name')]);
            $dataSignUpDefaultPassword['message'] = __('Mot de passe par défaut de votre compte sur :app-name', ['app-name' => config('app.name')]);
            $dataSignUpDefaultPassword['view'] = 'mails.auth.sign-up-default-password';
            $dataSignUpDefaultPassword['default_password'] = $defaultPassword;
            event(new UserAccountEvent($user, $dataSignUpDefaultPassword));
        }

        return redirect()->route($this->profile . '.user.index')->with(['success' => 'Nouvel utilisateur enregistré avec succès.']);
    }

    /**
     * Enable or disable user traitement controller.
     *
     * @param User $user The user.
     * @param string $new_status The user new status.
     * @return RedirectResponse The redirect response.
     */
    public function enableDisable(User $user, string $new_status): RedirectResponse
    {

        if ($new_status != 'disable' && $new_status != 'enable') {
            return back()->withErrors(['Une action inattendue bloque le processus.']);
        }

        $old_status = (is_null($user->activated_at)) ? 'disable' : 'enable';

        if ($new_status != $old_status && 'disable' == $new_status) {
            $user->activated_at = NULL;
            $user->update();
            $dataEnableDisable['title'] = __('Désactivation de votre compte sur :app-name', ['app-name' => config('app.name')]);
            $dataEnableDisable['message'] = __('Désactivation de votre compte sur :app-name', ['app-name' => config('app.name')]);
        } else if ($new_status != $old_status && 'enable' == $new_status) {
            $user->activated_at = now();
            $user->update();
            $dataEnableDisable['title'] = __('Activation de votre compte sur :app-name', ['app-name' => config('app.name')]);
            $dataEnableDisable['message'] = __('Activation de votre compte sur :app-name', ['app-name' => config('app.name')]);
        }

        // Notification activation ou désactivation du compte.
        $dataEnableDisable['view'] = 'mails.user.enable-disable';
        $dataEnableDisable['new_status'] = $new_status;
        event(new UserAccountEvent($user, $dataEnableDisable));

        $toDo = ($new_status == 'disable') ? 'désactivé' : 'activé';

        return redirect()->route($this->profile . '.user.index')->with(['success' => __('L\'utilisateur :user a été :to-do avec succès.', ['user' => $user->last_name . ' ' . $user->first_name, 'to-do' => $toDo])]);
    }

    /**
     * Validate user account traitement controller.
     *
     * @param User $user The user.
     * @return RedirectResponse The redirect response.
     */
    public function validateAccount(User $user): RedirectResponse
    {
        $user->verified_at = now();
        $user->update();

        // Notification validation de compte.
        $dataSignUpDefaultPassword['title'] = __('Validation de votre compte sur :app-name', ['app-name' => config('app.name')]);
        $dataSignUpDefaultPassword['message'] = __('Validation de votre compte sur :app-name', ['app-name' => config('app.name')]);
        $dataSignUpDefaultPassword['view'] = 'mails.user.validate';
        event(new UserAccountEvent($user, $dataSignUpDefaultPassword));

        return redirect()->route($this->profile . '.user.index')->with(['success' => __('Le compte de l\'utilisateur :user a été validé avec succès.', ['user' => $user->last_name . ' ' . $user->first_name])]);
    }

    /**
     * Delete user traitement controller.
     *
     * @param User $user The user.
     * @return RedirectResponse The redirect response.
     */
    public function delete(User $user): RedirectResponse
    {
        $user->delete();

        // Notification suppression de compte.
        $dataSignUpDefaultPassword['title'] = __('Suppression de votre compte sur :app-name', ['app-name' => config('app.name')]);
        $dataSignUpDefaultPassword['message'] = __('Suppression de votre compte sur :app-name', ['app-name' => config('app.name')]);
        $dataSignUpDefaultPassword['view'] = 'mails.user.delete';
        event(new UserAccountEvent($user, $dataSignUpDefaultPassword));

        return redirect()->route($this->profile . '.user.index')->with(['success' => __('L\'utilisateur :user supprimé avec succès.', ['user' => $user->last_name . ' ' . $user->first_name])]);
    }

}
