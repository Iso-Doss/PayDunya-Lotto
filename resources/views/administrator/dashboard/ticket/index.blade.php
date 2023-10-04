{{-- resources/view/administrator/dashboard/ticket/index.blade.php --}}

@extends($profile . '.dashboard.base')

@section('sub-title', __('Billets de loterie'))

@section('main-content')

    <div class="page-content-wrapper border">
        <!-- Card header START -->
        <div class="card-header bg-transparent border-bottom">
            <div class="row mb-3">
                <div class="col-12 d-sm-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-2 mb-sm-0">
                        {{ __('Billets de loterie') }}
                    </h1>
                    <a href="{{ route($profile . '.ticket.create') }}" class="btn btn-sm btn-success mb-0">
                        {{ __('Ajouter un billet') }}
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
                    <form class="rounded position-relative" action="{{ route($profile . '.ticket.index') }}">
                        @csrf

                        <div class="row g-3">

                            <!-- Status -->
                            <div class="col-xl-6">
                                <label for="ticket-ticket" class="form-label">
                                    {{ __('Statut : ') }}
                                </label>
                                <select name="status" id="ticket-status"
                                        class="form-select me-1 mt-2 ticket-ticket @error('ticket'){{'is-invalid'}}@enderror">
                                    <option value="">
                                        {{ __('Rechercher par le statut du billet') }}
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
                                <label for="ticket-name" class="form-label">
                                    {{ __('Nom : ') }}
                                </label>
                                <input type="text" name="name" id="ticket-name"
                                       class="form-control me-1 mt-2 ticket-name @error('search'){{'is-invalid'}}@enderror"
                                       placeholder="{{ __('Recherche par le nom du billet') }}"
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

            @if(!@empty($ticketes->items()))
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
                                {{ __('Prix') }}
                            </th>
                            <th scope="col" class="border-0">
                                {{ __('Description') }}
                            </th>
                            <th scope="col" class="border-0 rounded-end w-280px">
                                {{ __('Actions') }}
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($ticketes as $ticket)
                            <tr>
                                <!-- Image -->
                                <td>
                                    <div
                                            class="btn btn-round mb-0 bg-orange bg-opacity-10 text-orange w-70px h-70px d-flex justify-content-center align-items-center">
                                        @if(!@empty($ticket->image))
                                            <a href="#" role="button" data-bs-toggle="modal"
                                               data-bs-target="#ticket-image-modal-{{$ticket->id}}">
                                                <img class="" src="{{ '/storage/' . $ticket->image }}"
                                                     alt="{{ __('Image du billet :ticket-name', ['ticket-name' => $ticket->name]) }}">
                                            </a>
                                        @else
                                            <i class="bi bi-ticket fs-5"></i>
                                        @endif
                                    </div>
                                </td>

                                <!-- Nom -->
                                <td>
                                    <h6>
                                        @if(!@empty($ticket->name))
                                            {{ $ticket->name }}
                                        @else
                                            {{ __('-') }}
                                        @endif
                                    </h6>
                                    <p>
                                        @if(!is_null($ticket->deleted_at))
                                            <span class="badge bg-danger bg-opacity-10 text-danger">
                                                {{ __('Billet supprimé') }}
                                            </span>
                                        @else
                                            @if(is_null($ticket->activated_at))
                                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                                    {{ __('Billet inactif') }}
                                                </span>
                                            @else
                                                <span
                                                        class="badge bg-success bg-opacity-10 text-success">
                                                    {{ __('Billet actif') }}
                                                </span>
                                            @endif
                                        @endif
                                    </p>
                                </td>

                                <!-- Price -->
                                <td>
                                    <p>
                                        @if(!@empty($ticket->price))
                                            {{ __(' :ticket_price FCFA', ['ticket_price' => number_format($ticket->price, thousands_separator: ' ')]) }}
                                        @else
                                            {{ __('-') }}
                                        @endif
                                    </p>
                                </td>

                                <!-- Description -->
                                <td>
                                    <p>
                                        @if(!@empty($ticket->description))
                                            {{ $ticket->description }}
                                            {{--{{ Str::of($ticket->description)->limit(100) }}--}}
                                        @else
                                            {{ __('-') }}
                                        @endif
                                    </p>
                                </td>

                                <!-- Table actions -->
                                <td class="h-100">
                                    @if(!is_null($ticket->deleted_at))
                                        <p class="text-danger">
                                            {{ __('Billet supprimé') }}
                                        </p>
                                    @else

                                        <a class="btn btn-info-soft btn-round me-1 mb-1 aec-click-modal"
                                           aec-modal-target="ticket-details-modal-{{$ticket->id}}"
                                           data-bs-toggle="tooltip" data-bs-placement="top"
                                           aria-label="{{ __('Détails') }}"
                                           data-bs-original-title="{{ __('Détails') }}">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="#" class="btn btn-info-soft btn-round me-1 mb-1 d-none"
                                           data-bs-toggle="modal"
                                           data-bs-target="#ticket-details-modal-{{$ticket->id}}">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="{{ route($profile . '.ticket.update', ['ticket' => $ticket]) }}"
                                           class="btn btn-warning-soft btn-round me-1 mb-1"
                                           data-bs-toggle="tooltip" data-bs-placement="top"
                                           aria-label="{{ __('Modifier') }}"
                                           data-bs-original-title="{{ __('Modifier') }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <a class="btn {{ (is_null($ticket->activated_at)) ? 'btn-primary-soft' : 'btn-danger-soft' }} btn-round me-1 mb-1 aec-click-modal"
                                           aec-modal-target="ticket-enable-disable-modal-{{$ticket->id}}"
                                           data-bs-toggle="tooltip" data-bs-placement="top"
                                           aria-label="{{ (is_null($ticket->activated_at)) ? __('Activer') : __('Désactiver') }}"
                                           data-bs-original-title="{{ (is_null($ticket->activated_at)) ? __('Activer') : __('Désactiver') }}">
                                            @if(is_null($ticket->activated_at))
                                                <i class=" bi bi-check"></i>
                                            @else
                                                <i class="bi bi-x"></i>
                                            @endif
                                        </a>

                                        <a href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#ticket-enable-disable-modal-{{$ticket->id}}"
                                           class="btn {{ (is_null($ticket->activated_at)) ? 'btn-primary-soft' : 'btn-danger-soft' }} btn-round me-1 mb-1 d-none">
                                            @if(is_null($ticket->activated_at))
                                                <i class=" bi bi-check"></i>
                                            @else
                                                <i class="bi bi-x"></i>
                                            @endif
                                        </a>

                                        <a
                                                class="btn btn-danger-soft btn-round aec-click-modal mb-1"
                                                aec-modal-target="ticket-delete-modal-{{$ticket->id}}"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top" aria-label="{{ __('Supprimer') }}"
                                                data-bs-original-title="{{ __('Supprimer') }}">
                                            <i class="bi bi-trash"></i>
                                        </a>

                                        <a href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#ticket-delete-modal-{{$ticket->id}}"
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
                {{ $ticketes->links() }}
                <!-- Pagination END -->
            @else
                <p>
                    {{ __('Aucun billet trouvé.') }}
                </p>
            @endif
        </div>
        <!-- Card body START -->
    </div>
    <!-- Main content END -->


    @if(!@empty($ticketes->items()))
        @foreach($ticketes as $ticket)
            @if($ticket->image)
                <!-- Popup modal for ticket image START -->
                <div class="modal fade" id="ticket-image-modal-{{$ticket->id}}" tabindex="-1"
                     aria-labelledby="ticket-image-modal-{{$ticket->id}}"
                     aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="card-header-title mb-0">
                                    {{ __('Photo du billet') }}

                                    @if(@empty($ticket->name))
                                        {{ $ticket->name }}
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
                                        <img src="{{ "/storage/" . $ticket->image }}"
                                             alt="{{ __('Photo du billet :ticket-name', ['ticket-name' => $ticket->name]) }}"
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
                <!-- Popup modal for ticket image END -->
            @endif

            <!-- Popup modal for ticket details START -->
            <div class="modal fade" id="ticket-details-modal-{{$ticket->id}}" tabindex="-1"
                 aria-labelledby="ticket-details-modal-{{$ticket->id}}"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- Modal header -->
                        <div class="modal-header">
                            <h5 class="card-header-title mb-0">
                                {{ __('Détails sur le billet : ') }}

                                @if(!@empty($ticket->name))
                                    {{ $ticket->name }}
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

                                        @if(!is_null($ticket->name))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Nom : ') }}
                                                </td>
                                                <td>
                                                    {{ $ticket->name }}
                                                    <p>
                                                        @if(!is_null($ticket->deleted_at))
                                                            <span class="badge bg-danger bg-opacity-10 text-danger">
                                                                {{ __('Billet supprimé') }}
                                                            </span>
                                                        @else
                                                            @if(is_null($ticket->activated_at))
                                                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                                                    {{ __('Billet inactif') }}
                                                                </span>
                                                            @else
                                                                <span
                                                                        class="badge bg-success bg-opacity-10 text-success">
                                                                    {{ __('Billet actif') }}
                                                                </span>
                                                            @endif
                                                        @endif
                                                    </p>
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($ticket->price))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Prix : ') }}
                                                </td>
                                                <td>
                                                    {{ __(' :ticket_price FCFA', ['ticket_price' => number_format($ticket->price, thousands_separator: ' ')]) }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($ticket->short_description))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Courte description : ') }}
                                                </td>
                                                <td>
                                                    {{ $ticket->short_description }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($ticket->description))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Description : ') }}
                                                </td>
                                                <td>
                                                    {{ $ticket->description }}
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
            <!-- Popup modal for ticket details END -->

            <!-- Popup modal for ticket enable disable START -->
            <div class="modal fade" id="ticket-enable-disable-modal-{{$ticket->id}}" tabindex="-1"
                 aria-labelledby="ticket-enable-disable-modal-{{$ticket->id}}"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <form
                            action="{{ route($profile . '.ticket.enable-disable', ['ticket' => $ticket, 'new_status' => (is_null($ticket->activated_at)) ? 'enable' : 'disable']) }}"
                            method="post">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="card-header-title mb-0">
                                    @if(is_null($ticket->activated_at))
                                        {{ __('Activer le billet : ') }}
                                    @else
                                        {{ __('Désactiver le billet : ') }}
                                    @endif

                                    @if(!@empty($ticket->name))
                                        {{ $ticket->name }}
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
                                    @if(is_null($ticket->activated_at))
                                        {{ __('Êtes vous sûr(e) de vouloir activer ce billet ?') }}
                                    @else
                                        {{ __('Êtes vous sûr(e) de vouloir désactiver ce billet ?') }}
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
                                    @if(is_null($ticket->activated_at))
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
            <!-- Popup modal for ticket enable disable END -->

            <!-- Popup modal for ticket delete START -->
            <div class="modal fade" id="ticket-delete-modal-{{$ticket->id}}" tabindex="-1"
                 aria-labelledby="ticket-delete-modal-{{$ticket->id}}"
                 aria-hidden="true">
                <div class="modal-dialog ">
                    <form action="{{ route($profile . '.ticket.delete', ['ticket' => $ticket]) }}" method="post">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="card-header-title mb-0">
                                    {{ __('Supprimer le billet : ') }}

                                    @if(!@empty($ticket->name))
                                        {{ $ticket->name }}
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
                                    {{ __('Êtes vous sûr(e) de vouloir supprimer ce billet ?') }}
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
            <!-- Popup modal for ticket delete END -->
        @endforeach
    @endif
@endsection
