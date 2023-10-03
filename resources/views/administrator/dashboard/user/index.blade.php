{{-- resources/view/administrator/dashboard/user/index.blade.php --}}

@extends($profile . '.dashboard.base')

@section('sub-title', __('Utilisateurs'))

@section('main-content')

    <div class="page-content-wrapper border">
        <!-- Card header START -->
        <div class="card-header bg-transparent border-bottom">
            <div class="row mb-3">
                <div class="col-12 d-sm-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-2 mb-sm-0">
                        {{ __('Utilisateurs') }}
                    </h1>
                    <a href="{{ route($profile . '.user.create') }}" class="btn btn-sm btn-success mb-0">
                        {{ __('Ajouter un utilisateur') }}
                    </a>
                </div>
            </div>
        </div>
        <!-- Card header END -->

        <!-- Card body START -->
        <div class="card-body">
            <!-- Search and select START -->
            <div class="row g-3 align-items-center justify-content-between mt-1 mb-4">
                <!-- Content -->
                <div class="col-md-12">
                    <form class="rounded position-relative" action="{{ route($profile . '.user.index') }}">
                        @csrf

                        <div class="row g-3">
                            <!-- Nom ou le prénom -->
                            <div class="col-12">
                                <label for="user-first-last-name" class="form-label">
                                    {{ __('Nom ou prénoms : ') }}
                                </label>
                                <input type="text" name="first_last_name" id="user-first-last-name"
                                       class="form-control me-1 mt-2 user-first-last-name @error('first_last_name'){{'is-invalid'}}@enderror"
                                       placeholder="{{ __('Recherche par le nom de famille ou le prénom de l\'utilisateur') }}"
                                       value="{{ $input['first_last_name'] ?? '' }}">
                            </div>

                            <!-- Profil -->
                            <div class="col-xl-6">
                                <label for="user-profile" class="form-label">
                                    {{ __('Profil : ') }}
                                </label>
                                <select name="profile" id="user-profile"
                                        class="form-select me-1 mt-2 user-profile @error('profile'){{'is-invalid'}}@enderror">
                                    <option value="">
                                        {{ __('Rechercher par le profil de l\'utilisateur') }}
                                    </option>
                                    <option
                                        value="CUSTOMER" @selected(($input['profile'] ?? '') == "CUSTOMER")>
                                        {{ __('Client') }}
                                    </option>
                                    <option
                                        value="ADMINISTRATOR" @selected(($input['profile'] ?? '') == "ADMINISTRATOR")>
                                        {{ __('Administrateur') }}
                                    </option>
                                </select>
                            </div>

                            <!-- Statut -->
                            <div class="col-xl-6">
                                <label for="user-status" class="form-label">
                                    {{ __('Statut : ') }}
                                </label>
                                <select name="status" id="user-status"
                                        class="form-select me-1 mt-2 user-status @error('status'){{'is-invalid'}}@enderror">
                                    <option value="">
                                        {{ __('Rechercher par le statut de l\'utilisateur') }}
                                    </option>
                                    <option
                                        value="ENABLE" @selected(($input['status'] ?? '') == "ENABLE")>
                                        {{ __('Actif') }}
                                    </option>
                                    <option
                                        value="DISABLE" @selected(($input['status'] ?? '') == "DISABLE")>
                                        {{ __('Inactif') }}
                                    </option>
                                    <option
                                        value="TRASHED" @selected(($input['status'] ?? '') == "TRASHED")>
                                        {{ __('Supprimer') }}
                                    </option>
                                </select>
                            </div>

                            <!-- Adresse e-mail -->
                            <div class="col-xl-6">
                                <label for="user-email" class="form-label">
                                    {{ __('Adresse e-mail : ') }}
                                </label>
                                <input type="email" name="email" id="user-email"
                                       class="form-control me-1 mt-2 user-email @error('email'){{'is-invalid'}}@enderror"
                                       placeholder="{{ __('Recherche par l\'adresse email de l\'utilisateur') }}"
                                       value="{{ $input['email'] ?? '' }}">
                            </div>

                            <!-- Numéro de téléphone -->
                            <div class="col-xl-6">
                                <label for="user-phone-number" class="form-label">
                                    {{ __('Numéro de téléphone : ') }}
                                </label>
                                <input type="text" name="phone_number" id="user-phone-number"
                                       class="form-control me-1 mt-2 user-phone-number @error('phone_number'){{'is-invalid'}}@enderror"
                                       placeholder="{{ __('Recherche par le numéro de téléphone de l\'utilisateur') }}"
                                       value="{{ $input['phone_number'] ?? '' }}">
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary mb-0 w-100 rounded me-1 mt-2" type="submit">
                                    <i class="fas fa-search"></i>
                                    {{ __('Rechercher') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Search and select END -->

            @if(!@empty($users->items()))
                <!-- Course list table START -->
                <div class="table-responsive border-0">
                    <table class="table table-dark-gray p-4 mb-0 table-hover">
                        <!-- Table head -->
                        <thead>
                        <tr>
                            <th scope="col" class="border-0 rounded-start">
                                {{ __('Avatar') }}
                            </th>
                            <th scope="col" class="border-0">
                                {{ __('Nom & prénoms') }}
                            </th>
                            <th scope="col" class="border-0">
                                {{ __('Adresse e-mail') }}
                            </th>
                            <th scope="col" class="border-0">
                                {{ __('Numéro de téléphone') }}
                            </th>
                            <th scope="col" class="border-0">
                                {{ __('Pays') }}
                            </th>
                            <th scope="col" class="border-0 rounded-end w-280px">
                                {{ __('Actions') }}
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <!-- Avatar -->
                                <td>
                                    <div
                                        class="btn btn-round mb-0 bg-orange bg-opacity-10 text-orange w-70px h-70px d-flex justify-content-center align-items-center">
                                        @if(!@empty($user->avatar))
                                            <a href="#" role="button" data-bs-toggle="modal"
                                               data-bs-target="#user-avatar-modal-{{$user->id}}">
                                                <img class="" src="{{ '/storage/' . $user->avatar }}"
                                                     alt="{{ __('Avatar de l\'utilisateur') }}">
                                            </a>
                                        @elseif(!@empty($user->first_name) && !@empty($user->last_name))
                                            <span
                                                class="text-orange position-absolute top-50 start-50 translate-middle fw-bold">
                                                {{ substr($user->first_name ?? 'A', 0, 1) }}
                                                {{ substr($user->last_name ?? 'E', 0, 1) }}
                                            </span>
                                        @else
                                            <i class="fas fa-user fs-5"></i>
                                        @endif
                                    </div>
                                </td>

                                <!-- Nom & prénoms -->
                                <td>
                                    <h6>
                                        @if(@empty($user->first_name) && @empty($user->last_name))
                                            {{ __('-') }}
                                        @endif

                                        @if(!@empty($user->first_name))
                                            {{ $user->first_name }}
                                        @endif
                                        @if(!@empty($user->last_name))
                                            {{ $user->last_name }}
                                        @endif

                                        @if(!@empty($user->user_name))
                                            {{ '(@' . $user->user_name . ')' }}
                                        @endif
                                    </h6>
                                    <p class="text-primary mb-0">
                                        {{ __('Profil : ') }}
                                        @if('CUSTOMER' == $user->profile)
                                            {{ __('Client') }}
                                        @elseif('ADMINISTRATOR' == $user->profile)
                                            {{ __('Administrateur') }}
                                        @else
                                            {{ __('-') }}
                                        @endif
                                    </p>
                                    <p class="mb-0">
                                        @if(!is_null($user->deleted_at))
                                            <span class="badge bg-danger bg-opacity-10 text-danger">
                                              {{ __('Compte supprimé') }}
                                            </span>
                                        @else
                                            @if(is_null($user->activated_at))
                                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                                   {{ __('Compte inactif') }}
                                                </span>
                                            @else
                                                @if(is_null($user->verified_at))
                                                    <span class="badge bg-orange bg-opacity-10 text-orange">
                                                    {{ __('Compte activé - non validé') }}
                                                </span>
                                                @else
                                                    <span class="badge bg-success bg-opacity-10 text-success">
                                                    {{ __('Compte activé - validé') }}
                                                </span>
                                                @endif
                                            @endif
                                        @endif
                                    </p>
                                </td>

                                <!-- Adresse e-mail -->
                                <td>
                                    <p>
                                        @if(!@empty($user->email))
                                            <a href="mailto:{{ $user->email }}">
                                                {{ $user->email }}
                                            </a>
                                        @else
                                            {{ __('-') }}
                                        @endif
                                    </p>
                                </td>

                                <!-- Numéro de téléphone -->
                                <td>
                                    <p>
                                        @if(!@empty($user->phone_number))
                                            <a href="tel:{{ $user->phone_number }}">
                                                @if(!@empty($user->country?->phone_code))
                                                    {{ __('( :phone-code )', ['phone-code'=>$user->country?->phone_code]) }}
                                                @endif
                                                {{ $user->phone_number }}
                                            </a>
                                        @else
                                            {{ __('-') }}
                                        @endif
                                    </p>
                                </td>

                                <!-- Pays -->
                                <td>
                                    <p>
                                        @if(!@empty($user->country?->name))
                                            {{ $user->country?->name }}
                                        @else
                                            {{ __('-') }}
                                        @endif
                                    </p>
                                </td>

                                <!-- Table actions -->
                                <td class="h-100">

                                    @if($user->id != auth('administrator')->user()->id)

                                        @if (!is_null($user->deleted_at))
                                            <p class="text-danger">{{ __('Compte supprimé') }}</p>
                                        @else

                                            <a class="btn btn-info-soft btn-round me-1 mb-1 aec-click-modal"
                                               aec-modal-target="user-details-modal-{{$user->id}}"
                                               data-bs-toggle="tooltip" data-bs-placement="top"
                                               aria-label="{{ __('Détails') }}"
                                               data-bs-original-title="{{ __('Détails') }}">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <a href="#" class="btn btn-info-soft btn-round me-1 mb-1 d-none"
                                               data-bs-toggle="modal"
                                               data-bs-target="#user-details-modal-{{$user->id}}">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <a class="btn {{ (is_null($user->activated_at)) ? 'btn-primary-soft' : 'btn-danger-soft' }} btn-round me-1 mb-1 aec-click-modal"
                                               aec-modal-target="user-enable-disable-modal-{{$user->id}}"
                                               data-bs-toggle="tooltip" data-bs-placement="top"
                                               aria-label="{{ (is_null($user->activated_at)) ? __('Activer') : __('Désactiver') }}"
                                               data-bs-original-title="{{ (is_null($user->activated_at)) ? __('Activer') : __('Désactiver') }}">
                                                @if(is_null($user->activated_at))
                                                    <i class=" bi bi-check"></i>
                                                @else
                                                    <i class="bi bi-x"></i>
                                                @endif
                                            </a>

                                            <a href="#"
                                               data-bs-toggle="modal"
                                               data-bs-target="#user-enable-disable-modal-{{$user->id}}"
                                               class="btn {{ (is_null($user->activated_at)) ? 'btn-primary-soft' : 'btn-danger-soft' }} btn-round me-1 mb-1 d-none">
                                                @if(is_null($user->activated_at))
                                                    <i class=" bi bi-check"></i>
                                                @else
                                                    <i class="bi bi-x"></i>
                                                @endif
                                            </a>

                                            @if(!is_null($user->activated_at) && is_null($user->verified_at))

                                                <a class="btn btn-success-soft btn-round me-1 mb-1 aec-click-modal"
                                                   aec-modal-target="user-validate-modal-{{$user->id}}"
                                                   data-bs-toggle="tooltip" data-bs-placement="top"
                                                   aria-label="{{ __('Valider') }}"
                                                   data-bs-original-title="{{  __('Valider') }}">
                                                    <i class=" bi bi-check"></i>
                                                </a>

                                                <a href="#"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#user-validate-modal-{{$user->id}}"
                                                   class="btn btn-primary-soft btn-round me-1 mb-1 d-none">
                                                    <i class=" bi bi-check"></i>
                                                </a>

                                            @endif

                                            <a
                                                class="btn btn-danger-soft btn-round aec-click-modal mb-1"
                                                aec-modal-target="user-delete-modal-{{$user->id}}"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top" aria-label="{{ __('Supprimer') }}"
                                                data-bs-original-title="{{ __('Supprimer') }}">
                                                <i class="bi bi-trash"></i>
                                            </a>

                                            <a href="#"
                                               data-bs-toggle="modal"
                                               data-bs-target="#user-delete-modal-{{$user->id}}"
                                               class="btn btn-danger-soft btn-round mb-1 d-none"
                                               data-bs-toggle="tooltip"
                                               data-bs-placement="top" aria-label="{{ __('Supprimer') }}"
                                               data-bs-original-title="{{ __('Supprimer') }}">
                                                <i class="bi bi-trash"></i>
                                            </a>

                                        @endif
                                    @else
                                        <p class="text-orange">{{ __('Administrateur connecté') }}</p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <!-- Table body END -->
                    </table>
                </div>
                <!-- Course list table END -->

                <!-- Pagination START -->
                {{ $users->links() }}
                <!-- Pagination END -->
            @else
                <p>
                    {{ __('Aucun utilisateur trouvé.') }}
                </p>
            @endif
        </div>
        <!-- Card body START -->
    </div>
    <!-- Main content END -->


    @if(!@empty($users->items()))
        @foreach($users as $user)
            @if($user->avatar)
                <!-- Popup modal for user avatar START -->
                <div class="modal fade" id="user-avatar-modal-{{$user->id}}" tabindex="-1"
                     aria-labelledby="user-avatar-modal-{{$user->id}}"
                     aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="card-header-title mb-0">
                                    {{ __('Photo de profil') }}

                                    @if(@empty($user->first_name) && @empty($user->last_name))
                                        {{ $user->email }}
                                    @endif

                                    @if(!@empty($user->first_name))
                                        {{ $user->first_name }}
                                    @endif
                                    @if(!@empty($user->last_name))
                                        {{ $user->last_name }}
                                    @endif

                                    @if(!@empty($user->user_name))
                                        {{ '(@' . $user->user_name . ')' }}
                                    @endif
                                </h5>
                                <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal"
                                        aria-label="Close">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <img src="{{ "/storage/" . $user->avatar }}"
                                             alt="{{ __('Photo de profil :user-first-name', ['user-first-name' => $user->first_name]) }}"
                                             class="">
                                    </div>
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-success-soft mb-2 mb-sm-0" data-bs-dismiss="modal">
                                    {{ __('Fermer') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Popup modal for user avatar END -->
            @endif

            <!-- Popup modal for user details START -->
            <div class="modal fade" id="user-details-modal-{{$user->id}}" tabindex="-1"
                 aria-labelledby="user-details-modal-{{$user->id}}"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- Modal header -->
                        <div class="modal-header">
                            <h5 class="card-header-title mb-0">
                                {{ __('Détails sur l\'utilisateur') }}

                                @if(@empty($user->first_name) && @empty($user->last_name))
                                    {{ $user->email }}
                                @endif

                                @if(!@empty($user->first_name))
                                    {{ $user->first_name }}
                                @endif
                                @if(!@empty($user->last_name))
                                    {{ $user->last_name }}
                                @endif

                                @if(!@empty($user->user_name))
                                    {{ '(@' . $user->user_name . ')' }}
                                @endif
                            </h5>
                            <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal"
                                    aria-label="Close">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table">

                                        @if(!is_null($user->profile))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Profil : ') }}
                                                </td>
                                                <td>
                                                    <p class="mb-0">
                                                        @if('CUSTOMER' == $user->profile)
                                                            {{ __('Client') }}
                                                        @elseif('ADMINISTRATOR' == $user->profile)
                                                            {{ __('Administrateur') }}
                                                        @else
                                                            {{ __('-') }}
                                                        @endif
                                                    </p>
                                                    <p class="mb-0">
                                                        @if(!is_null($user->deleted_at))
                                                            <span class="badge bg-danger bg-opacity-10 text-danger">
                                                              {{ __('Compte supprimé') }}
                                                            </span>
                                                        @else
                                                            @if(is_null($user->activated_at))
                                                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                                                    {{ __('Compte inactif') }}
                                                                </span>
                                                            @else
                                                                @if(is_null($user->verified_at))
                                                                    <span
                                                                        class="badge bg-orange bg-opacity-10 text-orange">
                                                                        {{ __('Compte activé - non validé') }}
                                                                    </span>
                                                                @else
                                                                    <span
                                                                        class="badge bg-success bg-opacity-10 text-success">
                                                                        {{ __('Compte activé - validé') }}
                                                                    </span>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    </p>
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($user->email))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Adresse e-mail : ') }}
                                                </td>
                                                <td>
                                                    <a href="mailto:{{ $user->email }}">
                                                        {{ $user->email }}
                                                    </a>
                                                    @if(is_null($user->email_verified_at))
                                                        <a class="btn btn-danger-soft btn-round ms-1"
                                                           data-bs-toggle="tooltip" data-bs-placement="top"
                                                           aria-label="{{ __('Adresse email non validée') }}"
                                                           data-bs-original-title="{{ __('Adresse email non validée') }}">
                                                            <i class="bi bi-x"></i>
                                                        </a>
                                                    @else
                                                        <a class="btn btn-info-soft btn-round ms-1"
                                                           data-bs-toggle="tooltip" data-bs-placement="top"
                                                           aria-label="{{ __('Adresse email validée') }}"
                                                           data-bs-original-title="{{ __('Adresse email validée') }}">
                                                            <i class="bi bi-check"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($user->name))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Nom : ') }}
                                                </td>
                                                <td>
                                                    {{ $user->name }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($user->user_type))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Type de personne : ') }}
                                                </td>
                                                <td>
                                                    @if('PHYSICAL-PERSON' == $user->user_type)
                                                        {{ __('Personne physique') }}
                                                    @elseif('CORPORATION' == $user->user_type)
                                                        {{ __('Personne moral') }}
                                                    @else
                                                        {{ __('-') }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($user->last_name))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Nom de famille: ') }}
                                                </td>
                                                <td>
                                                    {{ $user->last_name }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($user->first_name))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Prénoms : ') }}
                                                </td>
                                                <td>
                                                    {{ $user->first_name }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($user->user_name))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Nom d\'utilisateur : ') }}
                                                </td>
                                                <td>
                                                    {{ $user->user_name }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($user->registration_number))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Numéro d\'enregistrement : ') }}
                                                </td>
                                                <td>
                                                    {{ $user->registration_number }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($user->phone_number))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Numéro de téléphone : ') }}
                                                </td>
                                                <td>
                                                    <a href="tel:{{ $user->phone_number }}">
                                                        @if(!@empty($user->country?->phone_code))
                                                            {{ __('( :phone-code )', ['phone-code'=>$user->country?->phone_code]) }}
                                                        @endif
                                                        {{ $user->phone_number }}
                                                    </a>
                                                    @if(is_null($user->phone_number_verified_at))
                                                        <a class="btn btn-danger-soft btn-round ms-1"
                                                           data-bs-toggle="tooltip" data-bs-placement="top"
                                                           aria-label="{{ __('Numéro de téléphone non validé') }}"
                                                           data-bs-original-title="{{ __('Numéro de téléphone non validé') }}">
                                                            <i class="bi bi-x"></i>
                                                        </a>
                                                    @else
                                                        <a class="btn btn-info-soft btn-round ms-1"
                                                           data-bs-toggle="tooltip" data-bs-placement="top"
                                                           aria-label="{{ __('Numéro de téléphone validé') }}"
                                                           data-bs-original-title="{{ __('Numéro de téléphone validé') }}">
                                                            <i class="bi bi-check"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($user->ifu))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Numéro d\'Identifiant Fiscal Unique (IFU) : ') }}
                                                </td>
                                                <td>
                                                    {{ $user->ifu }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($user->gender))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Sexe (Genre) ') }}
                                                </td>
                                                <td>
                                                    @if('FEMALE' == $user->gender)
                                                        {{ __('Féminin') }}
                                                    @elseif('MALE' == $user->gender)
                                                        {{ __('Masculin') }}
                                                    @else
                                                        {{ __('Autre') }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($user->birthday))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Date de naissance : ') }}
                                                </td>
                                                <td>
                                                    {{ $user->birthday }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($user->city))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Ville de résidence : ') }}
                                                </td>
                                                <td>
                                                    {{ $user->city }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($user->country?->name))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Pays de résidence : ') }}
                                                </td>
                                                <td>
                                                    {{ $user->country?->name }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($user->address))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Adresse physique : ') }}
                                                </td>
                                                <td>
                                                    {{ $user->address }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($user->website))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Site web : ') }}
                                                </td>
                                                <td>
                                                    {{ $user->website }}
                                                </td>
                                            </tr>
                                        @endif

                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-success-soft mb-2 mb-sm-0" data-bs-dismiss="modal">
                                {{ __('Fermer') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Popup modal for user details END -->

            <!-- Popup modal for user enable disable START -->
            <div class="modal fade" id="user-enable-disable-modal-{{$user->id}}" tabindex="-1"
                 aria-labelledby="user-enable-disable-modal-{{$user->id}}"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <form
                        action="{{ route($profile . '.user.enable-disable', ['user' => $user, 'new_status' => (is_null($user->activated_at)) ? 'enable' : 'disable']) }}"
                        method="post">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="card-header-title mb-0">
                                    @if(is_null($user->activated_at))
                                        {{ __('Activer l\'utilisateur') }}
                                    @else
                                        {{ __('Désactiver l\'utilisateur') }}
                                    @endif
                                    @if(@empty($user->first_name) && @empty($user->last_name))
                                        {{ $user->email }}
                                    @endif

                                    @if(!@empty($user->first_name))
                                        {{ $user->first_name }}
                                    @endif
                                    @if(!@empty($user->last_name))
                                        {{ $user->last_name }}
                                    @endif

                                    @if(!@empty($user->user_name))
                                        {{ '(@' . $user->user_name . ')' }}
                                    @endif
                                </h5>
                                <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal"
                                        aria-label="Close">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <p>
                                    @if(is_null($user->activated_at))
                                        {{ __('Êtes vous sûr(e) de vouloir activer cet utilisateur ?') }}
                                    @else
                                        {{ __('Êtes vous sûr(e) de vouloir désactiver cet utilisateur ?') }}
                                    @endif
                                </p>
                                @csrf
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-success-soft mb-2 mb-sm-0" data-bs-dismiss="modal">
                                    {{ __('Non') }}
                                </button>
                                <button type="submit" class="btn btn-danger mb-0">
                                    @if(is_null($user->activated_at))
                                        {{ __('Oui, Activer !') }}
                                    @else
                                        {{ __('Oui, Désactiver !') }}
                                    @endif
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Popup modal for user enable disable END -->

            <!-- Popup modal for user validate account START -->
            <div class="modal fade" id="user-validate-modal-{{$user->id}}" tabindex="-1"
                 aria-labelledby="user-validate-modal-{{$user->id}}"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <form
                        action="{{ route($profile . '.user.validate-account', ['user' => $user]) }}"
                        method="post">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="card-header-title mb-0">
                                    {{ __('Valider le compte de l\'utilisateur') }}
                                    @if(@empty($user->first_name) && @empty($user->last_name))
                                        {{ $user->email }}
                                    @endif

                                    @if(!@empty($user->first_name))
                                        {{ $user->first_name }}
                                    @endif
                                    @if(!@empty($user->last_name))
                                        {{ $user->last_name }}
                                    @endif

                                    @if(!@empty($user->user_name))
                                        {{ '(@' . $user->user_name . ')' }}
                                    @endif
                                </h5>
                                <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal"
                                        aria-label="Close">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <p>
                                    {{ __('Êtes vous sûr(e) de vouloir valider le compte de cet utilisateur ?') }}
                                </p>
                                @csrf
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-success-soft mb-2 mb-sm-0" data-bs-dismiss="modal">
                                    {{ __('Non') }}
                                </button>
                                <button type="submit" class="btn btn-danger mb-0">
                                    {{ __('Oui, Valider !') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Popup modal for user validate accounte END -->

            <!-- Popup modal for user delete START -->
            <div class="modal fade" id="user-delete-modal-{{$user->id}}" tabindex="-1"
                 aria-labelledby="user-delete-modal-{{$user->id}}"
                 aria-hidden="true">
                <div class="modal-dialog ">
                    <form action="{{ route($profile . '.user.delete', ['user' => $user]) }}" method="post">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="card-header-title mb-0">
                                    {{ __('Supprimer l\'utilisateur') }}
                                    @if(@empty($user->first_name) && @empty($user->last_name))
                                        {{ $user->email }}
                                    @endif

                                    @if(!@empty($user->first_name))
                                        {{ $user->first_name }}
                                    @endif
                                    @if(!@empty($user->last_name))
                                        {{ $user->last_name }}
                                    @endif

                                    @if(!@empty($user->user_name))
                                        {{ '(@' . $user->user_name . ')' }}
                                    @endif
                                </h5>
                                <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal"
                                        aria-label="Close">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <p>
                                    {{ __('Êtes vous sûr(e) de vouloir supprimer cet utilisateur ?') }}
                                </p>
                                @csrf
                                @method('delete')
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-success-soft mb-2 mb-sm-0" data-bs-dismiss="modal">
                                    {{ __('Non') }}
                                </button>
                                <button type="submit" class="btn btn-danger mb-0">
                                    {{ __('Oui, Supprimer !') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Popup modal for user delete END -->
        @endforeach
    @endif
@endsection
