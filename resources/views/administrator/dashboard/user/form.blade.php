{{-- resources/view/administrator/dashboard/user/form.blade.php --}}

@extends($profile . '.dashboard.base')

@section('sub-title', __('Ajouter un utilisateur'))

@section('main-content')
    <div class="page-content-wrapper border">
        <!-- Card header START -->
        <div class="card-header bg-transparent border-bottom">
            <div class="row mb-3">
                <div class="col-12">
                    <h1 class="h3 mb-2 mb-sm-0">
                        {{ __('Ajouter un utilisateur') }}
                    </h1>

                    <p class="text-danger mb-0">
                        {{ __('Les champs avec * sont obligatoires.') }}
                    </p>
                </div>
            </div>
        </div>
        <!-- Card header END -->

        <div class="card-body">
            <!-- Search and select START -->
            <div class="row g-3 align-items-center justify-content-between mt-1 mb-4">
                <!-- Content -->
                <div class="col-md-12">
                    <form class="row g-4" action="{{ route($profile . '.user.create') }}" method="post">

                        @csrf

                        <!-- Type d'utilisateur -->
                        <div class="col-md-12">
                            <label for="create-user-profile" class="form-label">
                                {{ __('Quel type ou profil d\'utilisateur souhaitez vous ajouter ?') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div>
                                <!-- Radio -->
                                <div class="form-check radio-bg-light me-4">
                                    <input class="form-check-input" type="radio" name="profile"
                                           id="create-user-profile-customer"
                                           value="CUSTOMER" @checked(old('profile', 'CUSTOMER') == 'CUSTOMER')>
                                    <label class="form-check-label" for="create-user-profile-customer">
                                        {{ __('Je souhaite ajouter un utilisateur de type ou profile') }}
                                        <i class="fw-bold fst-normal">{{ __('Client') }}</i>
                                    </label>
                                </div>
                                <!-- Radio -->
                                <div class="form-check radio-bg-light me-4">
                                    <input class="form-check-input" type="radio" name="profile"
                                           id="create-user-profile-administrateur"
                                           value="ADMINISTRATOR" @checked(old('profile') == 'ADMINISTRATOR')>
                                    <label class="form-check-label" for="create-user-profile-administrateur">
                                        {{ __('Je souhaite ajouter un utilisateur de type ou profile') }}
                                        <i class="fw-bold fst-normal">{{ __('Administrateur') }}</i>
                                    </label>
                                </div>
                            </div>
                            @error('profile')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Mail Address -->
                        <div class="col-md-12">
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
                                       placeholder="{{ __('Veuillez entrer votre adresse e-mail') }}"
                                       value="{{ old('email') }}"
                                       required>
                            </div>
                            @error('email')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Check box : Has default password -->
                        <div class="col-md-12">
                            <div class="form-check">
                                <input type="checkbox"
                                       class="form-check-input create-user-has-default-password @error('has_default_password'){{'is-invalid'}}@enderror"
                                       id="create-user-has-default-password"
                                       name="has_default_password"
                                       value="1" @checked(old('has_default_password', 1) == 1)>
                                <label class="form-check-label" for="create-user-has-default-password">
                                    {{ __('Définir un mot de passe par défaut.') }}
                                    <span class="text-danger">*</span>
                                </label>
                            </div>
                            @error('has_default_password')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="col-md-12">
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

                                <span class="input-group-text bg-light rounded-end text-secondary px-3 aec-hide-show-password aec-cursor-pointer">
                                    <i class="far fa-eye"></i>
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
                        <div class="col-md-12">
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

                                <span class="input-group-text bg-light rounded-end text-secondary px-3 aec-hide-show-password aec-cursor-pointer">
                                    <i class="far fa-eye"></i>
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
                        <div class="col-md-12">
                            <div class="form-check">
                                <input type="checkbox"
                                       class="form-check-input create-user-terms-condition @error('terms_condition'){{'is-invalid'}}@enderror"
                                       id="create-user-terms-condition"
                                       name="terms_condition"
                                       value="1" @checked(old('terms_condition', 1) == 1)>
                                <label class="form-check-label" for="create-user-terms-condition">
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

                        <!-- Save button -->
                        <div class="d-sm-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mb-0">
                                {{ __('Enregistrer') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('template-functions')

@endsection
