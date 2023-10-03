{{-- resources/view/administrator/dashboard/country/index.blade.php --}}

@extends($profile . '.dashboard.base')

@section('sub-title', __('Pays'))

@section('main-content')

    <div class="page-content-wrapper border">
        <!-- Card header START -->
        <div class="card-header bg-transparent border-bottom">
            <div class="row mb-3">
                <div class="col-12 d-sm-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-2 mb-sm-0">
                        {{ __('Pays') }}
                    </h1>
                    <a href="{{ route($profile . '.country.create') }}" class="btn btn-sm btn-success mb-0">
                        {{ __('Ajouter un pays') }}
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
                    <form class="rounded position-relative" action="{{ route($profile . '.country.index') }}">
                        @csrf

                        <div class="row g-3">
                            <!-- Statut -->
                            <div class="col-xl-6">
                                <label for="country-status" class="form-label">
                                    {{ __('Statut : ') }}
                                </label>
                                <select name="status" id="country-status"
                                        class="form-select me-1 mt-2 country-status @error('status'){{'is-invalid'}}@enderror">
                                    <option value="">
                                        {{ __('Rechercher par le statut du pays') }}
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

                            <!-- Nom du pays -->
                            <div class="col-xl-6">
                                <label for="country-name" class="form-label">
                                    {{ __('Nom : ') }}
                                </label>
                                <input type="text" name="name" id="country-name"
                                       class="form-control me-1 mt-2 country-name @error('name'){{'is-invalid'}}@enderror"
                                       placeholder="{{ __('Recherche par le nom du pays') }}"
                                       value="{{ $input['name'] ?? '' }}">
                            </div>

                            <!-- Code du pays -->
                            <div class="col-xl-6">
                                <label for="country-code" class="form-label">
                                    {{ __('Code : ') }}
                                </label>
                                <input type="text" name="code" id="country-code"
                                       class="form-control me-1 mt-2 country-code @error('code'){{'is-invalid'}}@enderror"
                                       placeholder="{{ __('Recherche par le code du pays') }}"
                                       value="{{ $input['code'] ?? '' }}">
                            </div>

                            <!-- Indicatif Téléphonique -->
                            <div class="col-xl-6">
                                <label for="country-phone-code" class="form-label">
                                    {{ __('Indicatif Téléphonique : ') }}
                                </label>
                                <input type="text" name="phone_code" id="country-phone-code"
                                       class="form-control me-1 mt-2 country-phone-code @error('phone_code'){{'is-invalid'}}@enderror"
                                       placeholder="{{ __('Recherche par l\'indicatif téléphonique du pays') }}"
                                       value="{{ $input['phone_code'] ?? '' }}">
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

            @if(!@empty($countries->items()))
                <!-- Course list table START -->
                <div class="table-responsive border-0">
                    <table class="table table-dark-gray p-4 mb-0 table-hover">
                        <!-- Table head -->
                        <thead>
                        <tr>
                            <th scope="col" class="border-0 rounded-start">
                                {{ __('Image') }}
                            </th>
                            <th scope="col" class="border-0">
                                {{ __('Nom') }}
                            </th>
                            <th scope="col" class="border-0">
                                {{ __('Code') }}
                            </th>
                            <th scope="col" class="border-0">
                                {{ __('Indicatif') }}
                            </th>
                            <th scope="col" class="border-0 rounded-end w-280px">
                                {{ __('Actions') }}
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($countries as $country)
                            <tr>
                                <!-- Image -->
                                <td>
                                    <div
                                        class="btn btn-round mb-0 bg-orange bg-opacity-10 text-orange w-70px h-70px d-flex justify-content-center align-items-center">
                                        @if(!@empty($country->image))
                                            <a href="#" role="button" data-bs-toggle="modal"
                                               data-bs-target="#country-image-modal-{{$country->id}}">
                                                <img class="" src="{{ '/storage/' . $country->image }}"
                                                     alt="{{ __('Avatar du pays :country-name',['country-name' => $country->name]) }}">
                                            </a>
                                        @elseif(!@empty($country->code))
                                            <span
                                                class="text-orange position-absolute top-50 start-50 translate-middle fw-bold">
                                                {{ $country->code }}
                                            </span>
                                        @else
                                            <i class="bi bi-globe fs-5"></i>
                                        @endif
                                    </div>
                                </td>

                                <!-- Nom -->
                                <td>
                                    <h6>
                                        {{ $country->name }}
                                    </h6>
                                    <p class="mb-0">
                                        @if(!is_null($country->deleted_at))
                                            <span class="badge bg-danger bg-opacity-10 text-danger">
                                              {{ __('Pays supprimé') }}
                                            </span>
                                        @else
                                            @if(is_null($country->activated_at))
                                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                                   {{ __('Pays inactif') }}
                                                </span>
                                            @else
                                                <span class="badge bg-success bg-opacity-10 text-success">
                                                   {{ __('Pays actif') }}
                                                </span>
                                            @endif
                                        @endif
                                    </p>
                                    <p>
                                    </p>
                                </td>

                                <!-- Code -->
                                <td>
                                    <p>
                                        @if(!@empty($country->code))
                                            {{ $country->code }}
                                        @else
                                            {{ __('-') }}
                                        @endif
                                    </p>
                                </td>

                                <!-- Indicatif -->
                                <td>
                                    <p>
                                        @if(!@empty($country->phone_code))
                                            {{ $country->phone_code }}
                                        @else
                                            {{ __('-') }}
                                        @endif
                                    </p>
                                </td>

                                <!-- Table actions -->
                                <td class="h-100">
                                    @if (!is_null($country->deleted_at))
                                        <p class="text-danger">{{ __('Pays supprimé') }}</p>
                                    @else
                                        <a href="{{ route($profile . '.country.update', ['country' => $country]) }}"
                                           class="btn btn-warning-soft btn-round me-1 mb-1"
                                           data-bs-toggle="tooltip" data-bs-placement="top"
                                           aria-label="{{ __('Modifier') }}"
                                           data-bs-original-title="{{ __('Modifier') }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <a class="btn {{ (is_null($country->activated_at)) ? 'btn-primary-soft' : 'btn-danger-soft' }} btn-round me-1 mb-1 aec-click-modal"
                                           aec-modal-target="country-enable-disable-modal-{{$country->id}}"
                                           data-bs-toggle="tooltip" data-bs-placement="top"
                                           aria-label="{{ (is_null($country->activated_at)) ? __('Activer') : __('Désactiver') }}"
                                           data-bs-original-title="{{ (is_null($country->activated_at)) ? __('Activer') : __('Désactiver') }}">
                                            @if(is_null($country->activated_at))
                                                <i class=" bi bi-check"></i>
                                            @else
                                                <i class="bi bi-x"></i>
                                            @endif
                                        </a>

                                        <a href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#country-enable-disable-modal-{{$country->id}}"
                                           class="btn {{ (is_null($country->activated_at)) ? 'btn-primary-soft' : 'btn-danger-soft' }} btn-round me-1 mb-1 d-none">
                                            @if(is_null($country->activated_at))
                                                <i class=" bi bi-check"></i>
                                            @else
                                                <i class="bi bi-x"></i>
                                            @endif
                                        </a>

                                        <a
                                            class="btn btn-danger-soft btn-round aec-click-modal mb-1"
                                            aec-modal-target="country-delete-modal-{{$country->id}}"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top" aria-label="{{ __('Supprimer') }}"
                                            data-bs-original-title="{{ __('Supprimer') }}">
                                            <i class="bi bi-trash"></i>
                                        </a>

                                        <a href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#country-delete-modal-{{$country->id}}"
                                           class="btn btn-danger-soft btn-round mb-1 d-none"
                                           data-bs-toggle="tooltip"
                                           data-bs-placement="top" aria-label="{{ __('Supprimer') }}"
                                           data-bs-original-title="{{ __('Supprimer') }}">
                                            <i class="bi bi-trash"></i>
                                        </a>
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
                {{ $countries->links() }}
                <!-- Pagination END -->
            @else
                <p>
                    {{ __('Aucun pays trouvé.') }}
                </p>
            @endif
        </div>
        <!-- Card body START -->
    </div>
    <!-- Main content END -->

    @if(!@empty($countries->items()))
        @foreach($countries as $country)
            @if($country->image)
                <!-- Popup modal for country image START -->
                <div class="modal fade" id="country-image-modal-{{$country->id}}" tabindex="-1"
                     aria-labelledby="country-image-modal-{{$country->id}}"
                     aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="card-header-title mb-0">
                                    {{ __('Photo du pays') }}

                                    @if(@empty($country->name))
                                        {{ $country->name }}
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
                                        <img src="{{ "/storage/" . $country->avatar }}"
                                             alt="{{ __('Photo du pays :country-name', ['country-name' => $country->name]) }}"
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
                <!-- Popup modal for country image END -->
            @endif

            <!-- Popup modal for country enable disable START -->
            <div class="modal fade" id="country-enable-disable-modal-{{$country->id}}" tabindex="-1"
                 aria-labelledby="country-enable-disable-modal-{{$country->id}}"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <form
                        action="{{ route($profile . '.country.enable-disable', ['country' => $country, 'new_status' => (is_null($country->activated_at)) ? 'enable' : 'disable']) }}"
                        method="post">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="card-header-title mb-0">
                                    @if(is_null($country->activated_at))
                                        {{ __('Activer le pays') }}
                                    @else
                                        {{ __('Désactiver le pays') }}
                                    @endif
                                    @if(!@empty($country->name))
                                        {{ $country->name }}
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
                                    @if(is_null($country->activated_at))
                                        {{ __('Êtes vous sûr(e) de vouloir activer ce pays ?') }}
                                    @else
                                        {{ __('Êtes vous sûr(e) de vouloir désactiver ce pays ?') }}
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
                                    @if(is_null($country->activated_at))
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
            <!-- Popup modal for country enable disable END -->

            <!-- Popup modal for country delete START -->
            <div class="modal fade" id="country-delete-modal-{{$country->id}}" tabindex="-1"
                 aria-labelledby="country-delete-modal-{{$country->id}}"
                 aria-hidden="true">
                <div class="modal-dialog ">
                    <form action="{{ route($profile . '.country.delete', ['country' => $country]) }}" method="post">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="card-header-title mb-0">
                                    {{ __('Supprimer le pays') }}
                                    @if(!@empty($country->name))
                                        {{ $country->name }}
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
                                    {{ __('Êtes vous sûr(e) de vouloir supprimer ce pays ?') }}
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
            <!-- Popup modal for country delete END -->
        @endforeach
    @endif
@endsection
