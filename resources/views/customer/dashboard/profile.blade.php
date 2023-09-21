{{-- resources/view/customer/dashboard/profile.blade.php --}}

@extends($profile . '.dashboard.base')

@section('title', __('Profil'))

@section('main-content')
    <div class="card bg-transparent border rounded-3">
        <div class="card-header bg-transparent border-bottom">
            <h5 class="card-header-title mb-0">
                {{ __('Mettre à jour mes informations personnelles') }}
            </h5>
            <p class="text-danger mb-0">
                {{ __('Les champs avec * sont obligatoires.') }}
            </p>
        </div>
        <div class="card-body">
            <form class="row g-4" action="{{ route($profile . '.profile.update') }}" method="post"
                  enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="profile" value="{{ old('profile', 'CUSTOMER') }}">

                <!-- Profile picture (Avatar) -->
                <div class="col-12 justify-content-center align-items-center">
                    <label class="form-label" for="profile-avatar">
                        {{ __('Avatar') }}
                        {{--<span class="text-danger">*</span>--}}
                    </label>
                    <div class="d-flex align-items-center">
                        <label class="position-relative me-4" for="profile-avatar"
                               title="{{ __('Ajouter une image') }}">
                            <!-- Avatar place holder -->
                            @if(!@empty(auth('customer')->user()->avatar))
                                <!-- Avatar -->
                                <div class="avatar avatar-xl me-3">
                                    <img class="avatar-img border border-3 rounded-circle shadow"
                                         src="{{ '/storage/' . auth('customer')->user()->avatar }}"
                                         alt="{{ __('Avatar de l\'utilisateur') }}">
                                </div>
                            @elseif(!@empty(auth('customer')->user()->first_name) && !@empty(auth('customer')->user()->last_name))
                                <div class="avatar avatar-md flex-shrink-0 me-3">
                                    <div class="avatar-img rounded-circle bg-orange bg-opacity-10">
                                        <span
                                            class="text-orange position-absolute top-50 start-50 translate-middle fw-bold">
                                            {{ substr(auth('customer')->user()->first_name ?? 'A', 0, 1) }}
                                            {{ substr(auth('customer')->user()->last_name ?? 'E', 0, 1) }}
                                        </span>
                                    </div>
                                </div>
                            @else
                                <div
                                    class="icon-lg bg-orange rounded-circle bg-opacity-10 text-orange rounded-2 flex-shrink-0">
                                    <i class="fas fa-user fs-4"></i>
                                </div>
                            @endif
                            <!-- Remove btn
                            <button type="button" class="uploadremove">
                                <i class="bi bi-x text-white"></i>
                            </button>
                            -->
                        </label>
                        <!-- Upload button -->
                        <label class="btn btn-primary-soft mb-0" for="profile-avatar">
                            {{ !is_null(auth('customer')->user()->avatar) ? __('Changer') : __('Ajouter une photo') }}
                        </label>
                        <input name="image" id="profile-avatar" class="form-control d-none" type="file">
                    </div>
                </div>

                {{--<!-- User type -->--}}
                {{--<div class="col-md-12">--}}
                {{--    <label class="form-label" for="profile-user-type">--}}
                {{--        {{ __('Type de personne') }}--}}
                {{--        <span class="text-danger">*</span>--}}
                {{--    </label>--}}
                {{--    @php--}}
                {{--        $user_types = collect([--}}
                {{--             ['value' => 'CORPORATION', 'name' => __('Personne Morale (Entreprise)') ],--}}
                {{--             ['value' => 'PHYSICAL-PERSON', 'name' => __('Personne Physique (Individu)') ],--}}
                {{--        ]);--}}
                {{--    @endphp--}}
                {{--    <select name="user_type" id="profile-user-type"--}}
                {{--            class="form-select profile-user-type @error('user_type'){{'is-invalid'}}@enderror">--}}
                {{--        <option value="">{{ __('Veuillez sélectionner le type de personne') }}</option>--}}
                {{--        @foreach($user_types as $user_type)--}}
                {{--            <option--}}
                {{--                value="{{$user_type['value']}}" @selected($user_type['value'] == old('user_type', auth('customer')->user()->user_type))>--}}
                {{--                {{ $user_type['name'] }}--}}
                {{--            </option>--}}
                {{--        @endforeach--}}
                {{--    </select>--}}
                {{--    @error('user_type')--}}
                {{--    <div class="form-text text-danger">--}}
                {{--        {{ $message }}--}}
                {{--    </div>--}}
                {{--    @enderror--}}
                {{--</div>--}}

                <!-- User type -->
                <div class="col-md-12">
                    <label class="form-label" for="profile-user-type">
                        {{ __('Type de personne') }}
                        <span class="text-danger">*</span>
                    </label>
                    <select name="user_type" id="profile-user-type"
                            class="form-select profile-user-type @error('user_type'){{'is-invalid'}}@enderror">
                        <option value="">
                            {{ __('Veuillez sélectionner le type de personne') }}
                        </option>
                        <option
                            value="PHYSICAL-PERSON" @selected('PHYSICAL-PERSON' == old('user_type', auth('customer')->user()->user_type))>
                            {{ __('Personne Physique (Individu)') }}
                        </option>
                        <option
                            value="CORPORATION" @selected('CORPORATION' == old('user_type', auth('customer')->user()->user_type))>
                            {{ __('Personne Morale (Entreprise)') }}
                        </option>
                    </select>
                    @error('user_type')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- First name -->
                <div class="col-md-6">
                    <label class="form-label" for="profile-first-name">
                        {{ __('Prénoms') }}
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="first_name" id="profile-first-name"
                           class="form-control profile-first-name @error('first_name'){{'is-invalid'}}@enderror"
                           value="{{ old('first_name', auth('customer')->user()->first_name) }}"
                           placeholder="{{ __('Veuillez entrer vos prénoms') }}">
                    @error('first_name')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Last name -->
                <div class="col-md-6">
                    <label class="form-label" for="profile-last-name">
                        {{ __('Nom') }}
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="last_name" id="profile-last-name"
                           class="form-control profile-last-name @error('last_name'){{'is-invalid'}}@enderror"
                           value="{{ old('last_name', auth('customer')->user()->last_name) }}"
                           placeholder="{{ __('Veuillez entrer votre nom de famille') }}">
                    @error('last_name')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Name (Entreprise) -->
                <div class="col-md-6">
                    <label class="form-label" for="profile-name">
                        {{ __('Nom de l\'entreprise') }}
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="name" id="profile-name"
                           class="form-control profile-name @error('name'){{'is-invalid'}}@enderror"
                           value="{{ old('name', auth('customer')->user()->name) }}"
                           placeholder="{{ __('Veuillez entrer le nom de votre entreprise') }}">
                    @error('name')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- IFU (Entreprise) -->
                <div class="col-md-6">
                    <label class="form-label" for="profile-ifu">
                        {{ __('Numéro d\'Identifiant Fiscal Unique (IFU)') }}
                        {{--<span class="text-danger">*</span>--}}
                    </label>
                    <input type="text" name="ifu" id="profile-ifu"
                           class="form-control profile-ifu @error('ifu'){{'is-invalid'}}@enderror"
                           value="{{ old('ifu', auth('customer')->user()->ifu) }}"
                           placeholder="{{ __('Veuillez entrer le numéro d\'Identifiant Fiscal Unique de votre entreprise') }}">
                    @error('ifu')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Phone number -->
                <div class="col-md-6">
                    <label class="form-label" for="profile-phone-number">
                        {{ __('Numéro de téléphone') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-phone-alt"></i>
                        </span>
                        <input type="number" name="phone_number" id="profile-phone-number"
                               class="form-control profile-phone-number @error('phone_number'){{'is-invalid'}}@enderror"
                               value="{{ old('phone_number', auth('customer')->user()->phone_number) }}"
                               placeholder="{{ __('Veuillez entrer votre nom d\'utilisateur') }}">
                    </div>
                    @error('phone_number')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <label class="form-label" for="profile-email">
                        {{ __('Adresse e-mail') }}
                        <span class="text-danger">*</span>
                    </label>
                    <input class="form-control profile-email @error('email'){{'is-invalid'}}@enderror" type="email"
                           name="email" id="profile-email" value="{{ auth('customer')->user()->email }}"
                           placeholder="{{ __('Veuillez entrer votre adresse e-mail') }}" disabled>
                    @error('email')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Username -->
                <div class="col-md-6">
                    <label class="form-label" for="profile-user-name">
                        {{ __('Nom d\'utilisateur') }}
                        {{--<span class="text-danger">*</span>--}}
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">
                            {{ __('@') }}
                            {{--{{ '@' . \Illuminate\Support\Str::slug(config('app.name')) . '-' }}--}}
                        </span>
                        <input type="text" name="user_name" id="profile-user-name"
                               class="form-control profile-user-name @error('user_name'){{'is-invalid'}}@enderror"
                               value="{{ old('user_name', auth('customer')->user()->user_name) }}"
                               placeholder="{{ __('Veuillez entrer votre nom d\'utilisateur') }}">
                    </div>
                    @error('user_name')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Registration number -->
                <div class="col-md-6">
                    <label class="form-label" for="profile-registration-number">
                        {{ __('Numéro d\'enregistrement') }}
                        <span class="text-danger">*</span>
                    </label>
                    <input
                        class="form-control profile-registration-number @error('registration_number'){{'is-invalid'}}@enderror"
                        type="text"
                        name="registration_number" id="profile-registration-number" value="{{ auth('customer')->user()->registration_number }}"
                        placeholder="{{ __('Veuillez entrer votre numéro d\'enregistrement') }}" disabled>
                    @error('registration_number')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- City -->
                <div class="col-md-6">
                    <label class="form-label" for="profile-city">
                        {{ __('Ville de résidence') }}
                        {{--<span class="text-danger">*</span>--}}
                    </label>
                    <input class="form-control profile-city @error('city'){{'is-invalid'}}@enderror" type="city"
                           name="city" id="profile-city" value="{{ old('city', auth('customer')->user()->city) }}"
                           placeholder="{{ __('Veuillez entrer votre ville de résidence') }}">
                    @error('city')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Country -->
                <div class="col-md-6">
                    <label class="form-label" for="profile-country">
                        {{ __('Pays de résidence') }}
                        {{--<span class="text-danger">*</span>--}}
                    </label>
                    @if(!@empty($countries))
                        <select name="country_id" id="profile-country"
                                class="form-select profile-country @error('country_id'){{'is-invalid'}}@enderror">
                            <option value="">{{ __('Veuillez sélectionner votre pays de résidence') }}</option>
                            @foreach($countries as $country)
                                <option
                                    @selected($country->id == old('country_id', auth('customer')->user()->country_id)) value="{{ $country->id }}">
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    @else
                        <p>
                            {{ __('Aucun pays n\'est disponible pour le moment.') }}
                        </p>
                    @endif

                    @error('country_id')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Birthday -->
                <div class="col-md-6">
                    <label class="form-label" for="profile-birthday">
                        {{ __('Date de naissance') }}
                        {{--<span class="text-danger">*</span>--}}
                    </label>
                    <input type="date" name="birthday" id="profile-birthday"
                           class="form-control profile-birthday @error('birthday'){{'is-invalid'}}@enderror"
                           value="{{ old('birthday', auth('customer')->user()->birthday) }}"
                           placeholder="{{ __('Veuillez entrer votre date de naissance') }}">
                    @error('birthday')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Gender -->
                <div class="col-md-6">
                    <label class="form-label" for="profile-gender">
                        {{ __('Sexe') }}
                        {{--<span class="text-danger">*</span>--}}
                    </label>
                    <select name="gender" id="profile-gender"
                            class="form-select profile-gender @error('gender'){{'is-invalid'}}@enderror">
                        <option value="">{{ __('Veuillez sélectionner votre sexe') }}</option>
                        <option
                            @selected('FEMALE' == old('gender', auth('customer')->user()->gender)) value="FEMALE">{{ __('Féminin') }}</option>
                        <option
                            @selected('MALE' == old('gender', auth('customer')->user()->gender)) value="MALE">{{ __('Masculin') }}</option>
                        <option
                            @selected('OTHER' == old('gender', auth('customer')->user()->gender)) value="OTHER">{{ __('Autre') }}</option>
                    </select>
                    @error('gender')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Address -->
                <div class="col-md-12">
                    <label class="form-label" for="profile-address">
                        {{ __('Adresse physique') }}
                        {{--<span class="text-danger">*</span>--}}
                    </label>
                    <input type="text" name="address" id="profile-address"
                           class="form-control profile-address @error('address'){{'is-invalid'}}@enderror"
                           value="{{ old('address', auth('customer')->user()->address) }}"
                           placeholder="{{ __('Veuillez entrer votre adresse physique (Assez le plus précis possible)') }}">
                    @error('address')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Website -->
                <div class="col-md-12">
                    <label class="form-label" for="profile-website">
                        {{ __('Site web') }}
                        {{--<span class="text-danger">*</span>--}}
                    </label>
                    <input type="text" name="website" id="profile-website"
                           class="form-control profile-website @error('website'){{'is-invalid'}}@enderror"
                           value="{{ old('website', auth('customer')->user()->website) }}"
                           placeholder="{{ __('Veuillez entrer le lien de votre site web') }}">
                    @error('website')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="col-md-12">
                    <label class="form-label" for="profile-update-password">
                        {{ __('Mot de passe') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <input
                            class="form-control profile-update-password @error('password'){{'is-invalid'}}@enderror"
                            id="profile-update-password" name="password" type="password"
                            placeholder="{{ __('Veuillez entrer votre mot de passe') }}">
                        <span class="input-group-text p-0 bg-transparent">
                            <i class="far fa-eye cursor-pointer p-2 w-40px aec-hide-show-password"></i>
                        </span>
                    </div>
                    <div class="rounded mt-1" id="psw-strength"></div>
                    @error('password')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Save button -->
                <div class="d-sm-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mb-0">
                        {{ __('Mise à jour') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="row g-4 mt-3">
        <!-- Email change START -->
        <div class="col-lg-6">
            <div class="card bg-transparent border rounded-3">
                <!-- Card header -->
                <div class="card-header bg-transparent border-bottom">
                    <h5 class="card-header-title mb-0">
                        {{ __('Mettre à jour mon adresse e-mail') }}
                    </h5>
                    <p class="text-danger mb-0">
                        {{ __('Les champs avec * sont obligatoires.') }}
                    </p>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <p>
                        {{ __('Votre adresse e-mail actuelle est : ') }}
                        <span class="text-primary">
                            {{ auth('customer')->user()->email }}
                        </span>
                    </p>

                    <form action="{{ route($profile . '.profile.update-email') }}" method="post">
                        @csrf

                        <input type="hidden" name="profile" value="{{ old('profile', 'CUSTOMER') }}">

                        <div class="mb-3">
                            <label class="form-label" for="profile-update-email">
                                {{ __('Nouvelle adresse e-mail') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input class="form-control profile-update-email @error('email'){{'is-invalid'}}@enderror"
                                   type="email" name="email" id="profile-update-email"
                                   value="{{ old('email', auth('customer')->user()->email) }}"
                                   placeholder="{{ __('Veuillez entrer votre nouvelle adresse e-mail') }}">
                            @error('email')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="profile-change-email-update-password">
                                {{ __('Mot de passe') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input
                                    class="form-control profile-update-password @error('password'){{'is-invalid'}}@enderror"
                                    id="profile-change-email-update-password" name="password" type="password"
                                    placeholder="{{ __('Veuillez entrer votre mot de passe') }}">
                                <span class="input-group-text p-0 bg-transparent">
                                    <i class="far fa-eye cursor-pointer p-2 w-40px aec-hide-show-password"></i>
                                </span>
                            </div>
                            <div class="rounded mt-1" id="psw-strength"></div>
                            @error('password')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary mb-0">
                                {{ __('Mettre à jour l\'e-mail') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Email change end -->

        <!-- Password change START -->
        <div class="col-lg-6">
            <div class="card border bg-transparent rounded-3">
                <!-- Card header -->
                <div class="card-header bg-transparent border-bottom">
                    <h5 class="card-header-title mb-0">
                        {{ __('Mettre à jour mon mot de passe') }}
                    </h5>
                    <p class="text-danger mb-0">
                        {{ __('Les champs avec * sont obligatoires.') }}
                    </p>
                </div>
                <!-- Card body START -->
                <div class="card-body">
                    <form action="{{ route($profile . '.profile.update-password') }}" method="post">
                        @csrf

                        <input type="hidden" name="profile" value="{{ old('profile', 'CUSTOMER') }}">

                        <!-- Current password -->
                        <div class="mb-3">
                            <label class="form-label" for="profile-update-password-current-password">
                                {{ __('Mot de passe actuel') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input
                                    class="form-control profile-update-password-current-password @error('current_password'){{'is-invalid'}}@enderror"
                                    id="profile-update-password-current-password" name="current_password"
                                    type="password"
                                    placeholder="{{ __('Veuillez entrer votre mot de passe actuel') }}">
                                <span class="input-group-text p-0 bg-transparent">
                                    <i class="far fa-eye cursor-pointer p-2 w-40px aec-hide-show-password"></i>
                                </span>
                            </div>
                            @error('current_password')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- New password -->
                        <div class="mb-3">
                            <label class="form-label" for="profile-update-password-new-password">
                                {{ __('Nouveau mot de passe') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input
                                    class="form-control profile-update-password-new-password @error('new_password'){{'is-invalid'}}@enderror"
                                    id="profile-update-password-new-password" name="new_password" type="password"
                                    placeholder="{{ __('Veuillez entrer votre nouveau mot de passe') }}">
                                <span class="input-group-text p-0 bg-transparent">
                                    <i class="far fa-eye cursor-pointer p-2 w-40px aec-hide-show-password"></i>
                                </span>
                            </div>
                            <div class="rounded mt-1" id="psw-strength"></div>
                            @error('new_password')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Confirm password -->
                        <div>
                            <label class="form-label" for="profile-update-password-new-password-confirmation">
                                {{ __('Confirmez nouveau mot de passe') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input
                                    class="form-control profile-update-password-new-password-confirmation @error('new_password_confirmation'){{'is-invalid'}}@enderror"
                                    id="profile-update-password-new-password-confirmation"
                                    name="new_password_confirmation"
                                    type="password"
                                    placeholder="{{ __('Veuillez entrer retaper votre nouveau mot de passe') }}">
                                <span class="input-group-text p-0 bg-transparent">
                                    <i class="far fa-eye cursor-pointer p-2 w-40px aec-hide-show-password"></i>
                                </span>
                            </div>
                            @error('new_password_confirmation')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Button -->
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary mb-0">
                                {{ __('Changer mon mot de passe') }}
                            </button>
                        </div>
                    </form>
                </div>
                <!-- Card body END -->
            </div>
        </div>
        <!-- Password change end -->

        <!-- Disable account START -->
        <div class="col-lg-6">
            <div class="card border bg-transparent rounded-3 mb-0">
                <!-- Card header -->
                <div class="card-header bg-transparent border-bottom">
                    <h5 class="card-header-title mb-0">
                        {{ __('Désactiver mon compte') }}
                    </h5>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <a href="#" class="btn btn-danger mb-0" data-bs-toggle="modal"
                       data-bs-target="#disable-account-modal">
                        {{ __('Désactiver mon compte') }}
                    </a>
                </div>
            </div>
        </div>
        <!-- Disable account end -->

        <!-- Delete account START -->
        <div class="col-lg-6">
            <div class="card border bg-transparent rounded-3 mb-0">
                <!-- Card header -->
                <div class="card-header bg-transparent border-bottom">
                    <h5 class="card-header-title mb-0">
                        {{ __('Supprimer mon compte') }}
                    </h5>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <a href="#" class="btn btn-danger mb-0" data-bs-toggle="modal"
                       data-bs-target="#delete-account-modal">
                        {{ __('Supprimer mon compte') }}
                    </a>
                </div>
            </div>
        </div>
        <!-- Delete account end -->
    </div>

    <!-- Popup modal for disable START -->
    <div class="modal fade" id="disable-account-modal" tabindex="-1" aria-labelledby="disable-account-modal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route($profile . '.profile.disable-account') }}" method="post">
                <div class="modal-content">
                    <!-- Modal header -->
                    <div class="modal-header">
                        <h5 class="card-header-title mb-0">
                            {{ __('Désactiver mon compte') }}
                        </h5>
                        <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal"
                                aria-label="Close">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <h6>
                            {{ __('Avant que vous ne désactivez votre compte...') }}
                        </h6>
                        <p>
                            {{ __('Êtes vous sure de vouloir désactivez votre compte ?') }}
                        </p>
                        @csrf
                        <input type="hidden" name="profile" value="{{ old('profile', 'CUSTOMER') }}">
                        <div class="form-check form-check-md my-4">
                            <input class="form-check-input" name="disable_account_confirmation" type="checkbox"
                                   value="1"
                                   id="disable-account-check" @checked(old('disable_account_confirmation'))>
                            <label class="form-check-label" for="disable-account-check">
                                {{ __('Oui, je souhaite désactivez mon compte.') }}
                                <span class="text-danger">*</span>
                            </label>
                            @error('disable_account_confirmation')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="disable-account-password">
                                {{ __('Mot de passe') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input
                                    class="form-control disable-account-password @error('password'){{'is-invalid'}}@enderror"
                                    id="disable-account-password" name="password" type="password"
                                    placeholder="{{ __('Veuillez entrer votre mot de passe') }}">
                                <span class="input-group-text p-0 bg-transparent">
                                    <i class="far fa-eye cursor-pointer p-2 w-40px aec-hide-show-password"></i>
                                </span>
                            </div>
                            <div class="rounded mt-1" id="psw-strength"></div>
                            @error('password')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-success-soft mb-2 mb-sm-0" data-bs-dismiss="modal">
                            {{ __('Garder mon compte') }}
                        </button>
                        <button type="submit" class="btn btn-danger mb-0">
                            {{ __('Désactiver mon compte') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Popup modal for disable END -->

    <!-- Popup modal for delete START -->
    <div class="modal fade" id="delete-account-modal" tabindex="-1" aria-labelledby="delete-account-modal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route($profile . '.profile.delete-account') }}" method="post">
                <div class="modal-content">
                    <!-- Modal header -->
                    <div class="modal-header">
                        <h5 class="card-header-title mb-0">
                            {{ __('Supprimer mon compte') }}
                        </h5>
                        <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal"
                                aria-label="Close">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <h6>
                            {{ __('Avant que vous ne supprimez votre compte...') }}
                        </h6>
                        <p>
                            {{ __('Êtes vous sure de vouloir supprimer votre compte ?') }}
                        </p>
                        @csrf
                        <input type="hidden" name="profile" value="{{ old('profile', 'CUSTOMER') }}">
                        <div class="form-check form-check-md my-4">
                            <input class="form-check-input" name="delete_account_confirmation" type="checkbox"
                                   value="1"
                                   id="delete-account-check" @checked(old('delete_account_confirmation'))>
                            <label class="form-check-label" for="delete-account-check">
                                {{ __('Oui, je souhaite supprimer mon compte.') }}
                                <span class="text-danger">*</span>
                            </label>
                            @error('delete_account_confirmation')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="delete-account-password">
                                {{ __('Mot de passe') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input
                                    class="form-control delete-account-password @error('password'){{'is-invalid'}}@enderror"
                                    id="delete-account-password" name="password" type="password"
                                    placeholder="{{ __('Veuillez entrer votre mot de passe') }}">
                                <span class="input-group-text p-0 bg-transparent">
                                    <i class="far fa-eye cursor-pointer p-2 w-40px aec-hide-show-password"></i>
                                </span>
                            </div>
                            <div class="rounded mt-1" id="psw-strength"></div>
                            @error('password')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-success-soft mb-2 mb-sm-0" data-bs-dismiss="modal">
                            {{ __('Garder mon compte') }}
                        </button>
                        <button type="submit" class="btn btn-danger mb-0">
                            {{ __('Supprimer mon compte') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Popup modal for delete END -->

@endsection

{{--@section('template-functions')--}}
{{--@endsection--}}
