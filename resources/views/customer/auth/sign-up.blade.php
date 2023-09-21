{{-- resources/view/customer/auth/sign-up.blade.php --}}

@extends($profile . '.auth.base')

@section('title', __('Inscription'))

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
        <img src="{{ asset('assets/images/element/03.svg') }}" class="h-40px mb-2" alt="{{ __('Illustration de l\'icon de la page d\'inscription.') }}">
        {{ __('Chèr(e) client(e)') }}
    </h1>
@endsection

@section('base.auth.form-title', __('Ouvrez votre compte sur :app-name.', ['app-name' => config('app.name')]))
@section('base.auth.form-sub-title', __('Ravi de vous voir, Chèr(e) client(e) ! Veuillez vous inscrire avec votre compte.'))

@section('base.auth.form')

    <!-- Form START -->

    <p class="text-danger mb-4">
        {{ __('Les champs avec * sont obligatoires.') }}
    </p>

    <form action="{{ route($profile . '.auth.sign-up') }}" method="post" class="" novalidate>

        @csrf

        <input type="hidden" name="profile" value="{{ old('profile', 'CUSTOMER') }}">

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="form-label">
                {{ __('Adresse e-mail') }}
                <span class="text-danger">*</span>
            </label>
            <div class="input-group input-group-lg">
                <span class="input-group-text bg-light rounded-start text-secondary px-3">
                    <i class="bi bi-envelope-fill"></i>
                </span>
                <input type="email" name="email"
                       class="form-control bg-light rounded-end ps-1 email @error('email'){{'is-invalid'}}@enderror"
                       id="email"
                       placeholder="{{ __('Veuillez entrer votre adresse e-mail') }}" value="{{ old('email') }}"
                       required>
            </div>
            @error('email')
            <div class="form-text text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Check box : Has default password -->
        <div class="mb-4">
            <div class="form-check">
                <input type="checkbox"
                       class="form-check-input create-user-has-default-password @error('has_default_password'){{'is-invalid'}}@enderror"
                       id="create-user-has-default-password"
                       name="has_default_password"
                       value="1" @checked(old('has_default_password', 0) == 1)>
                <label class="form-check-label" for="create-user-has-default-password">
                    {{ __('Définir un mot de passe par défaut.') }}
                    {{--<span class="text-danger">*</span>--}}
                </label>
            </div>
            @error('has_default_password')
            <div class="form-text text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="create-user-password" class="form-label">
                {{ __('Mot de passe') }}
                <span class="text-danger">*</span>
            </label>
            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light rounded-start text-secondary px-3">
                                    <i class="fas fa-lock"></i>
                                </span>
                <input type="password" name="password"
                       class="form-control bg-light ps-1 create-user-password @error('password'){{'is-invalid'}}@enderror"
                       id="create-user-password"
                       placeholder="{{ __('Veuillez entrer votre mot de passe') }}"
                       value="{{ old('password') }}" required>

                <span class="input-group-text bg-light rounded-end text-secondary px-3">
                                    <i class="far fa-eye cursor-pointer aec-hide-show-password"></i>
                                </span>
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
            <label for="create-user-password-confirmation" class="form-label">
                {{ __('Confirmer le mot de passe') }}
                <span class="text-danger">*</span>
            </label>
            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light rounded-start text-secondary px-3">
                                    <i class="fas fa-lock"></i>
                                </span>
                <input type="password" name="password_confirmation"
                       class="form-control bg-light ps-1 create-user-password-confirmation @error('password_confirmation'){{'is-invalid'}}@enderror"
                       id="create-user-password-confirmation"
                       placeholder="{{ __('Veuillez confirmer le mot de passe') }}"
                       value="{{ old('password_confirmation') }}" required>


                <span class="input-group-text bg-light rounded-end text-secondary px-3">
                                    <i class="far fa-eye cursor-pointer aec-hide-show-password"></i>
                                </span>
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

        <!-- Check box -->
        <div class="mb-4">
            <div class="form-check">
                <input type="checkbox"
                       class="form-check-input terms-condition @error('terms_condition'){{'is-invalid'}}@enderror"
                       id="terms-condition"
                       name="terms_condition"
                       value="1" @checked(old('terms_condition') == 1)>
                <label class="form-check-label" for="terms-condition">
                    {{ __('En vous inscrivant, vous acceptez les ') }}
                    <a href="#">{{ __('termes et conditions d\'utilisation') }}</a>
                    <span class="text-danger">*</span>
                </label>
            </div>
            @error('terms_condition')
            <div class="form-text text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
        <!-- Button -->
        <div class="align-items-center mt-0">
            <div class="d-grid">
                <button class="btn btn-primary mb-0" type="submit">
                    {{ __('Inscription') }}
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
    <div class="mt-2 text-center">
        <span>
            {{ __('Problème de validation de compte ?') }}
            <a href="{{ route($profile . '.auth.send-email-validate-account') }}">
                {{ __('Obtenir un mail de validation de compte') }}
            </a>
        </span>
    </div>
@endsection
