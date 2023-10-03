{{-- resources/view/administrator/dashboard/lottery/index.blade.php --}}

@extends($profile . '.dashboard.base')

@section('sub-title', __('Loteries'))

@section('main-content')

    <div class="page-content-wrapper border">
        <!-- Card header START -->
        <div class="card-header bg-transparent border-bottom">
            <div class="row mb-3">
                <div class="col-12 d-sm-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-2 mb-sm-0">
                        {{ __('Loteries') }}
                    </h1>
                    <a href="{{ route($profile . '.lottery.create') }}" class="btn btn-sm btn-success mb-0">
                        {{ __('Ajouter une loterie') }}
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
                    <form class="rounded position-relative" action="{{ route($profile . '.lottery.index') }}">
                        @csrf

                        <div class="row g-3">

                            <!-- Nom  -->
                            <div class="col-xl-6">
                                <label for="lottery-name" class="form-label">
                                    {{ __('Nom : ') }}
                                </label>
                                <input type="text" name="name" id="lottery-name"
                                       class="form-control me-1 mt-2 lottery-name @error('search'){{'is-invalid'}}@enderror"
                                       placeholder="{{ __('Recherche par le nom de la loterie') }}"
                                       value="{{ $input['name'] ?? '' }}">
                            </div>

                            <!-- Date  -->
                            <div class="col-xl-6">
                                <label for="lottery-date" class="form-label">
                                    {{ __('Date : ') }}
                                </label>
                                <input type="date" name="date" id="lottery-date"
                                       class="form-control me-1 mt-2 lottery-date @error('date'){{'is-invalid'}}@enderror"
                                       placeholder="{{ __('Recherche par la date de la loterie') }}"
                                       value="{{ $input['date'] ?? '' }}">
                            </div>

                            <!-- Jackpot  -->
                            <div class="col-xl-6">
                                <label for="lottery-jackpot" class="form-label">
                                    {{ __('Cagnotte : ') }}
                                </label>
                                <input type="text" name="jackpot" id="lottery-jackpot"
                                       class="form-control me-1 mt-2 lottery-jackpot @error('jackpot'){{'is-invalid'}}@enderror"
                                       placeholder="{{ __('Recherche par la cagnotte de la loterie') }}"
                                       value="{{ $input['jackpot'] ?? '' }}">
                            </div>

                            <!-- Status -->
                            <div class="col-xl-6">
                                <label for="transaction-status-id" class="form-label">
                                    {{ __('Statut : ') }}
                                </label>
                                @if(!empty($statuses))
                                    <select name="status_id" id="transaction-status-id"
                                            class="form-select me-1 mt-2 transaction-status-id @error('status_id'){{'is-invalid'}}@enderror">
                                        <option value="">
                                            {{ __('Veuillez sélectionner le statut') }}
                                        </option>
                                        @foreach($statuses as $status)
                                            <option
                                                value="{{ $status->id }}" @selected(($input['status_id'] ?? '') == $status->id)>
                                                {{ $status->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <p class="me-1 mt-3">
                                        {{ __('Aucun statut n\'est disponible pour le moment.') }}
                                    </p>
                                @endif
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

            @if(!@empty($lotteries->items()))
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
                                {{ __('Date') }}
                            </th>
                            <th scope="col" class="border-0">
                                {{ __('Cagnotte') }}
                            </th>
                            <th scope="col" class="border-0 rounded-end w-280px">
                                {{ __('Actions') }}
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($lotteries as $lottery)
                            <tr>
                                <!-- Image -->
                                <td>
                                    <div
                                        class="btn btn-round mb-0 bg-orange bg-opacity-10 text-orange w-70px h-70px d-flex justify-content-center align-items-center">
                                        @if(!@empty($lottery->image))
                                            <a href="#" role="button" data-bs-toggle="modal"
                                               data-bs-target="#lottery-image-modal-{{$lottery->id}}">
                                                <img class="" src="{{ '/storage/' . $lottery->image }}"
                                                     alt="{{ __('Image de la loterie :lottery-name', ['lottery-name' => $lottery->name]) }}">
                                            </a>
                                        @else
                                            <i class="bi bi-box fs-5"></i>
                                        @endif
                                    </div>
                                </td>

                                <!-- Nom -->
                                <td>
                                    <h6>
                                        @if(!@empty($lottery->name))
                                            {{ $lottery->name }}
                                        @else
                                            {{ __('-') }}
                                        @endif
                                    </h6>
                                    <p>
                                        @if(!is_null($lottery->deleted_at))
                                            <span class="badge bg-danger bg-opacity-10 text-danger">
                                                {{ __('Loterie supprimé') }}
                                            </span>
                                        @else
                                            @if(is_null($lottery->activated_at))
                                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                                    {{ __('Loterie inactif') }}
                                                </span>
                                            @else
                                                <span
                                                    class="badge bg-success bg-opacity-10 text-success">
                                                    {{ __('Loterie actif') }}
                                                </span>
                                            @endif
                                        @endif
                                    </p>
                                    <p>
                                        @if(!is_null($lottery->status))
                                            @if('WAITING_DRAW' == $lottery->status?->code)
                                                <span class="badge bg-warning bg-opacity-10 text-warning">
                                                    {{ __('En attente du tirage') }}
                                                </span>
                                            @elseif('NO_WINNER' == $lottery->status?->code)
                                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                                    {{ __('Aucun gagnant') }}
                                                </span>
                                            @elseif('A_WINNER' == $lottery->status?->code)
                                                <span class="badge bg-success bg-opacity-10 text-success">
                                                    {{ __('Un gagnant') }}
                                                </span>
                                            @elseif('MULTIPLE_WINNER' == $lottery->status?->code)
                                                <span class="badge bg-success bg-opacity-10 text-success">
                                                    {{ __('Plusieurs gagnants') }}
                                                </span>
                                            @endif
                                        @endif
                                    </p>
                                    <p>
                                        {{ __(':participants participant(s)', ['participants' => $lottery->users->count()]) }}
                                    </p>
                                </td>

                                <!-- Date -->
                                <td>
                                    <p>
                                        @if(!@empty($lottery->date))
                                            {{ $lottery->date }}
                                        @else
                                            {{ __('-') }}
                                        @endif
                                    </p>
                                </td>

                                <!-- Cagnotte -->
                                <td>
                                    <p>
                                        @if(!@empty($lottery->jackpot))
                                            {{ __(' :lottery_jackpot FCFA', ['lottery_jackpot' => number_format($lottery->jackpot, thousands_separator: ' ')]) }}
                                        @else
                                            {{ __('-') }}
                                        @endif
                                    </p>
                                </td>

                                <!-- Table actions -->
                                <td class="h-100">
                                    @if(!is_null($lottery->deleted_at))
                                        <p class="text-danger">
                                            {{ __('Loterie supprimé') }}
                                        </p>
                                    @else

                                        <a class="btn btn-info-soft btn-round me-1 mb-1 aec-click-modal"
                                           aec-modal-target="lottery-details-modal-{{$lottery->id}}"
                                           data-bs-toggle="tooltip" data-bs-placement="top"
                                           aria-label="{{ __('Détails') }}"
                                           data-bs-original-title="{{ __('Détails') }}">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="#" class="btn btn-info-soft btn-round me-1 mb-1 d-none"
                                           data-bs-toggle="modal"
                                           data-bs-target="#lottery-details-modal-{{$lottery->id}}">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="{{ route($profile . '.lottery.update', ['lottery' => $lottery]) }}"
                                           class="btn btn-warning-soft btn-round me-1 mb-1"
                                           data-bs-toggle="tooltip" data-bs-placement="top"
                                           aria-label="{{ __('Modifier') }}"
                                           data-bs-original-title="{{ __('Modifier') }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <a class="btn {{ (is_null($lottery->activated_at)) ? 'btn-primary-soft' : 'btn-danger-soft' }} btn-round me-1 mb-1 aec-click-modal"
                                           aec-modal-target="lottery-enable-disable-modal-{{$lottery->id}}"
                                           data-bs-toggle="tooltip" data-bs-placement="top"
                                           aria-label="{{ (is_null($lottery->activated_at)) ? __('Activer') : __('Désactiver') }}"
                                           data-bs-original-title="{{ (is_null($lottery->activated_at)) ? __('Activer') : __('Désactiver') }}">
                                            @if(is_null($lottery->activated_at))
                                                <i class=" bi bi-check"></i>
                                            @else
                                                <i class="bi bi-x"></i>
                                            @endif
                                        </a>

                                        <a href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#lottery-enable-disable-modal-{{$lottery->id}}"
                                           class="btn {{ (is_null($lottery->activated_at)) ? 'btn-primary-soft' : 'btn-danger-soft' }} btn-round me-1 mb-1 d-none">
                                            @if(is_null($lottery->activated_at))
                                                <i class=" bi bi-check"></i>
                                            @else
                                                <i class="bi bi-x"></i>
                                            @endif
                                        </a>

                                        <a
                                            class="btn btn-danger-soft btn-round aec-click-modal mb-1"
                                            aec-modal-target="lottery-delete-modal-{{$lottery->id}}"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top" aria-label="{{ __('Supprimer') }}"
                                            data-bs-original-title="{{ __('Supprimer') }}">
                                            <i class="bi bi-trash"></i>
                                        </a>

                                        <a href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#lottery-delete-modal-{{$lottery->id}}"
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
                {{ $lotteries->links() }}
                <!-- Pagination END -->
            @else
                <p>
                    {{ __('Aucune loterie trouvé.') }}
                </p>
            @endif
        </div>
        <!-- Card body START -->
    </div>
    <!-- Main content END -->


    @if(!@empty($lotteries->items()))
        @foreach($lotteries as $lottery)
            @if($lottery->image)
                <!-- Popup modal for lottery image START -->
                <div class="modal fade" id="lottery-image-modal-{{$lottery->id}}" tabindex="-1"
                     aria-labelledby="lottery-image-modal-{{$lottery->id}}"
                     aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="card-header-title mb-0">
                                    {{ __('Photo de la loterie') }}

                                    @if(@empty($lottery->name))
                                        {{ $lottery->name }}
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
                                        <img src="{{ "/storage/" . $lottery->image }}"
                                             alt="{{ __('Photo de la loterie :lottery-name', ['lottery-name' => $lottery->name]) }}"
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
                <!-- Popup modal for lottery image END -->
            @endif

            <!-- Popup modal for lottery details START -->
            <div class="modal fade" id="lottery-details-modal-{{$lottery->id}}" tabindex="-1"
                 aria-labelledby="lottery-details-modal-{{$lottery->id}}"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- Modal header -->
                        <div class="modal-header">
                            <h5 class="card-header-title mb-0">
                                {{ __('Détails sur la loterie : ') }}

                                @if(!@empty($lottery->name))
                                    {{ $lottery->name }}
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

                                        @if(!is_null($lottery->name))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Nom : ') }}
                                                </td>
                                                <td>
                                                    {{ $lottery->name }}
                                                    <p>
                                                        @if(!is_null($lottery->deleted_at))
                                                            <span class="badge bg-danger bg-opacity-10 text-danger">
                                                {{ __('Loterie supprimé') }}
                                            </span>
                                                        @else
                                                            @if(is_null($lottery->activated_at))
                                                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                                    {{ __('Loterie inactif') }}
                                                </span>
                                                            @else
                                                                <span
                                                                    class="badge bg-success bg-opacity-10 text-success">
                                                    {{ __('Loterie actif') }}
                                                </span>
                                                            @endif
                                                        @endif
                                                    </p>
                                                    <p>
                                                        @if(!is_null($lottery->status))
                                                            @if('WAITING_DRAW' == $lottery->status?->code)
                                                                <span
                                                                    class="badge bg-warning bg-opacity-10 text-warning">
                                                    {{ __('En attente du tirage') }}
                                                </span>
                                                            @elseif('NO_WINNER' == $lottery->status?->code)
                                                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                                    {{ __('Aucun gagnant') }}
                                                </span>
                                                            @elseif('A_WINNER' == $lottery->status?->code)
                                                                <span
                                                                    class="badge bg-success bg-opacity-10 text-success">
                                                    {{ __('Un gagnant') }}
                                                </span>
                                                            @elseif('MULTIPLE_WINNER' == $lottery->status?->code)
                                                                <span
                                                                    class="badge bg-success bg-opacity-10 text-success">
                                                    {{ __('Plusieurs gagnants') }}
                                                </span>
                                                            @endif
                                                        @endif
                                                    </p>
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($lottery->date))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Date : ') }}
                                                </td>
                                                <td>
                                                    {{ $lottery->date }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($lottery->jackpot))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Cagnotte : ') }}
                                                </td>
                                                <td>
                                                    {{ __(' :lottery_jackpot FCFA', ['lottery_jackpot' => number_format($lottery->jackpot, thousands_separator: ' ')]) }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($lottery->numbers_drawn))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Numéros tirés : ') }}
                                                </td>
                                                <td>
                                                    {{ $lottery->numbers_drawn }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($lottery->short_description))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Courte description : ') }}
                                                </td>
                                                <td>
                                                    {{ $lottery->short_description }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($lottery->description))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Description : ') }}
                                                </td>
                                                <td>
                                                    {{ $lottery->description }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($lottery->users))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Nombre de participants : ') }}
                                                </td>
                                                <td>
                                                    {{ $lottery->users->count() }}
                                                </td>
                                            </tr>
                                        @endif

                                        {{--Gerer le ou les gagnant(s)--}}
                                        @if(!is_null($lottery->gagnant))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Gagnant : ') }}
                                                </td>
                                                <td>
                                                    {{ $lottery->description }}
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
            <!-- Popup modal for lottery details END -->

            <!-- Popup modal for lottery enable disable START -->
            <div class="modal fade" id="lottery-enable-disable-modal-{{$lottery->id}}" tabindex="-1"
                 aria-labelledby="lottery-enable-disable-modal-{{$lottery->id}}"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <form
                        action="{{ route($profile . '.lottery.enable-disable', ['lottery' => $lottery, 'new_status' => (is_null($lottery->activated_at)) ? 'enable' : 'disable']) }}"
                        method="post">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="card-header-title mb-0">
                                    @if(is_null($lottery->activated_at))
                                        {{ __('Activer la loterie : ') }}
                                    @else
                                        {{ __('Désactiver la loterie : ') }}
                                    @endif

                                    @if(!@empty($lottery->name))
                                        {{ $lottery->name }}
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
                                    @if(is_null($lottery->activated_at))
                                        {{ __('Êtes vous sûr(e) de vouloir activer cette loterie ?') }}
                                    @else
                                        {{ __('Êtes vous sûr(e) de vouloir désactiver cette loterie ?') }}
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
                                    @if(is_null($lottery->activated_at))
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
            <!-- Popup modal for lottery enable disable END -->

            <!-- Popup modal for lottery delete START -->
            <div class="modal fade" id="lottery-delete-modal-{{$lottery->id}}" tabindex="-1"
                 aria-labelledby="lottery-delete-modal-{{$lottery->id}}"
                 aria-hidden="true">
                <div class="modal-dialog ">
                    <form action="{{ route($profile . '.lottery.delete', ['lottery' => $lottery]) }}" method="post">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="card-header-title mb-0">
                                    {{ __('Supprimer la loterie : ') }}

                                    @if(!@empty($lottery->name))
                                        {{ $lottery->name }}
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
                                    {{ __('Êtes vous sûr(e) de vouloir supprimer cette loterie ?') }}
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
            <!-- Popup modal for lottery delete END -->
        @endforeach
    @endif
@endsection
