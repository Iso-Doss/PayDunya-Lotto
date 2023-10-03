{{-- resources/view/customer/auth/forgot-password.blade.php --}}

@extends($profile . '.auth.base')

@section('sub-title', __('Mot de passe oublié'))

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

@section('base.auth.form-title', __('Mot de passe oublié ?'))
@section('base.auth.form-sub-title', __('Pour recevoir un nouveau mot de passe, saisissez votre adresse électronique ci-dessous.'))

@section('base.auth.form')
    <!-- Form START -->

    <p class="text-danger mb-4">
        {{ __('Les champs avec * sont obligatoires.') }}
    </p>

    <form action="{{ route($profile . '.auth.forgot-password') }}" method="post" class="" novalidate>

        @csrf

        <input type="hidden" name="profile" value="{{ old('profile', 'ADMINISTRATOR') }}">

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
                <input type="email" name="email" id="email"
                       class="form-control bg-light rounded-end ps-1 email @error('email'){{'is-invalid'}}@enderror"
                       placeholder="{{ __('Veuillez entrer votre adresse e-mail') }}" value="{{ old('email') }}"
                       required>
            </div>
            @error('email')
            <div class="form-text text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Button -->
        <div class="align-items-center mt-0">
            <div class="d-grid">
                <button class="btn btn-primary mb-0" type="submit">
                    {{ __('Mot de passe oublié') }}
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
