<?php

namespace App\Http\Controllers\Customer;

use App\Events\UserAccountEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\DeleteAccountRequest;
use App\Http\Requests\Profile\DisableAccountRequest;
use App\Http\Requests\Profile\UpdateEmailProfileRequest;
use App\Http\Requests\Profile\UpdatePasswordProfileRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Models\country;
use App\Models\PasswordResetTokens;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProfileController extends Controller
{

    /**
     * Profile controller construct.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Profile page controller.
     *
     * @return View The profile view.
     */
    public function index(): View
    {
        $countries = Country::whereNotNull('activated_at')->get();
        return view($this->profile . '.dashboard.profile', ['countries' => $countries]);
    }

    /**
     * Update profile informations traitement controller.
     *
     * @param UpdateProfileRequest $request The update profile request.
     * @return RedirectResponse The redirect response.
     */
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        if (!Hash::check($request->validated('password'), Auth::user()->getAuthPassword())) {
            return back()->withErrors(['password' => 'Le champ mot de passe actuel est incorrect.'])->with(['error' => 'Le champ mot de passe actuel est incorrect. Veuillez réessayer.']);
        }

        $userData = $request->validated();

        $user = Auth::user();
        $user->user_type = $userData['user_type'];
        if ('PHYSICAL-PERSON' == $userData['user_type']) {
            $user->first_name = $userData['first_name'];
            $user->last_name = $userData['last_name'];
        } else if ('CORPORATION' == $userData['user_type']) {
            $user->name = $userData['name'];
            $user->ifu = $userData['ifu'];
        }
        if (!empty($userData['image'])) {
            if (!empty($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $upload = $this->uploadImage($request, 'user/' . Auth::user()->email . '/' . Auth::user()->profile . '/profile');
            $user->avatar = (isset($upload) && !empty($upload)) ? $upload : null;
        }
        $user->user_name = $userData['user_name'];
        $user->phone_number = $userData['phone_number'];
        $user->city = $userData['city'];
        $user->birthday = $userData['birthday'];
        $user->gender = $userData['gender'];
        $user->address = $userData['address'];
        $user->website = $userData['website'];
        $user->country_id = $userData['country_id'];

        $user->update();

        // Notification de la mise à jour des informations personnelles (Mise à jour du profil).
        $dataResetPassword['title'] = __('Mise a jour des informations  personnelles sur :app-name', ['app-name' => config('app.name')]);
        $dataResetPassword['message'] = __('Mise a jour des informations  personnelles sur :app-name', ['app-name' => config('app.name')]);
        $dataResetPassword['view'] = 'mails.profile.update-profile';
        event(new UserAccountEvent($user, $dataResetPassword));

        return redirect()->route($this->profile . '.profile.index')->with(['success' => 'Mise a jour des informations personnelles effectuées avec succès.']);
    }

    /**
     * Update email profile traitement controller.
     *
     * @param UpdateEmailProfileRequest $request The update email profile request.
     * @return RedirectResponse The redirect response.
     */
    public function updateEmail(UpdateEmailProfileRequest $request): RedirectResponse
    {
        if (Auth::user()->email == $request->input('email')) {
            return redirect()->route($this->profile . '.profile.index')->with(['success' => 'La nouvelle adresse e-mail et l\'ancienne sont identique. Une mise a jour de l\'adresse e-mail n\'est pas nécessaire.']);
        }

        if (!Hash::check($request->validated('password'), Auth::user()->getAuthPassword())) {
            return back()->withErrors(['password' => 'Le champ mot de passe actuel est incorrect.'])->with(['error' => 'Le champ mot de passe actuel est incorrect. Veuillez réessayer.']);
        }

        $token = Str::random(64);

        try {
            PasswordResetTokens::create(['email' => Auth::user()->email, 'new_email' => $request->input('email'), 'profile' => $request->input('profile') ?? 'CUSTOMER', 'token' => $token, 'type' => 'UPDATE-EMAIL']);
        } catch (QueryException) {
            $passwordResetToken = PasswordResetTokens::where('email', Auth::user()->email)->where('new_email', $request->input('email'))->where('profile', $request->input('profile') ?? 'CUSTOMER')->where('type', 'UPDATE-EMAIL')->first();
            if (!is_null($passwordResetToken)) {
                $token = $passwordResetToken->token;
            } else {
                return redirect()->route($this->profile . '.profile.index')->with(['error' => 'Un mail de demande de changement d\'adresse email vous a déjà été envoyé. Veuillez consulter vos mails.']);
            }
        }

        // Notification de demande de mise a jour de l'adresse e-mail.
        $dataUpdateProfileEmail['title'] = __('Demande de mise a jour de l\'adresse e-mail sur :app-name', ['app-name' => config('app.name')]);
        $dataUpdateProfileEmail['message'] = __('Demande de mise a jour de l\'adresse e-mail sur :app-name', ['app-name' => config('app.name')]);
        $dataUpdateProfileEmail['view'] = 'mails.profile.update-email';
        $dataUpdateProfileEmail['email'] = $request->input('email');
        $dataUpdateProfileEmail['old_email'] = Auth::user()->email;
        $dataUpdateProfileEmail['token'] = $token;
        event(new UserAccountEvent(Auth::user(), $dataUpdateProfileEmail));

        return back()->withInput($request->only('email'))->with('success', __('Une demande de changement d\'adresse email a été envoyé a la nouvelle adresse e-mail. Veuillez consultez les mails afin de valider la demande. Merci.'));
    }

    /**
     * Validate the new email profile traitement controller.
     *
     * @param string $email The old email.
     * @param string $new_email The new email.
     * @param string $token The token.
     * @return View|RedirectResponse The view or redirect response.
     */
    public function validateUpdateEmail(string $email, string $new_email, string $token): View|RedirectResponse
    {
        $validator = Validator::make(['email' => $email, 'new_email' => $new_email, 'token' => $token, 'type' => 'UPDATE-EMAIL'], [
            'email' => ['required', 'string', 'email:strict', 'max:255', 'exists:password_reset_tokens,email', 'exists:users,email'],
            'new_email' => ['required', 'string', 'email:strict', 'max:255', 'exists:password_reset_tokens,new_email'],
            'token' => ['required', 'string', 'max:255', 'exists:password_reset_tokens,token'],
            'type' => ['required', 'string', 'max:255']
        ]);

        if ($validator->fails()) {
            return view($this->profile . '.dashboard.profile', ['email' => $email, 'new_email' => $new_email, 'token' => $token])->withErrors($validator->errors());
        }

        $user = User::whereEmail($email)->whereProfile('CUSTOMER')->first();

        $validateAccountToken = PasswordResetTokens::where('email', $email)->where('profile', 'CUSTOMER')->where('token', $token);

        if (is_null($validateAccountToken->first()) || $validateAccountToken->first()->email != $user->email) {
            return back()->withErrors(['token' => __('Le champ :attributes sélectionné / renseigné est invalide.', ['attributes' => 'token'])]);
        }

        $user->email = $new_email;
        $user->email_verified_at = now();
        $user->update();

        $validateAccountToken->delete();

        // Notification de mise à jour de l'adresse email.
        $dataValidateUpdateProfileEmail['title'] = __('Mise a jour de l\'adresse e-mail sur :app-name', ['app-name' => config('app.name')]);
        $dataValidateUpdateProfileEmail['message'] = __('Mise a jour de l\'adresse e-mail sur :app-name', ['app-name' => config('app.name')]);
        $dataValidateUpdateProfileEmail['view'] = 'mails.profile.validate-update-email';
        event(new UserAccountEvent($user, $dataValidateUpdateProfileEmail));

        return redirect()->route($this->profile . '.profile.index')->with(['success' => __('Votre demande de changement d\'adresse email a été validé.')]);
    }

    /**
     * Update password profile traitement controller.
     *
     * @param UpdatePasswordProfileRequest $request The update password profile request.
     * @return RedirectResponse The redirect response.
     */
    public function updatePassword(UpdatePasswordProfileRequest $request): RedirectResponse
    {
        if (!Hash::check($request->validated('current_password'), Auth::user()->getAuthPassword())) {
            return back()->withErrors(['current_password' => 'Le champ mot de passe actuel est incorrect.'])->with(['error' => 'Le champ mot de passe actuel est incorrect. Veuillez réessayer.']);
        }
        $user = Auth::user();
        $user->password = Hash::make($request->validated('new_password'));
        $user->update();

        // Notification de mise à jour du mot de passe.
        $dataUpdatePassword['title'] = __('Mise a jour du mot de passe sur :app-name', ['app-name' => config('app.name')]);
        $dataUpdatePassword['message'] = __('Mise a jour du mot de passe sur :app-name', ['app-name' => config('app.name')]);
        $dataUpdatePassword['view'] = 'mails.profile.update-password';
        event(new UserAccountEvent($user, $dataUpdatePassword));

        $authController = new AuthController();
        return $authController->signOut();
    }

    /**
     * Disable account traitement controller.
     *
     * @param DisableAccountRequest $request The disable account request.
     * @return RedirectResponse The redirect response.
     */
    public function disableAccount(DisableAccountRequest $request): RedirectResponse
    {
        if (!Hash::check($request->validated('password'), Auth::user()->getAuthPassword())) {
            return back()->withErrors(['password' => 'Le champ mot de passe actuel est incorrect.'])->with(['error' => 'Le champ mot de passe actuel est incorrect. Veuillez réessayer.']);
        }

        $user = Auth::user();
        $user->activated_at = NULL;
        $user->update();

        // Notification de la désactivation du compte.
        $dataDisableAccount['title'] = __('Désactivation de votre compte sur :app-name', ['app-name' => config('app.name')]);
        $dataDisableAccount['message'] = __('Désactivation de votre compte sur :app-name', ['app-name' => config('app.name')]);
        $dataDisableAccount['view'] = 'mails.profile.disable-account';
        event(new UserAccountEvent($user, $dataDisableAccount));

        $authController = new AuthController();
        return $authController->signOut();
    }

    /**
     * Delete account traitement controller.
     *
     * @param DeleteAccountRequest $request The delete account request.
     * @return RedirectResponse The redirect response.
     */
    public function deleteAccount(DeleteAccountRequest $request): RedirectResponse
    {
        if (!Hash::check($request->validated('password'), Auth::user()->getAuthPassword())) {
            return back()->withErrors(['password' => 'Le champ mot de passe actuel est incorrect.'])->with(['error' => 'Le champ mot de passe actuel est incorrect. Veuillez réessayer.']);
        }

        $user = Auth::user();
        $user->delete();

        // Notification de la suppression du compte.
        $dataDeleteAccount['title'] = __('Suppression de votre compte sur :app-name', ['app-name' => config('app.name')]);
        $dataDeleteAccount['message'] = __('Suppression de votre compte sur :app-name', ['app-name' => config('app.name')]);
        $dataDeleteAccount['view'] = 'mails.profile.delete-account';
        event(new UserAccountEvent($user, $dataDeleteAccount));

        $authController = new AuthController();
        return $authController->signOut();
    }

}
