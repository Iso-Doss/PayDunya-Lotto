{{-- resources/view/customer/auth/reset-password.blade.php --}}

@extends($profile . '.auth.base')

@section('title', __('Réinitialisation de mot de passe'))

{{--@section('base.auth.title', __('Bienvenu chèr(e) cleint(e) sur :app-name.', ['app-name' =>config('app.name')]))--}}
{{--@section('base.auth.sub-title', __('Entreprise de fret et de cargo, spécialisée dans le transport de marchandise depuis la Chine vers Cotonou et dans l\'aide à l\'achat en ligne.'))--}}

{{--@section('base.auth.banner', asset('assets/images/element/02.svg'))--}}

{{--@section('base.auth.community-image-1', asset('assets/images/avatar/01.jpg'))--}}
{{--@section('base.auth.community-image-2', asset('assets/images/avatar/02.jpg'))--}}
{{--@section('base.auth.community-image-3', asset('assets/images/avatar/03.jpg'))--}}
{{--@section('base.auth.community-image-4', asset('assets/images/avatar/04.jpg'))--}}
{{--@section('base.auth.community-message', __('4k+ utilisateurs nous ont rejoints, maintenant c\'est à votre tour.'))--}}

@section('base.auth.form-title-icon')
    <h1 class="fs-2">
        <span class="mb-0 fs-1"> {{ __('🤔') }} </span>
        {{ __('Chèr(e) client(e)') }}
    </h1>
@endsection

@section('base.auth.form-title', __('Réinitialisation de mot de passe'))
@section('base.auth.form-sub-title', __('Veuillez fournis les informations ci-dessous afn de réinitialisation votre mot de passe.'))

@section('base.auth.form')
    <!-- Form START -->

    <p class="text-danger mb-4">
        {{ __('Les champs avec * sont obligatoires.') }}
    </p>

    <form action="{{ route($profile . '.auth.reset-password', ['email' => $email, 'token' => $token]) }}" method="post"
          class="" novalidate>

        @csrf

        <input type="hidden" name="profile" value="{{ old('profile', 'CUSTOMER') }}">

        <input type="hidden" name="email" value="{{ old('email', $email) }}">

        <input type="hidden" name="token" value="{{ old('token', $token) }}">

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="form-label">
                {{ __('Mot de passe') }}
                <span class="text-danger">*</span>
            </label>
            <div class="input-group input-group-lg">
                <span class="input-group-text bg-light rounded-start text-secondary px-3">
                    <i class="fas fa-lock"></i>
                </span>
                <input type="password" name="password"
                       class="form-control bg-light rounded-end ps-1 password @error('password'){{'is-invalid'}}@enderror"
                       class="form-control bg-light rounded-end ps-1 password @error('password'){{'is-invalid'}}@enderror"
                       id="password" placeholder="{{ __('Veuillez entrer votre mot de passe') }}"
                       value="{{ old('password') }}" required>
            </div>
            <div id="passwordHelpBlock" class="form-text">
                {{ __('Votre mot de passe doit comporter au moins 8 caractères') }}
            </div>
            @error('password')
            <div class="form-text text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Password confirmation-->
        <div class="mb-4">
            <label for="password-confirmation" class="form-label">
                {{ __('Confirmer le mot de passe') }}
                <span class="text-danger">*</span>
            </label>
            <div class="input-group input-group-lg">
                <span class="input-group-text bg-light rounded-start text-secondary px-3">
                    <i class="fas fa-lock"></i>
                </span>
                <input type="password" name="password_confirmation"
                       class="form-control bg-light rounded-end ps-1 password-confirmation @error('password_confirmation'){{'is-invalid'}}@enderror"
                       id="password-confirmation" placeholder="{{ __('Veuillez confirmer le mot de passe') }}"
                       value="{{ old('password_confirmation') }}" required>
            </div>
            <div id="passwordHelpBlock" class="form-text">
                {{ __('Votre mot de passe doit comporter au moins 8 caractères') }}
            </div>
            @error('password_confirmation')
            <div class="form-text text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Button -->
        <div class="align-items-center mt-0">
            <div class="d-grid">
                <button class="btn btn-primary mb-0" type="submit">
                    {{ __('Réinitialiser le mot de passe') }}
                </button>
            </div>
        </div>
    </form>
    <!-- Form END -->

    <!-- Social buttons and divider -->
    {{--<div class="row">--}}
    {{--    <!-- Divider with text -->--}}
    {{--    <div class="position-relative my-4">--}}
    {{--        <hr>--}}
    {{--        <p class="small position-absolute top-50 start-50 translate-middle bg-body px-5">--}}
    {{--            {{ __('Ou') }}--}}
    {{--        </p>--}}
    {{--    </div>--}}

    {{--    <!-- Social btn -->--}}
    {{--    <div class="col-xxl-6 d-grid">--}}
    {{--        <a href="#" class="btn bg-google mb-2 mb-xxl-0">--}}
    {{--            <i class="fab fa-fw fa-google text-white me-2"></i>--}}
    {{--            {{ __('Se connecter avec Google') }}--}}
    {{--        </a>--}}
    {{--    </div>--}}
    {{--    <!-- Social btn -->--}}
    {{--    <div class="col-xxl-6 d-grid">--}}
    {{--        <a href="#" class="btn bg-facebook mb-0">--}}
    {{--            <i class="fab fa-fw fa-facebook-f me-2"></i>--}}
    {{--            {{ __('Se connecter avec Facebook') }}--}}
    {{--        </a>--}}
    {{--    </div>--}}
    {{--</div>--}}

    <!-- Sign in link -->
    <div class="mt-4 text-center">
        <span>
            {{ __('Vous avez déjà un compte ?') }}
            <a href="{{ route($profile . '.auth.sign-in') }}">
                {{ __('Connectez-vous ici') }}
            </a>
        </span>
    </div>
@endsection
