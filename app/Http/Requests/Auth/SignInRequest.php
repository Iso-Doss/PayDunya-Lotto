<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class SignInRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {

        return [
            'profile' => ['required', 'string', 'max:255', 'in:CUSTOMER,AGENT,ADMINISTRATOR'],
            'email' => ['required', 'string', 'email:strict', 'max:255'],
            'password' => ['required', 'string', 'max:255', Rules\Password::defaults()]
        ];
    }


    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        $guard = 'customer';
        if ('AGENT' == $this->validated('profile')) {
            $guard = 'agent';
        } else if ('ADMINISTRATOR' == $this->validated('profile')) {
            $guard = 'administrator';
        }

        $this->ensureIsNotRateLimited();

        $credentials = $this->only('email', 'password', 'profile');
        //$credentials['activated_at'] = "!NULL";
        //$credentials['verified_at'] = "!NULL";

        $user = User::whereEmail($this->validated('email'))
            ->whereProfile($this->validated('profile'))
            ->whereNotNull("activated_at")
            ->whereNotNull("verified_at")
            ->first();

        if (!$user) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        if (!Auth::guard($guard)->attempt($credentials, $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')) . '|' . Str::lower($this->input('profile')) . '|' . $this->ip());
    }
}
