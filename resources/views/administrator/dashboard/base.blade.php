{{-- resources/view/administrator/dashboard/base.blade.php --}}

@extends($profile . '.base')

@php
    $routeName = request()->route()?->getName();
    $notifications = !empty(auth('administrator')->user()) ? auth('administrator')->user()->notifications : '';
@endphp

@section('main')
    <!-- **************** MAIN CONTENT START **************** -->
    <main>

        <!-- Sidebar START -->
        <nav class="navbar sidebar navbar-expand-xl navbar-dark bg-dark">

            <!-- Navbar brand for xl START -->
            <div class="d-flex align-items-center justify-content-center">
                <a class="navbar-brand" href="{{ route($profile . '.dashboard') }}">
                    <span style="color: #0972b5" class="fs-3 navbar-brand-item">PayDunya Lotto</span>
                </a>
            </div>
            <!-- Navbar brand for xl END -->

            <div class="offcanvas offcanvas-start flex-row custom-scrollbar h-100" data-bs-backdrop="true" tabindex="-1"
                 id="offcanvasSidebar">
                <div class="offcanvas-body sidebar-content d-flex flex-column bg-dark">

                    <!-- Sidebar menu START -->
                    <ul class="navbar-nav flex-column" id="navbar-sidebar">

                        <li class="nav-item">
                            <a href="{{ route($profile . '.lottery.index') }}"
                               class="nav-link @if(str_starts_with($routeName, $profile . '.lottery.')) active @endif">
                                <i class="fas fa-home fa-fw me-2"></i>
                                {{ __('Loteries') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route($profile . '.user.index') }}"
                               class="nav-link @if(str_starts_with($routeName, $profile . '.user.')) active @endif">
                                <i class="fas fa-user fa-fw me-2"></i>
                                {{ __('Utilisateurs') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route($profile . '.country.index') }}"
                               class="nav-link @if(str_starts_with($routeName, $profile . '.country.')) active @endif">
                                <i class="bi bi-globe fa-fw me-2"></i>
                                {{ __('Pays') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route($profile . '.status.index') }}"
                               class="nav-link @if(str_starts_with($routeName, $profile . '.status.')) active @endif">
                                <i class="bi bi-check-circle fa-fw me-2"></i>
                                {{ __('Statuts') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route($profile . '.ticket.index') }}"
                               class="nav-link @if(str_starts_with($routeName, $profile . '.ticket.')) active @endif">
                                <i class="bi bi-ticket fa-fw me-2"></i>
                                {{ __('Billets') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route($profile . '.transaction-type.index') }}"
                               class="nav-link @if(str_starts_with($routeName, $profile . '.transaction-type.')) active @endif">
                                <i class="bi bi-wallet fa-fw me-2"></i>
                                {{ __('Types de transaction') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route($profile . '.transaction.index') }}"
                               class="nav-link @if(str_starts_with($routeName, $profile . '.transaction.')) active @endif">
                                <i class="bi bi-wallet fa-fw me-2"></i>
                                {{ __('Transactions') }}
                            </a>
                        </li>

                    </ul>
                    <!-- Sidebar menu end -->

                    <!-- Sidebar footer START -->
                    <div class="px-3 mt-auto pt-3">
                        <div class="d-flex align-items-center justify-content-between text-primary-hover">
                            <a class="h5 mb-0 text-body @if(str_starts_with($routeName, $profile . '.profile.')) active @endif"
                               href="{{ route($profile . '.profile.index') }}"
                               data-bs-toggle="tooltip"
                               data-bs-placement="top" title="{{ __('Profil') }}">
                                <i class="bi bi-person fa-fw"></i>
                            </a>
                            <a class="h5 mb-0 text-body" href="{{ route('customer.index') }}" data-bs-toggle="tooltip"
                               target="_blank"
                               data-bs-placement="top" title="{{ __('Interface client') }}">
                                <i class="bi bi-globe"></i>
                            </a>
                            <form method="post" action="{{ route($profile . '.auth.sign-out') }}">
                                @csrf
                                <button type="submit" class="h5 mb-0 text-body aec-sign-out-btn"
                                        href="{{ route($profile . '.auth.sign-out') }}"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="{{ __('Déconnexion') }}">
                                    <i class="bi bi-power"></i>
                                </button>
                            </form>
                            {{--<a class="h5 mb-0 text-body" href="{{ route($profile . '.auth.sign-out') }}"--}}
                            {{--   data-bs-toggle="tooltip"--}}
                            {{--   data-bs-placement="top" title="{{ __('Déconnexion') }}">--}}
                            {{--    <i class="bi bi-power"></i>--}}
                            {{--</a>--}}
                        </div>
                    </div>
                    <!-- Sidebar footer END -->

                </div>
            </div>
        </nav>
        <!-- Sidebar END -->

        <!-- Page content START -->
        <div class="page-content">

            <!-- Top bar START -->
            <nav class="navbar top-bar navbar-light border-bottom py-0 py-xl-3">
                <div class="container-fluid p-0">
                    <div class="d-flex align-items-center w-100">

                        <!-- Logo START -->
                        <div class="d-flex align-items-center d-xl-none">
                            <a class="navbar-brand" href="{{ route($profile . '.dashboard') }}">
                                <span style="color: #0972b5" class="fs-3 navbar-brand-item">PayDunya Lotto</span>
                            </a>
                        </div>
                        <!-- Logo END -->

                        <!-- Toggler for sidebar START -->
                        <div class="navbar-expand-xl sidebar-offcanvas-menu">
                            <button class="navbar-toggler me-auto" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar"
                                    aria-expanded="false" aria-label="Toggle navigation" data-bs-auto-close="outside">
                                <i class="bi bi-text-right fa-fw h2 lh-0 mb-0 rtl-flip"
                                   data-bs-target="#offcanvasMenu"> </i>
                            </button>
                        </div>
                        <!-- Toggler for sidebar END -->

                        <!-- Top bar left -->
                        <div class="navbar-expand-lg ms-auto ms-xl-0">

                            {{--<!-- Topbar menu START -->--}}
                            {{--<div class="collapse navbar-collapse w-100" id="navbarTopContent">--}}
                            {{--    <!-- Top search START -->--}}
                            {{--    <div class="nav my-3 my-xl-0 flex-nowrap align-items-center">--}}
                            {{--        <div class="nav-item w-100">--}}
                            {{--            <form class="position-relative">--}}
                            {{--                <input class="form-control pe-5 bg-secondary bg-opacity-10 border-0"--}}
                            {{--                       type="search" placeholder="Search" aria-label="Search">--}}
                            {{--                <button--}}
                            {{--                    class="bg-transparent px-2 py-0 border-0 position-absolute top-50 end-0 translate-middle-y"--}}
                            {{--                    type="submit"><i class="fas fa-search fs-6 text-primary"></i></button>--}}
                            {{--            </form>--}}
                            {{--        </div>--}}
                            {{--    </div>--}}
                            {{--    <!-- Top search END -->--}}
                            {{--</div>--}}
                            {{--<!-- Topbar menu END -->--}}
                        </div>
                        <!-- Top bar left END -->

                        <!-- Top bar right START -->
                        <div class="ms-xl-auto">
                            <ul class="navbar-nav flex-row align-items-center">

                                <!-- Notification dropdown START -->
                                <li class="nav-item ms-2 ms-md-3 dropdown">
                                    <!-- Notification button -->
                                    <a class="btn btn-light btn-round mb-0" href="#" role="button"
                                       data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                                        <i class="bi bi-bell fa-fw"></i>
                                    </a>
                                    <!-- Notification dote -->
                                    @if(auth('administrator')->user()->unreadNotifications->count() > 0)
                                        <span class="notif-badge animation-blink"></span>
                                    @endif

                                    <!-- Notification dropdown menu START -->
                                    <div
                                        class="dropdown-menu dropdown-animation dropdown-menu-end dropdown-menu-size-md p-0 shadow-lg border-0">
                                        <div class="card bg-transparent">
                                            <div
                                                class="card-header bg-transparent border-bottom py-4 d-flex justify-content-between align-items-center">
                                                <h6 class="m-0">
                                                    {{ __('Notifications') }}
                                                    @if(sizeof($notifications) > 0)
                                                        <span class="badge bg-success bg-opacity-10 text-success ms-2">
                                                    {{ __(':nbr-notification nouveaux', ['nbr-notification' => auth('administrator')->user()->unreadNotifications->count()]) }}
                                                </span>
                                                    @endif
                                                </h6>
                                            </div>

                                            <div class="card-body p-0">
                                                <ul class="list-group list-unstyled list-group-flush">
                                                    <!-- Notif item -->
                                                    @if(sizeof($notifications) > 0)
                                                        @php $last = 3; @endphp
                                                        @foreach($notifications as $notification)
                                                            @if($last > 0)
                                                                <li>
                                                                    <form
                                                                        action="{{ route($profile . '.notification.mark-as-read-or-as-unread', ['notification_id' => $notification, 'new_status' => 'READ']) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <div
                                                                            class="list-group-item-action border-0 border-bottom d-flex p-3">
                                                                            <div class="me-3">
                                                                                <div
                                                                                    class="mb-0 w-50px h-50px btn btn-round bg-orange bg-opacity-10 text-orange d-flex justify-content-center align-items-center">
                                                                                    @if('App\Notifications\UserAccountNotification' == $notification->type)
                                                                                        @if(!@empty(auth('administrator')->user()->avatar))
                                                                                            <img
                                                                                                class="avatar-img rounded-circle"
                                                                                                src="{{ '/storage/' . auth('administrator')->user()->avatar }}"
                                                                                                alt="{{ __('Avatar de l\'utilisateur') }}">
                                                                                        @elseif(!@empty(auth('administrator')->user()->first_name) && !@empty(auth('administrator')->user()->last_name))
                                                                                            <span
                                                                                                class="text-orange position-absolute top-50 start-50 translate-middle fw-bold">
                                                                                                {{ substr(auth('administrator')->user()->first_name ?? 'A', 0, 1) }}
                                                                                                {{ substr(auth('administrator')->user()->last_name ?? 'E', 0, 1) }}
                                                                                            </span>
                                                                                        @else
                                                                                            <i class="fas fa-user fs-5"></i>
                                                                                        @endif
                                                                                    @elseif ('App\Notifications\PackageNotification' == $notification->type)
                                                                                        @if(!@empty($package->image))
                                                                                            <a href="#" role="button"
                                                                                               data-bs-toggle="modal"
                                                                                               data-bs-target="#package-image-modal-{{$package->id}}">
                                                                                                <img class=""
                                                                                                     src="{{ '/storage/' . $package->image }}"
                                                                                                     alt="{{ __('Image du colis') }}">
                                                                                            </a>
                                                                                        @else
                                                                                            <i class="fas fa-box fs-5"></i>
                                                                                        @endif
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div>
                                                                                <p class="text-body small m-0">
                                                                                    {{ $notification->data['title'] }}
                                                                                    @if($notification->unread())
                                                                                        <span
                                                                                            class="badge bg-success bg-opacity-10 text-success ms-2">
                                                                                    {{ __('Nouveau') }}
                                                                                </span>
                                                                                    @endif
                                                                                </p>
                                                                                {{--@if($notification->unread())--}}
                                                                                {{--    <button type="submit"--}}
                                                                                {{--            class="aec-notification-link text-body small mt-2">--}}
                                                                                {{--        {{ __('Marquer comme lu') }}--}}
                                                                                {{--    </button>--}}
                                                                                {{--@endif--}}
                                                                            </div>
                                                                        </div>
                                                                    </form>

                                                                </li>
                                                            @endif
                                                            @php $last--; @endphp
                                                        @endforeach
                                                    @else
                                                        <p class="text-center mt-3">{{__('Aucune notifications disponible')}}</p>
                                                    @endif
                                                </ul>
                                            </div>
                                            <!-- Button -->
                                            <div
                                                class="card-footer bg-transparent border-0 py-3 text-center position-relative">
                                                <a href="{{ route($profile . '.notification.index') }}"
                                                   class="stretched-link">
                                                    {{ __('Voir toutes les activités récentes') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Notification dropdown menu END -->
                                </li>
                                <!-- Notification dropdown END -->

                                <!-- Profile dropdown START -->
                                <li class="nav-item ms-2 ms-md-3 dropdown">
                                    <!-- Profile button -->
                                    <a class="btn btn-round mb-0 bg-orange bg-opacity-10 text-orange d-flex justify-content-center align-items-center"
                                       href="#"
                                       role="button"
                                       data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                                        @if(!@empty(auth('administrator')->user()->avatar))
                                            <img class="avatar-img rounded-circle"
                                                 src="{{ '/storage/' . auth('administrator')->user()->avatar }}"
                                                 alt="{{ __('Avatar de l\'utilisateur') }}">
                                        @elseif(!@empty(auth('administrator')->user()->first_name) && !@empty(auth('administrator')->user()->last_name))
                                            <span
                                                class="text-orange position-absolute top-50 start-50 translate-middle fw-bold">
                                                {{ substr(auth('administrator')->user()->first_name ?? 'A', 0, 1) }}
                                                {{ substr(auth('administrator')->user()->last_name ?? 'E', 0, 1) }}
                                            </span>
                                        @else
                                            <i class="fas fa-user fs-5"></i>
                                        @endif
                                    </a>

                                    <!-- Profile dropdown START -->
                                    <ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3"
                                        aria-labelledby="profileDropdown">
                                        <!-- Profile info -->
                                        <li class="px-3">
                                            <div class="d-flex align-items-center">
                                                <!-- Avatar -->
                                                <div class="avatar me-3 mb-3">
                                                    @if(!@empty(auth('administrator')->user()->avatar))
                                                        <!-- Avatar -->
                                                        <div class="avatar me-3">
                                                            <img class="avatar-img rounded-circle shadow"
                                                                 src="{{ '/storage/' . auth('administrator')->user()->avatar }}"
                                                                 alt="{{ __('Avatar de l\'utilisateur') }}">
                                                        </div>
                                                    @elseif(!@empty(auth('administrator')->user()->first_name) && !@empty(auth('administrator')->user()->last_name))
                                                        <div class="avatar avatar-md flex-shrink-0 me-3">
                                                            <div
                                                                class="avatar-img rounded-circle bg-orange bg-opacity-10">
                                        <span
                                            class="text-orange position-absolute top-50 start-50 translate-middle fw-bold">
                                            {{ substr(auth('administrator')->user()->first_name ?? 'A', 0, 1) }}
                                            {{ substr(auth('administrator')->user()->last_name ?? 'E', 0, 1) }}
                                        </span>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div
                                                            class="icon-lg bg-orange rounded-circle bg-opacity-10 text-orange rounded-2 flex-shrink-0 me-3">
                                                            <i class="fas fa-user fs-5"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <a class="h6" href="#">
                                                        <div>
                                                            @if(!@empty(auth('administrator')->user()->first_name))
                                                                {{ auth('administrator')->user()->first_name }}
                                                            @endif
                                                            @if(!@empty(auth('administrator')->user()->last_name))
                                                                {{ auth('administrator')->user()->last_name }}
                                                            @endif

                                                            @if(!@empty(auth('administrator')->user()->user_name))
                                                                {{ '(@' . auth('administrator')->user()->user_name . ')' }}
                                                            @endif

                                                            @if(!@empty(auth('administrator')->user()->email))
                                                                <p class="small m-0">
                                                                    {{ auth('administrator')->user()->email }}
                                                                </p>
                                                            @endif
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item @if(str_starts_with($routeName, $profile . '.dashboard.')) active @endif"
                                               href="{{ route($profile . '.dashboard')}}">
                                                <i class="bi bi-house fa-fw me-2"></i>
                                                {{ __('Tableau de bord') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item @if(str_starts_with($routeName, $profile . '.profile.')) active @endif"
                                               href="{{ route($profile . '.profile.index') }}">
                                                <i class="bi bi-person fa-fw me-2"></i>
                                                {{ __('Profil') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="bi bi-gear fa-fw me-2"></i>
                                                {{ __('Paramètres') }}
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route($profile . '.auth.sign-out') }}" method="post">
                                                @csrf
                                                <button class="dropdown-item bg-danger-soft-hover" type="submit">
                                                    <i class="fas fa-sign-out-alt fa-fw me-2"></i>
                                                    {{ __('Déconnexion') }}
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>

                                        <!-- Dark mode options START -->
                                        <li>
                                            <div
                                                class="bg-light dark-mode-switch theme-icon-active d-flex align-items-center p-1 rounded mt-2">
                                                <!-- <span>Mode:</span> -->
                                                <button type="button" class="btn btn-sm mb-0"
                                                        data-bs-theme-value="light">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor" class="bi bi-sun fa-fw mode-switch"
                                                         viewBox="0 0 16 16">
                                                        <path
                                                            d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
                                                        <use href="#"></use>
                                                    </svg>
                                                    Light
                                                </button>
                                                <button type="button" class="btn btn-sm mb-0"
                                                        data-bs-theme-value="dark">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor" class="bi bi-moon-stars fa-fw mode-switch"
                                                         viewBox="0 0 16 16">
                                                        <path
                                                            d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278zM4.858 1.311A7.269 7.269 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.316 7.316 0 0 0 5.205-2.162c-.337.042-.68.063-1.029.063-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286z"/>
                                                        <path
                                                            d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
                                                        <use href="#"></use>
                                                    </svg>
                                                    Dark
                                                </button>
                                                <button type="button" class="btn btn-sm mb-0 active"
                                                        data-bs-theme-value="auto">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         fill="currentColor" class="bi bi-circle-half fa-fw mode-switch"
                                                         viewBox="0 0 16 16">
                                                        <path
                                                            d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
                                                        <use href="#"></use>
                                                    </svg>
                                                    Auto
                                                </button>
                                            </div>
                                        </li>
                                        <!-- Dark mode options END-->
                                    </ul>
                                    <!-- Profile dropdown END -->
                                </li>
                                <!-- Profile dropdown END -->

                            </ul>
                        </div>
                        <!-- Top bar right END -->
                    </div>
                </div>
            </nav>
            <!-- Top bar END -->

            <!-- Page main content START -->
            <div style="margin: 1.5rem 1.5rem;">
                <div class="col-12 mt-3">
                    @if(session('success'))
                        <div
                            class="alert alert-success alert-dismissible d-flex justify-content-between align-items-center fade show py-3 pe-2"
                            role="alert">
                            <div>
                                {{ session('success') }}
                            </div>
                            <button type="button" class="btn btn-link mb-0 text-primary-hover text-end"
                                    data-bs-dismiss="alert" aria-label="Close">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div
                            class="alert alert-danger alert-dismissible d-flex justify-content-between align-items-center fade show py-3 pe-2"
                            role="alert">
                            <div>
                                {{ session('error') }}
                            </div>
                            <button type="button" class="btn btn-link mb-0 text-primary-hover text-end"
                                    data-bs-dismiss="alert" aria-label="Close">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div
                            class="alert alert-danger alert-dismissible d-flex justify-content-between align-items-center fade show py-3 pe-2"
                            role="alert">
                            <div>
                                <p>
                                    {{ __('Oups !!! Un ou plusieurs champs sont incorrects.') }}
                                </p>
                                <ul class="my-0">
                                    @foreach($errors->all() as $error)
                                        <li> {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <button type="button" class="btn btn-link mb-0 text-primary-hover text-end"
                                    data-bs-dismiss="alert" aria-label="Close">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    @endif
                </div>
            </div>


            @yield('main-content')
            <!-- Page main content END -->
        </div>
        <!-- Page content END -->

    </main>
    <!-- **************** MAIN CONTENT END **************** -->
@endsection
