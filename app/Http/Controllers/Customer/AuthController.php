<?php

namespace App\Http\Controllers\Customer;

use App\Events\UserAccountEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\SendEmailValidateAccountRequest;
use App\Http\Requests\Auth\SignInRequest;
use App\Http\Requests\Auth\SignUpRequest;
use App\Models\PasswordResetTokens;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
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

    /**
     * Validate account traitement controller.
     */
    public function validateAccount(string $email, string $token)
    {
        $validator = Validator::make(['email' => $email, 'token' => $token, 'type' => 'VALIDATE-ACCOUNT'], [
            'email' => ['required', 'string', 'email:strict', 'max:255', 'exists:password_reset_tokens,email', 'exists:users,email'],
            'token' => ['required', 'string', 'max:255', 'exists:password_reset_tokens,token'],
            'type' => ['required', 'string', 'max:255']
        ]);

        if ($validator->fails()) {
            return view($this->profile . '.auth.validate-account', ['email' => $email, 'token' => $token])->withErrors($validator->errors());
        }

        $user = User::whereEmail($email)->whereProfile('CUSTOMER')->first();

        $validateAccountToken = PasswordResetTokens::where('email', $email)->where('profile', 'CUSTOMER')->where('token', $token);

        if (is_null($validateAccountToken->first()) || $validateAccountToken->first()->email != $user->email) {
            return back()->withErrors(['token' => __('Le champ :attributes sélectionné / renseigné est invalide.', ['attributes' => 'token'])]);
        }

        $user->verified_at = now();
        $user->activated_at = now();
        $user->email_verified_at = now();
        $user->update();

        $validateAccountToken->delete();

        // Notification de validation de compte.
        $dataValidateAccount['title'] = __('Validation de compte sur :app-name', ['app-name' => config('app.name')]);
        $dataValidateAccount['message'] = __('Validation de compte sur :app-name', ['app-name' => config('app.name')]);
        $dataValidateAccount['view'] = 'mails.auth.validate-account';
        event(new UserAccountEvent($user, $dataValidateAccount));

        return view($this->profile . '.auth.validate-account', ['success' => __('Votre compte a été validé. Vous pouvez vous connecter.')]);
    }

    /**
     * Sign in form controller.
     *
     * @return View Sign in form view.
     */
    public function signInForm(): View
    {
        return view($this->profile . '.auth.sign-in');
    }

    /**
     * Sign in traitement controller.
     *
     * @param SignInRequest $request The sign in request.
     * @return RedirectResponse The redirect response.
     * @throws ValidationException The validation exception.
     */
    public function signIn(SignInRequest $request): RedirectResponse
    {
        $request->authenticate();

        // Notification d'une nouvelle connexion.
        $user = User::whereEmail($request->validated('email'))->whereProfile($request->validated('profile'))->first();
        $dataSignIn['title'] = __('Nouvelle connexion sur :app-name', ['app-name' => config('app.name')]);
        $dataSignIn['message'] = __('Nouvelle connexion sur :app-name', ['app-name' => config('app.name')]);
        $dataSignIn['view'] = 'mails.auth.sign-in';
        event(new UserAccountEvent($user, $dataSignIn));

        return redirect()->intended(route($this->profile . '.dashboard'))->with(['success' => 'Bienvenue cher(e) client(e). Ravi de vous voir !']);
    }

    /**
     * Forgot password form view.
     *
     * @return View Forgot password form view.
     */
    public function forgotPasswordForm(): View
    {
        return view($this->profile . '.auth.forgot-password');
    }

    /**
     * @param ForgotPasswordRequest $request The forgot password request.
     * @return RedirectResponse The redirect response.
     */
    public function forgotPassword(ForgotPasswordRequest $request): RedirectResponse
    {
        $user = User::whereEmail($request->validated('email'))->whereProfile($request->validated('profile'))->first();

        if (is_null($user)) {
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => trans('passwords.user')]);
        }

        $oldToken = PasswordResetTokens::where('email', $request->validated('email'))->where('profile', $request->validated('profile'))->where('type', 'FORGOT-PASSWORD')->first();

        if (!is_null($oldToken)) {
            $token = $oldToken->token;
        } else {
            $token = Str::random(64);
            PasswordResetTokens::create(['email' => $request->validated('email'), 'profile' => $request->validated('profile'), 'token' => $token, 'type' => 'FORGOT-PASSWORD']);
        }

        // Notification de mot de passe oublié.
        $dataForgotPassword['title'] = __('Mot de passe oublier sur :app-name', ['app-name' => config('app.name')]);
        $dataForgotPassword['message'] = __('Mot de passe oublier sur :app-name', ['app-name' => config('app.name')]);
        $dataForgotPassword['view'] = 'mails.auth.forgot-password';
        $dataForgotPassword['token'] = $token;
        event(new UserAccountEvent($user, $dataForgotPassword));

        return back()->withInput($request->only('email'))->with('success', __('passwords.sent'));
    }

}
