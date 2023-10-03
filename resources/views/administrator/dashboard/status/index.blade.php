{{-- resources/view/administrator/dashboard/status/index.blade.php --}}

@extends($profile . '.dashboard.base')

@section('sub-title', __('Statuts des loteries, transactions'))

@section('main-content')

    <div class="page-content-wrapper border">
        <!-- Card header START -->
        <div class="card-header bg-transparent border-bottom">
            <div class="row mb-3">
                <div class="col-12 d-sm-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-2 mb-sm-0">
                        {{ __('Statuts des loteries, transactions') }}
                    </h1>
                    <a href="{{ route($profile . '.status.create') }}" class="btn btn-sm btn-success mb-0">
                        {{ __('Ajouter un statut') }}
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
                    <form class="rounded position-relative" action="{{ route($profile . '.status.index') }}">
                        @csrf

                        <div class="row g-3">

                            <!-- Statut -->
                            <div class="col-xl-6">
                                <label for="status-status" class="form-label">
                                    {{ __('Statut : ') }}
                                </label>
                                <select name="status" id="status-status"
                                        class="form-select me-1 mt-2 status-status @error('status'){{'is-invalid'}}@enderror">
                                    <option value="">
                                        {{ __('Rechercher par le statut du statut') }}
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

                            <!-- Nom  -->
                            <div class="col-xl-6">
                                <label for="status-name" class="form-label">
                                    {{ __('Nom : ') }}
                                </label>
                                <input type="text" name="name" id="status-name"
                                       class="form-control me-1 mt-2 status-name @error('search'){{'is-invalid'}}@enderror"
                                       placeholder="{{ __('Recherche par le nom du statut') }}"
                                       value="{{ $input['name'] ?? '' }}">
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

            @if(!@empty($statuses->items()))
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
                                {{ __('Entité') }}
                            </th>
                            <th scope="col" class="border-0">
                                {{ __('Description') }}
                            </th>
                            <th scope="col" class="border-0">
                                {{ __('Message') }}
                            </th>
                            <th scope="col" class="border-0 rounded-end w-280px">
                                {{ __('Actions') }}
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($statuses as $status)
                            <tr>
                                <!-- Image -->
                                <td>
                                    <div
                                        class="btn btn-round mb-0 bg-orange bg-opacity-10 text-orange w-70px h-70px d-flex justify-content-center align-items-center">
                                        @if(!@empty($status->image))
                                            <a href="#" role="button" data-bs-toggle="modal"
                                               data-bs-target="#status-image-modal-{{$status->id}}">
                                                <img class="" src="{{ '/storage/' . $status->image }}"
                                                     alt="{{ __('Image du statut :status-name', ['status-name' => $status->name]) }}">
                                            </a>
                                        @elseif(!@empty($status->icon))
                                            <i class="fas {{$status->icon}} fs-5"></i>
                                        @else
                                            <i class="bi bi-check-circle fs-5"></i>
                                        @endif
                                    </div>
                                </td>

                                <!-- Nom -->
                                <td>
                                    <h6>
                                        @if(!@empty($status->name))
                                            {{ $status->name }}
                                        @else
                                            {{ __('-') }}
                                        @endif
                                    </h6>
                                    <p>
                                        @if(!is_null($status->deleted_at))
                                            <span class="badge bg-danger bg-opacity-10 text-danger">
                                                {{ __('Statut supprimé') }}
                                            </span>
                                        @else
                                            @if(is_null($status->activated_at))
                                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                                    {{ __('Statut inactif') }}
                                                </span>
                                            @else
                                                <span
                                                    class="badge bg-success bg-opacity-10 text-success">
                                                    {{ __('Statut actif') }}
                                                </span>
                                            @endif
                                        @endif
                                    </p>
                                </td>

                                <!-- Code -->
                                <td>
                                    <h6>
                                        @if(!@empty($status->code))
                                            {{ $status->code }}
                                        @else
                                            {{ __('-') }}
                                        @endif
                                    </h6>
                                </td>

                                <!-- Entity -->
                                <td>
                                    <h6>
                                        @if(!@empty($status->entity))
                                            {{ $status->entity }}
                                        @else
                                            {{ __('-') }}
                                        @endif
                                    </h6>
                                </td>

                                <!-- Description -->
                                <td>
                                    <p>
                                        @if(!@empty($status->description))
                                            {{ $status->description }}
                                            {{--{{ Str::of($status->description)->limit(100) }}--}}
                                        @else
                                            {{ __('-') }}
                                        @endif
                                    </p>
                                </td>

                                <!-- Message -->
                                <td>
                                    <p>
                                        @if(!@empty($status->message))
                                            {{ $status->message }}
                                            {{--{{ Str::of($status->message)->limit(100) }}--}}
                                        @else
                                            {{ __('-') }}
                                        @endif
                                    </p>
                                </td>

                                <!-- Table actions -->
                                <td class="h-100">
                                    @if(!is_null($status->deleted_at))
                                        <p class="text-danger">
                                            {{ __('Statut supprimé') }}
                                        </p>
                                    @else

                                        <a class="btn btn-info-soft btn-round me-1 mb-1 aec-click-modal"
                                           aec-modal-target="status-details-modal-{{$status->id}}"
                                           data-bs-toggle="tooltip" data-bs-placement="top"
                                           aria-label="{{ __('Détails') }}"
                                           data-bs-original-title="{{ __('Détails') }}">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="#" class="btn btn-info-soft btn-round me-1 mb-1 d-none"
                                           data-bs-toggle="modal"
                                           data-bs-target="#status-details-modal-{{$status->id}}">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="{{ route($profile . '.status.update', ['status' => $status]) }}"
                                           class="btn btn-warning-soft btn-round me-1 mb-1"
                                           data-bs-toggle="tooltip" data-bs-placement="top"
                                           aria-label="{{ __('Modifier') }}"
                                           data-bs-original-title="{{ __('Modifier') }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <a class="btn {{ (is_null($status->activated_at)) ? 'btn-primary-soft' : 'btn-danger-soft' }} btn-round me-1 mb-1 aec-click-modal"
                                           aec-modal-target="status-enable-disable-modal-{{$status->id}}"
                                           data-bs-toggle="tooltip" data-bs-placement="top"
                                           aria-label="{{ (is_null($status->activated_at)) ? __('Activer') : __('Désactiver') }}"
                                           data-bs-original-title="{{ (is_null($status->activated_at)) ? __('Activer') : __('Désactiver') }}">
                                            @if(is_null($status->activated_at))
                                                <i class=" bi bi-check"></i>
                                            @else
                                                <i class="bi bi-x"></i>
                                            @endif
                                        </a>

                                        <a href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#status-enable-disable-modal-{{$status->id}}"
                                           class="btn {{ (is_null($status->activated_at)) ? 'btn-primary-soft' : 'btn-danger-soft' }} btn-round me-1 mb-1 d-none">
                                            @if(is_null($status->activated_at))
                                                <i class=" bi bi-check"></i>
                                            @else
                                                <i class="bi bi-x"></i>
                                            @endif
                                        </a>

                                        <a
                                            class="btn btn-danger-soft btn-round aec-click-modal mb-1"
                                            aec-modal-target="status-delete-modal-{{$status->id}}"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top" aria-label="{{ __('Supprimer') }}"
                                            data-bs-original-title="{{ __('Supprimer') }}">
                                            <i class="bi bi-trash"></i>
                                        </a>

                                        <a href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#status-delete-modal-{{$status->id}}"
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
                {{ $statuses->links() }}
                <!-- Pagination END -->
            @else
                <p>
                    {{ __('Aucun statut trouvé.') }}
                </p>
            @endif
        </div>
        <!-- Card body START -->
    </div>
    <!-- Main content END -->


    @if(!@empty($statuses->items()))
        @foreach($statuses as $status)
            @if($status->image)
                <!-- Popup modal for status image START -->
                <div class="modal fade" id="status-image-modal-{{$status->id}}" tabindex="-1"
                     aria-labelledby="status-image-modal-{{$status->id}}"
                     aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="card-header-title mb-0">
                                    {{ __('Photo du pays') }}

                                    @if(@empty($status->name))
                                        {{ $status->name }}
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
                                        <img src="{{ "/storage/" . $status->avatar }}"
                                             alt="{{ __('Photo du pays :status-name', ['status-name' => $status->name]) }}"
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
                <!-- Popup modal for status image END -->
            @endif

            <!-- Popup modal for status details START -->
            <div class="modal fade" id="status-details-modal-{{$status->id}}" tabindex="-1"
                 aria-labelledby="status-details-modal-{{$status->id}}"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- Modal header -->
                        <div class="modal-header">
                            <h5 class="card-header-title mb-0">
                                {{ __('Détails sur le statut : ') }}

                                @if(!@empty($status->name))
                                    {{ $status->name }}
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

                                        @if(!is_null($status->name))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Nom : ') }}
                                                </td>
                                                <td>
                                                    {{ $status->name }}
                                                    <p>
                                                        @if(!is_null($status->deleted_at))
                                                            <span class="badge bg-danger bg-opacity-10 text-danger">
                                                                {{ __('Statut supprimé') }}
                                                            </span>
                                                        @else
                                                            @if(is_null($status->activated_at))
                                                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                                                    {{ __('Statut inactif') }}
                                                                </span>
                                                            @else
                                                                <span
                                                                    class="badge bg-success bg-opacity-10 text-success">
                                                                    {{ __('Statut actif') }}
                                                                </span>
                                                            @endif
                                                        @endif
                                                    </p>
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($status->code))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Code : ') }}
                                                </td>
                                                <td>
                                                    {{ $status->code }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($status->description))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Description : ') }}
                                                </td>
                                                <td>
                                                    {{ $status->description }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($status->message))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Message : ') }}
                                                </td>
                                                <td>
                                                    {{ $status->message }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($status->entity))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Entité : ') }}
                                                </td>
                                                <td>
                                                    {{ $status->entity }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($status->icon))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Icon : ') }}
                                                </td>
                                                <td>
                                                    {{ $status->icon }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($status->color))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Couleur : ') }}
                                                </td>
                                                <td>
                                                    {{ $status->color }}
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
            <!-- Popup modal for status details END -->

            <!-- Popup modal for status enable disable START -->
            <div class="modal fade" id="status-enable-disable-modal-{{$status->id}}" tabindex="-1"
                 aria-labelledby="status-enable-disable-modal-{{$status->id}}"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <form
                        action="{{ route($profile . '.status.enable-disable', ['status' => $status, 'new_status' => (is_null($status->activated_at)) ? 'enable' : 'disable']) }}"
                        method="post">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="card-header-title mb-0">
                                    @if(is_null($status->activated_at))
                                        {{ __('Activer le statut : ') }}
                                    @else
                                        {{ __('Désactiver le statut : ') }}
                                    @endif

                                    @if(!@empty($status->name))
                                        {{ $status->name }}
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
                                    @if(is_null($status->activated_at))
                                        {{ __('Êtes vous sûr(e) de vouloir activer ce statut ?') }}
                                    @else
                                        {{ __('Êtes vous sûr(e) de vouloir désactiver ce statut ?') }}
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
                                    @if(is_null($status->activated_at))
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
            <!-- Popup modal for status enable disable END -->

            <!-- Popup modal for status delete START -->
            <div class="modal fade" id="status-delete-modal-{{$status->id}}" tabindex="-1"
                 aria-labelledby="status-delete-modal-{{$status->id}}"
                 aria-hidden="true">
                <div class="modal-dialog ">
                    <form action="{{ route($profile . '.status.delete', ['status' => $status]) }}" method="post">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="card-header-title mb-0">
                                    {{ __('Supprimer le statut : ') }}

                                    @if(!@empty($status->name))
                                        {{ $status->name }}
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
                                    {{ __('Êtes vous sûr(e) de vouloir supprimer ce statut ?') }}
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
            <!-- Popup modal for status delete END -->
        @endforeach
    @endif
@endsection
