{{-- resources/view/customer/dashboard/transaction.blade.php --}}

@extends($profile . '.dashboard.base')

@section('title', __('Mes transactions'))

@section('main-content')

    <div class="card bg-transparent border rounded-3">
        <!-- Card header START -->
        <div class="card-header bg-transparent border-bottom">
            <div class="row mb-3">
                <div class="col-12 d-sm-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-2 mb-sm-0">
                        {{ __('Mes transactions') }}
                    </h1>
                </div>
            </div>
        </div>
        <!-- Card header END -->

        <!-- Card body START -->
        <div class=" card-body">
            <!-- Search and select START -->
            <div class="row g-3 align-items-center justify-content-between mb-4">
                <!-- Content -->
                <div class="col-md-12">
                    <form class="rounded position-relative"
                          action="{{ route($profile . '.transaction.index') }}">
                        @csrf

                        <div class="row g-3">

                            <!-- Lottery -->
                            <div class="col-xl-6">
                                <label for="transaction-lottery-id" class="form-label">
                                    {{ __('Loterie : ') }}
                                </label>
                                @if(!empty($lotteries))
                                    <select name="lottery_id" id="transaction-lottery-id"
                                            class="form-select me-1 mt-2 transaction-lottery-id @error('lottery_id'){{'is-invalid'}}@enderror">
                                        <option value="">
                                            {{ __('Veuillez sélectionner la loterie') }}
                                        </option>
                                        @foreach($lotteries as $lottery)
                                            <option
                                                value="{{ $lottery->id }}" @selected(($input['lottery_id'] ?? '') == $lottery->id)>
                                                {{ $lottery->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <p class="me-1 mt-3">
                                        {{ __('Aucune loterie n\'est disponible pour le moment.') }}
                                    </p>
                                @endif
                            </div>

                            <!-- Transaction type -->
                            <div class="col-xl-6">
                                <label for="transaction-transaction-type-id" class="form-label">
                                    {{ __('Transaction : ') }}
                                </label>
                                @if(!empty($transactionTypes))
                                    <select name="transaction_type_id" id="transaction-transaction-type-id"
                                            class="form-select me-1 mt-2 transaction-transaction-type-id @error('transaction_type_id'){{'is-invalid'}}@enderror">
                                        <option value="">
                                            {{ __('Veuillez sélectionner le Transaction') }}
                                        </option>
                                        @foreach($transactionTypes as $transactionType)
                                            <option
                                                value="{{ $transactionType->id }}" @selected(($input['transaction_type_id'] ?? '') == $transactionType->id)>
                                                {{ $transactionType->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <p class="me-1 mt-3">
                                        {{ __('Aucun Transaction n\'est disponible pour le moment.') }}
                                    </p>
                                @endif
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

                            <div>
                                <button class="btn btn-primary mb-0 rounded z-index-1 w-100 me-1 mt-2"
                                        type="submit">
                                    <i class="fas fa-search"></i>
                                    {{ __('Rechercher') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Search and select END -->

            @if(!@empty($transactions->items()))
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
                                {{ __('Utilisateur') }}
                            </th>
                            <th scope="col" class="border-0">
                                {{ __('Loterie') }}
                            </th>
                            <th scope="col" class="border-0">
                                {{ __('Type de transaction') }}
                            </th>
                            <th scope="col" class="border-0">
                                {{ __('Montant') }}
                            </th>
                            <th scope="col" class="border-0 rounded-end w-280px">
                                {{ __('Actions') }}
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <!-- Image -->
                                <td>
                                    <div
                                        class="btn btn-round mb-0 bg-orange bg-opacity-10 text-orange w-70px h-70px d-flex justify-content-center align-items-center">
                                        @if(!@empty($transaction->image))
                                            <a href="#" role="button" data-bs-toggle="modal"
                                               data-bs-target="#transaction-image-modal-{{$transaction->id}}">
                                                <img class="" src="{{ '/storage/' . $transaction->image }}"
                                                     alt="{{ __('Image de la transaction :transaction-name', ['transaction-name' => $transaction->name]) }}">
                                            </a>
                                        @else
                                            <i class="bi bi-wallet fs-5"></i>
                                        @endif
                                    </div>
                                </td>

                                <!-- User -->
                                <td>
                                    <h6>
                                        @if(!@empty($transaction->user))
                                            {{ $transaction->user->first_name . ' ' . $transaction->user->last_name . ' ('. $transaction->user->email .')' }}
                                        @else
                                            {{ __('-') }}
                                        @endif
                                    </h6>
                                    <p>
                                        @if(!is_null($transaction->deleted_at))
                                            <span class="badge bg-danger bg-opacity-10 text-danger">
                                                {{ __('Transaction supprimé') }}
                                            </span>
                                        @else
                                            @if(is_null($transaction->activated_at))
                                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                                    {{ __('Transaction inactif') }}
                                                </span>
                                            @else
                                                <span
                                                    class="badge bg-success bg-opacity-10 text-success">
                                                    {{ __('Transaction actif') }}
                                                </span>
                                            @endif
                                        @endif
                                    </p>
                                    <p>
                                        @if(!is_null($transaction->status))
                                            @if('WAITING' == $transaction->status?->code)
                                                <span class="badge bg-warning bg-opacity-10 text-warning">
                                                    {{ __('Transaction en attente') }}
                                                </span>
                                            @elseif('SUCCESS' == $transaction->status?->code)
                                                <span
                                                    class="badge bg-success bg-opacity-10 text-success">
                                                    {{ __('Transaction effectué avec succès') }}
                                                </span>
                                            @endif
                                        @endif
                                    </p>
                                </td>

                                <!-- Lottery -->
                                <td>
                                    <p>
                                        @if(!@empty($transaction->lottery))
                                            {{ $transaction->lottery->name }}
                                        @else
                                            {{ __('-') }}
                                        @endif
                                    </p>
                                </td>

                                <!-- Transaction type -->
                                <td>
                                    <p>
                                        @if(!@empty($transaction->transactionType))
                                            {{ $transaction->transactionType->name }}
                                        @else
                                            {{ __('-') }}
                                        @endif
                                    </p>
                                </td>

                                <!-- Amount -->
                                <td>
                                    <p>
                                        @if(!@empty($transaction->amount))
                                            {{ __(' :transaction_amount FCFA', ['transaction_amount' => number_format($transaction->amount, thousands_separator: ' ')]) }}
                                        @else
                                            {{ __('-') }}
                                        @endif
                                    </p>
                                </td>

                                <!-- Table actions -->
                                <td>
                                    @if(!is_null($transaction->deleted_at))
                                        <p class="text-danger">
                                            {{ __('Transaction supprimé') }}
                                        </p>
                                    @else

                                        <a class="btn btn-info-soft btn-round me-1 mb-1 aec-click-modal"
                                           aec-modal-target="transaction-details-modal-{{$transaction->id}}"
                                           data-bs-toggle="tooltip" data-bs-placement="top"
                                           aria-label="{{ __('Détails') }}"
                                           data-bs-original-title="{{ __('Détails') }}">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="#" class="btn btn-info-soft btn-round me-1 mb-1 d-none"
                                           data-bs-toggle="modal"
                                           data-bs-target="#transaction-details-modal-{{$transaction->id}}">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        {{--<a href="{{ route($profile . '.transaction.update', ['transaction' => $transaction]) }}"--}}
                                        {{--   class="btn btn-warning-soft btn-round me-1 mb-1"--}}
                                        {{--   data-bs-toggle="tooltip" data-bs-placement="top"--}}
                                        {{--   aria-label="{{ __('Modifier') }}"--}}
                                        {{--   data-bs-original-title="{{ __('Modifier') }}">--}}
                                        {{--    <i class="bi bi-pencil-square"></i>--}}
                                        {{--</a>--}}

                                        <a class="btn {{ (is_null($transaction->activated_at)) ? 'btn-primary-soft' : 'btn-danger-soft' }} btn-round me-1 mb-1 aec-click-modal"
                                           aec-modal-target="transaction-enable-disable-modal-{{$transaction->id}}"
                                           data-bs-toggle="tooltip" data-bs-placement="top"
                                           aria-label="{{ (is_null($transaction->activated_at)) ? __('Activer') : __('Désactiver') }}"
                                           data-bs-original-title="{{ (is_null($transaction->activated_at)) ? __('Activer') : __('Désactiver') }}">
                                            @if(is_null($transaction->activated_at))
                                                <i class=" bi bi-check"></i>
                                            @else
                                                <i class="bi bi-x"></i>
                                            @endif
                                        </a>

                                        <a href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#transaction-enable-disable-modal-{{$transaction->id}}"
                                           class="btn {{ (is_null($transaction->activated_at)) ? 'btn-primary-soft' : 'btn-danger-soft' }} btn-round me-1 mb-1 d-none">
                                            @if(is_null($transaction->activated_at))
                                                <i class=" bi bi-check"></i>
                                            @else
                                                <i class="bi bi-x"></i>
                                            @endif
                                        </a>

                                        <a
                                                class="btn btn-danger-soft btn-round aec-click-modal mb-1"
                                                aec-modal-target="transaction-delete-modal-{{$transaction->id}}"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top" aria-label="{{ __('Supprimer') }}"
                                                data-bs-original-title="{{ __('Supprimer') }}">
                                            <i class="bi bi-trash"></i>
                                        </a>

                                        <a href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#transaction-delete-modal-{{$transaction->id}}"
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
                {{ $transactions->links() }}
                <!-- Pagination END -->
            @else
                <p>
                    {{ __('Aucune transaction trouvée.') }}
                </p>
            @endif
        </div>
        <!-- Card body START -->
    </div>
    <!-- Main content END -->
    @if(!@empty($transactions->items()))
        @foreach($transactions as $transaction)
            @if($transaction->image)
                <!-- Popup modal for transaction image START -->
                <div class="modal fade"
                     id="transaction-image-modal-{{$transaction->id}}"
                     tabindex="-1"
                     aria-labelledby="transaction-image-modal-{{$transaction->id}}"
                     aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="card-header-title mb-0">
                                    {{ __('Photo de la transaction') }}

                                    @if(@empty($transaction->name))
                                        {{ $transaction->name }}
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
                                        <img src="{{ "/storage/" . $transaction->image }}"
                                             alt="{{ __('Photo de la transaction :transaction-name', ['transaction-name' => $transaction->name]) }}"
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
                <!-- Popup modal for transaction image END -->
            @endif

            <!-- Popup modal for transaction details START -->
            <div class="modal fade"
                 id="transaction-details-modal-{{$transaction->id}}"
                 tabindex="-1"
                 aria-labelledby="transaction-details-modal-{{$transaction->id}}"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- Modal header -->
                        <div class="modal-header">
                            <h5 class="card-header-title mb-0">
                                {{ __('Détails sur la transaction : ') }}

                                @if(!@empty($transaction->name))
                                    {{ $transaction->name }}
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

                                        @if(!is_null($transaction->user))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Utilisateur : ') }}
                                                </td>
                                                <td>
                                                    {{ $transaction->user->first_name . ' ' . $transaction->user->last_name . ' ('. $transaction->user->email .')' }}
                                                    <p>
                                                        @if(!is_null($transaction->deleted_at))
                                                            <span class="badge bg-danger bg-opacity-10 text-danger">
                                                {{ __('Transaction supprimé') }}
                                            </span>
                                                        @else
                                                            @if(is_null($transaction->activated_at))
                                                                <span class="badge bg-danger bg-opacity-10 text-danger">
                                                    {{ __('Transaction inactif') }}
                                                </span>
                                                            @else
                                                                <span
                                                                    class="badge bg-success bg-opacity-10 text-success">
                                                    {{ __('Transaction actif') }}
                                                </span>
                                                            @endif
                                                        @endif
                                                    </p>
                                                    <p>
                                                        @if(!is_null($transaction->status))
                                                            @if('WAITING' == $transaction->status?->code)
                                                                <span
                                                                    class="badge bg-warning bg-opacity-10 text-warning">
                                                    {{ __('Transaction en attente') }}
                                                </span>
                                                            @elseif('SUCCESS' == $transaction->status?->code)
                                                                <span
                                                                    class="badge bg-success bg-opacity-10 text-success">
                                                    {{ __('Transaction effectué avec succès') }}
                                                </span>
                                                            @endif
                                                        @endif
                                                    </p>
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($transaction->lottery))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Loterie : ') }}
                                                </td>
                                                <td>
                                                    {{ $transaction->lottery->name }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($transaction->ticket))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Billet : ') }}
                                                </td>
                                                <td>
                                                    {{ $transaction->ticket->name }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($transaction->transactionType))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Type de transaction : ') }}
                                                </td>
                                                <td>
                                                    {{ $transaction->transactionType->name }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($transaction->amount))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Montant : ') }}
                                                </td>
                                                <td>
                                                    {{ __(' :transaction_amount FCFA', ['transaction_amount' => number_format($transaction->amount, thousands_separator: ' ')]) }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if(!is_null($transaction->details))
                                            <tr>
                                                <td class="fw-bold">
                                                    {{ __('Détails : ') }}
                                                </td>
                                                <td>
                                                    {{ $transaction->details }}
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
            <!-- Popup modal for transaction details END -->

            <!-- Popup modal for transaction enable disable START -->
            <div class="modal fade"
                 id="transaction-enable-disable-modal-{{$transaction->id}}"
                 tabindex="-1"
                 aria-labelledby="transaction-enable-disable-modal-{{$transaction->id}}"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <form
                        action="{{ route($profile . '.transaction.enable-disable', ['transaction' => $transaction->id, 'new_status' => (is_null($transaction->activated_at)) ? 'enable' : 'disable']) }}"
                        method="post">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="card-header-title mb-0">
                                    @if(is_null($transaction->activated_at))
                                        {{ __('Activer la transaction : ') }}
                                    @else
                                        {{ __('Désactiver la transaction : ') }}
                                    @endif

                                    @if(!@empty($transaction->name))
                                        {{ $transaction->name }}
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
                                    @if(is_null($transaction->activated_at))
                                        {{ __('Êtes vous sûr(e) de vouloir activer cette transaction ?') }}
                                    @else
                                        {{ __('Êtes vous sûr(e) de vouloir désactiver cette transaction ?') }}
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
                                    @if(is_null($transaction->activated_at))
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
            <!-- Popup modal for transaction enable disable END -->

            <!-- Popup modal for transaction delete START -->
            <div class="modal fade"
                 id="transaction-delete-modal-{{$transaction->id}}"
                 tabindex="-1"
                 aria-labelledby="transaction-delete-modal-{{$transaction->id}}"
                 aria-hidden="true">
                <div class="modal-dialog ">
                    <form
                        action="{{ route($profile . '.transaction.delete', ['transaction' => $transaction->id]) }}"
                        method="post">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="card-header-title mb-0">
                                    {{ __('Supprimer la transaction : ') }}

                                    @if(!@empty($transaction->name))
                                        {{ $transaction->name }}
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
                                    {{ __('Êtes vous sûr(e) de vouloir supprimer cette transaction ?') }}
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
            <!-- Popup modal for transaction delete END -->
        @endforeach
    @endif
@endsection
