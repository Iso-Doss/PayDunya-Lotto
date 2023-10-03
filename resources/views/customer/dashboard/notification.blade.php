{{-- resources/view/customer/dashboard/notification.blade.php --}}

@extends($profile . '.dashboard.base')

@section('title', __('Mes notifications'))

@section('main-content')

    <div class="card bg-transparent border rounded-3">
        <!-- Card header START -->
        <div class="card-header bg-transparent border-bottom">
            <div class="row mb-3">
                <div class="col-12 d-sm-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-2 mb-sm-0">
                        {{ __('Mes notifications') }}
                    </h1>
                    <div>
                        @if(sizeof((auth('customer')->user()->unreadNotifications)) > 0)
                            <p>
                                <a href="#" class="link-primary" data-bs-toggle="modal"
                                   data-bs-target="#mark-all-notifications-as-read-modal"
                                   class="btn btn-danger-soft btn-round mb-0 d-none" data-bs-toggle="tooltip"
                                   data-bs-placement="top"
                                   aria-label="{{ __('Marquer toutes les notifications comme lu') }}"
                                   data-bs-original-title="{{ __('Marquer toutes les notifications comme lu') }}">
                                    {{ __('Marquer toutes les notifications comme lu') }}
                                </a>
                            </p>
                        @endif

                        @if(sizeof((auth('customer')->user()->readNotifications)) > 0)
                            <p>
                                <a href="#" class="link-danger" data-bs-toggle="modal"
                                   data-bs-target="#mark-all-notifications-as-unread-modal"
                                   class="btn btn-danger-soft btn-round mb-0 d-none" data-bs-toggle="tooltip"
                                   data-bs-placement="top"
                                   aria-label="{{ __('Marquer toutes les notifications comme non lu') }}"
                                   data-bs-original-title="{{ __('Marquer toutes les notifications comme non lu') }}">
                                    {{ __('Marquer toutes les notifications comme non lu') }}
                                </a>
                            </p>
                        @endif

                        @if(sizeof((auth('customer')->user()->notifications)) > 0)
                            <p>
                                <a href="#" class="link-danger" data-bs-toggle="modal"
                                   data-bs-target="#delete-all-notifications"
                                   class="btn btn-danger-soft btn-round mb-0 d-none" data-bs-toggle="tooltip"
                                   data-bs-placement="top"
                                   aria-label="{{ __('Supprimer toutes les notifications') }}"
                                   data-bs-original-title="{{ __('Supprimer toutes les notifications') }}">
                                    {{ __('Supprimer toutes les notifications') }}
                                </a>
                            </p>
                        @endif
                    </div>
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
                          action="{{ route($profile . '.notification.index') }}">
                        @csrf

                        <div class="row g-3">

                            <!-- Entrepôt de la notification -->
                            <div class="col-xl-6">
                                <label for="notification-search" class="form-label">
                                    {{ __('Mots clés : ') }}
                                </label>
                                <input type="text" name="search" id="notification-search"
                                       class="form-control me-1 mt-2 notification-search @error('search'){{'is-invalid'}}@enderror"
                                       placeholder="{{ __('Recherche par des mots clés dans la notification') }}"
                                       value="{{ $input['search'] ?? '' }}">
                            </div>

                            <!-- Statut de la notification -->
                            <div class="col-xl-6">
                                <label for="notification-status" class="form-label">
                                    {{ __('Statut : ') }}
                                </label>
                                <select name="status" id="notification-status"
                                        class="form-select me-1 mt-2 notification-status">
                                    <option
                                        value="">{{ __('Recherche par le statut de la notification') }}</option>
                                    <option
                                        value="UNREAD" @selected(($input['status'] ?? '') == 'UNREAD')>
                                        {{ __('Non lu') }}
                                    </option>
                                    <option value="READ" @selected(($input['status'] ?? '') == 'READ')>
                                        {{ __('Lu') }}
                                    </option>
                                </select>
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

            @if(sizeof($notifications) > 0)
                <!-- Course list table START -->
                <div class="table-responsive border-0">
                    <table class="table table-dark-gray p-4 mb-0 table-hover">
                        <!-- Table head -->
                        <thead>
                        <tr>
                            <th scope="col" class="border-0">
                                {{ __('Titre') }}
                            </th>
                            <th scope="col" class="border-0 rounded-end d-none d-md-block">
                                {{ __('Actions') }}
                            </th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($notifications as $notification)
                            <tr>
                                <!-- Table data -->
                                <td>
                                    <h6>
                                        {{ (isset($notification->data['title']) && !empty($notification->data['title'])) ? $notification->data['title'] : '' }}
                                    </h6>
                                    @if(is_null($notification->read_at))
                                        <span href="#"
                                              class="badge bg-success bg-opacity-10 text-success">
                                                {{ __('Non lu') }}
                                            </span>
                                    @else
                                        <span href="#"
                                              class="badge bg-secondary bg-opacity-15 text-secondary">
                                            {{ __('Lu') }}
                                        </span>
                                    @endif
                                    <p class="mt-2 d-md-none">
                                        <a class="btn btn-info-soft btn-round me-1 mb-1 aec-click-modal"
                                           aec-modal-target="notification-details-modal-{{$notification->id}}"
                                           data-bs-toggle="tooltip" data-bs-placement="top"
                                           aria-label="{{ __('Détails') }}"
                                           data-bs-original-title="{{ __('Détails') }}">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-info-soft btn-round me-1 mb-1 d-none"
                                           data-bs-toggle="modal"
                                           data-bs-target="#notification-details-modal-{{$notification->id}}">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a class="btn {{ (is_null($notification->read_at)) ? 'btn-primary-soft' : 'btn-danger-soft' }} btn-round me-1 mb-1 aec-click-modal"
                                           aec-modal-target="notification-enable-disable-modal-{{$notification->id}}"
                                           data-bs-toggle="tooltip" data-bs-placement="top"
                                           aria-label="{{ (is_null($notification->read_at)) ? __('Marquer comme lu') : __('Marquer comme non lu') }}"
                                           data-bs-original-title="{{ (is_null($notification->read_at)) ? __('Marquer comme lu') : __('Marquer comme non lu') }}">
                                            @if(is_null($notification->read_at))
                                                <i class=" bi bi-check"></i>
                                            @else
                                                <i class="bi bi-x"></i>
                                            @endif
                                        </a>

                                        <a href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#notification-enable-disable-modal-{{$notification->id}}"
                                           class="btn {{ (is_null($notification->read_at)) ? 'btn-primary-soft' : 'btn-danger-soft' }} btn-round me-1 mb-1 d-none">
                                            @if(is_null($notification->read_at))
                                                <i class=" bi bi-check"></i>
                                            @else
                                                <i class="bi bi-x"></i>
                                            @endif
                                        </a>

                                        <a
                                            class="btn btn-danger-soft btn-round mb-0 aec-click-modal"
                                            aec-modal-target="notification-delete-modal-{{$notification->id}}"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top" aria-label="{{ __('Supprimer') }}"
                                            data-bs-original-title="{{ __('Supprimer') }}">
                                            <i class="bi bi-trash"></i>
                                        </a>

                                        <a href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#notification-delete-modal-{{$notification->id}}"
                                           class="btn btn-danger-soft btn-round mb-0 d-none"
                                           data-bs-toggle="tooltip"
                                           data-bs-placement="top" aria-label="{{ __('Supprimer') }}"
                                           data-bs-original-title="{{ __('Supprimer') }}">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </p>
                                </td>

                                <!-- Table actions -->
                                <td class="d-none d-md-block h-100">
                                    <a class="btn btn-info-soft btn-round me-1 mb-1 aec-click-modal"
                                       aec-modal-target="notification-details-modal-{{$notification->id}}"
                                       data-bs-toggle="tooltip" data-bs-placement="top"
                                       aria-label="{{ __('Détails') }}"
                                       data-bs-original-title="{{ __('Détails') }}">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-info-soft btn-round me-1 mb-1 d-none"
                                       data-bs-toggle="modal"
                                       data-bs-target="#notification-details-modal-{{$notification->id}}">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a class="btn {{ (is_null($notification->read_at)) ? 'btn-primary-soft' : 'btn-danger-soft' }} btn-round me-1 mb-1 aec-click-modal"
                                       aec-modal-target="notification-enable-disable-modal-{{$notification->id}}"
                                       data-bs-toggle="tooltip" data-bs-placement="top"
                                       aria-label="{{ (is_null($notification->read_at)) ? __('Marquer comme lu') : __('Marquer comme non lu') }}"
                                       data-bs-original-title="{{ (is_null($notification->read_at)) ? __('Marquer comme lu') : __('Marquer comme non lu') }}">
                                        @if(is_null($notification->read_at))
                                            <i class=" bi bi-check"></i>
                                        @else
                                            <i class="bi bi-x"></i>
                                        @endif
                                    </a>

                                    <a href="#"
                                       data-bs-toggle="modal"
                                       data-bs-target="#notification-enable-disable-modal-{{$notification->id}}"
                                       class="btn {{ (is_null($notification->read_at)) ? 'btn-primary-soft' : 'btn-danger-soft' }} btn-round me-1 mb-1 d-none">
                                        @if(is_null($notification->read_at))
                                            <i class=" bi bi-check"></i>
                                        @else
                                            <i class="bi bi-x"></i>
                                        @endif
                                    </a>

                                    <a
                                        class="btn btn-danger-soft btn-round mb-0 aec-click-modal"
                                        aec-modal-target="notification-delete-modal-{{$notification->id}}"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top" aria-label="{{ __('Supprimer') }}"
                                        data-bs-original-title="{{ __('Supprimer') }}">
                                        <i class="bi bi-trash"></i>
                                    </a>

                                    <a href="#"
                                       data-bs-toggle="modal"
                                       data-bs-target="#notification-delete-modal-{{$notification->id}}"
                                       class="btn btn-danger-soft btn-round mb-0 d-none"
                                       data-bs-toggle="tooltip"
                                       data-bs-placement="top" aria-label="{{ __('Supprimer') }}"
                                       data-bs-original-title="{{ __('Supprimer') }}">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <!-- Table body END -->
                    </table>
                </div>
                <!-- Course list table END -->

                <!-- Pagination START -->
                {{-- {{ $notifications->links() }}--}}
                <!-- Pagination END -->
            @else
                <p>
                    {{ __('Aucune notifications n\'est disponible pour le moment.') }}
                </p>
            @endif
        </div>
        <!-- Card body START -->
    </div>
    <!-- Main content END -->

    @if(!@empty($notifications))
        @foreach($notifications as $notification)

            <!-- Popup modal for notification details START -->
            <div class="modal fade" id="notification-details-modal-{{$notification->id}}" tabindex="-1"
                 aria-labelledby="notification-details-modal-{{$notification->id}}"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <!-- Modal header -->
                        <div class="modal-header">
                            <h5 class="card-header-title mb-0">
                                {{--{{ __('Détails sur la notification : :title', ['title' => (isset($notification->data['title']) && !empty($notification->data['title'])) ? $notification->data['title'] : '']) }}--}}
                                {{ __(':title', ['title' => (isset($notification->data['title']) && !empty($notification->data['title'])) ? $notification->data['title'] : '']) }}
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

                                        @if(isset($notification->data['message']) && !empty($notification->data['message']))
                                            <tr>
                                                <td>
                                                    {{  $notification->data['message'] }}
                                                </td>
                                            </tr>
                                        @endif

                                        {{--@if(isset($notification->data['view']) && !empty($notification->data['view']))--}}
                                        {{--<tr>--}}
                                        {{--    <td>--}}
                                        {{--        @dump($notification->data)--}}
                                        {{--        @php--}}
                                        {{--            $package = $notification->data['package'];--}}
                                        {{--        @endphp--}}
                                        {{--        @if('App\Notifications\UserAccountNotification' == $notification->type)--}}
                                        {{--        @include($notification->data['view'], $notification)--}}
                                        {{--        @endif--}}
                                        {{--    </td>--}}
                                        {{--</tr>--}}
                                        {{--@endif--}}

                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-success-soft mb-2 mb-sm-0"
                                    data-bs-dismiss="modal">
                                {{ __('Fermer') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Popup modal for notification details END -->

            <!-- Popup modal for notification enable disable START -->
            <div class="modal fade" id="notification-enable-disable-modal-{{$notification->id}}"
                 tabindex="-1"
                 aria-labelledby="notification-enable-disable-modal-{{$notification->id}}"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <form
                        action="{{ route($profile . '.notification.mark-as-read-or-as-unread', ['notification_id' => $notification, 'new_status' => (is_null($notification->read_at)) ? 'READ' : 'UNREAD'])  }}"
                        method="post">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="card-header-title mb-0">
                                    @if(is_null($notification->read_at))
                                        {{ __('Marquer la notification comme lu') }}
                                    @else
                                        {{ __('Marquer la notification comme non lu') }}
                                    @endif
                                </h5>
                                <button type="button" class="btn btn-sm btn-light mb-0"
                                        data-bs-dismiss="modal"
                                        aria-label="Close">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <p>
                                    @if(is_null($notification->read_at))
                                        {{ __('Êtes vous sure de vouloir marquer cette notification comme lu ?') }}
                                    @else
                                        {{ __('Êtes vous sure de vouloir marquer cette notification comme lu ?') }}
                                    @endif
                                </p>
                                @csrf
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-success-soft mb-2 mb-sm-0"
                                        data-bs-dismiss="modal">
                                    {{ __('Non') }}
                                </button>
                                <button type="submit" class="btn btn-danger mb-0">
                                    @if(is_null($notification->read_at))
                                        {{ __('Marquer comme lu') }}
                                    @else
                                        {{ __('Marquer comme non lu') }}
                                    @endif
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Popup modal for notification enable disable END -->

            <!-- Popup modal for notification delete START -->
            <div class="modal fade" id="notification-delete-modal-{{$notification->id}}" tabindex="-1"
                 aria-labelledby="notification-delete-modal-{{$notification->id}}"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <form
                        action=" {{ route($profile . '.notification.delete', ['notification_id' => $notification]) }}"
                        method="post">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="card-header-title mb-0">
                                    {{ __('Supprimer la notification') }}
                                </h5>
                                <button type="button" class="btn btn-sm btn-light mb-0"
                                        data-bs-dismiss="modal"
                                        aria-label="Close">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <p>
                                    {{ __('Êtes vous sure de vouloir supprimer  cette notification ?') }}
                                </p>
                                @csrf
                                @method('delete')
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-success-soft mb-2 mb-sm-0"
                                        data-bs-dismiss="modal">
                                    {{ __('Non') }}
                                </button>
                                <button type="submit" class="btn btn-danger mb-0">
                                    {{ __('Supprimer la notification') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Popup modal for notification delete END -->
        @endforeach
    @endif

    @if(sizeof((auth('customer')->user()->unreadNotifications)) > 0)
        <!-- Popup modal for mark all notifications as read START -->
        <div class="modal fade" id="mark-all-notifications-as-read-modal" tabindex="-1"
             aria-labelledby="mark-all-notifications-as-read-modal"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form
                    action="{{ route($profile . '.notification.mark-all-as-read-or-as-unread', ['new_status' => 'READ'])  }}"
                    method="post">
                    <div class="modal-content">
                        <!-- Modal header -->
                        <div class="modal-header">
                            <h5 class="card-header-title mb-0">
                                {{ __('Marquer toutes les notifications comme lu') }}
                            </h5>
                            <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal"
                                    aria-label="Close">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <p>
                                {{ __('Êtes vous sure de vouloir marquer toutes les notifications comme lu ?') }}
                            </p>
                            @csrf
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-success-soft mb-2 mb-sm-0"
                                    data-bs-dismiss="modal">
                                {{ __('Non') }}
                            </button>
                            <button type="submit" class="btn btn-danger mb-0">
                                {{ __('Marquer comme lu') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Popup modal for mark all notifications as read END -->
    @endif

    @if(sizeof((auth('customer')->user()->readNotifications)) > 0)
        <!-- Popup modal for mark all notifications as unread START -->
        <div class="modal fade" id="mark-all-notifications-as-unread-modal" tabindex="-1"
             aria-labelledby="mark-all-notifications-as-unread-modal"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form
                    action="{{ route($profile . '.notification.mark-all-as-read-or-as-unread', ['new_status' => 'UNREAD'])  }}"
                    method="post">
                    <div class="modal-content">
                        <!-- Modal header -->
                        <div class="modal-header">
                            <h5 class="card-header-title mb-0">
                                {{ __('Marquer toutes les notifications comme non lu') }}
                            </h5>
                            <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal"
                                    aria-label="Close">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <p>
                                {{ __('Êtes vous sure de vouloir marquer toutes les notifications comme non lu ?') }}
                            </p>
                            @csrf
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-success-soft mb-2 mb-sm-0"
                                    data-bs-dismiss="modal">
                                {{ __('Non') }}
                            </button>
                            <button type="submit" class="btn btn-danger mb-0">
                                {{ __('Marquer comme non lu') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Popup modal for mark all notifications as unread END -->
    @endif

    @if(sizeof((auth('customer')->user()->notifications)) > 0)
        <!-- Popup modal for delete all notifications START -->
        <div class="modal fade" id="delete-all-notifications" tabindex="-1"
             aria-labelledby="delete-all-notifications"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form
                    action="{{ route($profile . '.notification.delete-all')  }}"
                    method="post">
                    @method('delete')
                    <div class="modal-content">
                        <!-- Modal header -->
                        <div class="modal-header">
                            <h5 class="card-header-title mb-0">
                                {{ __('Supprimer toutes les notifications') }}
                            </h5>
                            <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal"
                                    aria-label="Close">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <p>
                                {{ __('Êtes vous sure de vouloir supprimer toutes les notifications ?') }}
                            </p>
                            @csrf
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-success-soft mb-2 mb-sm-0"
                                    data-bs-dismiss="modal">
                                {{ __('Non') }}
                            </button>
                            <button type="submit" class="btn btn-danger mb-0">
                                {{ __('Supprimer') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Popup modal for delete all notifications END -->
    @endif
@endsection
