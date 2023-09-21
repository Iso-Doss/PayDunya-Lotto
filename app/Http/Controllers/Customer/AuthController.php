<?php

namespace App\Http\Controllers\Customer;

use App\Events\UserAccountEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SendEmailValidateAccountRequest;
use App\Http\Requests\Auth\SignUpRequest;
use App\Models\PasswordResetTokens;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthController extends Controller
{

    /**
     * Auth controller construct.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Sign up form controller.
     *
     * @return View Sign up form view.
     */
    public function signUpForm(): View
    {
        return view($this->profile . '.auth.sign-up');
    }

    /**
     * Sign up traitement controller.
     *
     * @param SignUpRequest $request The sign-up request.
     * @return RedirectResponse|View The redirect response
     */
    public function signUp(SignUpRequest $request): RedirectResponse|View
    {
        $userData = $request->validated();
        $userData['profile'] = ('CUSTOMER' != $request->validated('profile')) ? 'CUSTOMER' : $request->validated('profile');
        $userData['registration_number'] = uniqid('registration-');
        $userData['has_default_password'] = $request->boolean('has_default_password');

        $defaultPassword = '';
        if ($userData['has_default_password']) {
            $userData['password'] = $defaultPassword = substr(md5(uniqid()), 0, 8);
            $userData['has_default_password'] = 1;
        }
        $userData['password'] = Hash::make($userData['password']);

        $user = User::create($userData);

        try {
            $token = Str::random(64);
            PasswordResetTokens::create(['email' => $request->validated('email'), 'profile' => $request->validated('profile'), 'token' => $token, 'type' => 'VALIDATE-ACCOUNT']);
        } catch (QueryException) {
            $passwordResetToken = PasswordResetTokens::where('email', $request->validated('email'))->where('profile', $request->validated('profile'))->where('type', 'VALIDATE-ACCOUNT')->first();
            $token = $passwordResetToken->token;
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

        return view($this->profile . '.auth.sign-up-done', ['success' => __('Inscription effectué avec succès. Veuillez consulter vos mails afin de valider votre compte. N\'oubliez pas de regardez dans vos spams..')]);
    }

    public function sendEmailValidateAccountForm(): View
    {
        return view($this->profile . '.auth.send-email-validate-account');
    }

    public function sendEmailValidateAccount(SendEmailValidateAccountRequest $request): RedirectResponse
    {
        $user = User::whereEmail($request->validated('email'))->whereProfile($request->validated('profile'))->first();

        if (!is_null($user->activated_at) && !is_null($user->verified_at)) {
            return back()->withInput($request->validated())
                ->with(['error' => trans('Votre compte est déjà activé. Veuillez vous connecter')]);
        }

        $passwordResetToken = PasswordResetTokens::where('email', $request->validated('email'))->where('profile', $request->validated('profile'))->where('type', 'VALIDATE-ACCOUNT')->first();

        if (!is_null($passwordResetToken)) {
            $token = $passwordResetToken->token;
        } else {
            $token = Str::random(64);
            PasswordResetTokens::create(['email' => $request->validated('email'), 'profile' => $request->validated('profile'), 'token' => $token, 'type' => 'VALIDATE-ACCOUNT']);
        }

        // Notification création de compte.
        $dataSignUp['title'] = __('Création de compte sur :app-name', ['app-name' => config('app.name')]);
        $dataSignUp['message'] = __('Création de compte sur :app-name', ['app-name' => config('app.name')]);
        $dataSignUp['view'] = 'mails.auth.sign-up';
        $dataSignUp['token'] = $token;
        event(new UserAccountEvent($user, $dataSignUp));

        return redirect()->route($this->profile . '.auth.send-email-validate-account')->with(['success' => __('Un lien de validation de compte vous été envoyé. Veuillez consulter vos mails afin de valider votre compte. N\'oubliez pas de regardez dans vos spams..')]);
    }

}
