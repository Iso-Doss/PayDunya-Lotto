{{-- ressources/views/components/header.blade.php --}}

@php
    $routeName = request()->route()?->getName();
    $notifications = !empty(auth('customer')->user()) ? auth('customer')->user()->notifications : '';
@endphp

    <!-- Top header START -->
<div class="navbar-top navbar-dark bg-light d-none d-xl-block py-2 mx-2 mx-md-4 rounded-bottom-4">
    <!--<div class="container">-->
    <div class="container-fluid px-3 px-xl-5">
        <div class="d-lg-flex justify-content-lg-between align-items-center">
            <!-- Navbar top Left-->
            <!-- Top info -->
            <ul class="nav align-items-center justify-content-center">
                <li class="nav-item me-3" data-bs-animation="false"
                    data-bs-original-title="Nous sommes fermé les Dimanches" data-bs-placement="bottom"
                    data-bs-toggle="tooltip">
                    <span>
                        <i class="far fa-clock me-2"></i>
                        {{ __('Heure de visite : Lundi-Samedi 9:00-19:00') }}
                    </span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tel:+22997000000">
                        <i class="fas fa-headset me-2"></i>
                        {{ __('Appelez-nous maintenant : :phone-number', ['phone-number' => '(+229) 97 00 00 00']) }}
                    </a>
                </li>
            </ul>

            <!-- Navbar top Right-->
            <div class="nav d-flex align-items-center justify-content-center">
                <!-- Language -->
                <div class="dropdown me-3">
                    <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle"
                       data-bs-toggle="dropdown"
                       href="#" id="dropdownLanguage">
                        <i class="fas fa-globe me-2"></i>
                        {{ __(':lang', ['lang' => (Lang::locale() == 'fr') ? 'Français' : 'Anglais' ]) }}
                    </a>

                    <div aria-labelledby="dropdownLanguage" class="dropdown-menu mt-2 min-w-auto shadow">
                        <a class="dropdown-item me-4 @if(Lang::locale() == 'fr') active @endif"
                           href="{{ route( 'set-lang', ['lang' => 'fr']) }}">
                            <img alt="" class="fa-fw me-2" src="{{ asset('assets/images/flags/fr.svg') }}">
                            {{ __('Français') }}
                        </a>
                        <a class="dropdown-item me-4 @if(Lang::locale() == 'en') active @endif"
                           href="{{ route( 'set-lang', ['lang' => 'en']) }}">
                            <img alt="" class="fa-fw me-2" src="{{ asset('assets/images/flags/uk.svg') }}">
                            {{ __('Anglais') }}
                        </a>
                    </div>
                </div>

                @guest('customer')
                    <div class="dropdown">
                        <button aria-expanded="false" class="btn btn-light btn-sm lh-1 p-2 mb-0"
                                data-bs-display="static"
                                data-bs-toggle="dropdown"
                                id="bd-theme" type="button">
                            <svg class="bi bi-circle-half fa-fw theme-icon-active" fill="currentColor" height="14"
                                 viewBox="0 0 16 16"
                                 width="14" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
                                <use href="#"></use>
                            </svg>
                            {{ __('Thème') }}
                        </button>

                        <ul aria-labelledby="bd-theme" class="dropdown-menu min-w-auto dropdown-menu-end">
                            <li class="mb-1">
                                <button class="dropdown-item d-flex align-items-center" data-bs-theme-value="light"
                                        type="button">
                                    <svg class="bi bi-brightness-high-fill fa-fw mode-switch me-1" fill="currentColor"
                                         height="16"
                                         viewBox="0 0 16 16" width="16">
                                        <path
                                            d="M12 8a4 4 0 1 1-8 0 4 4 0 0 1 8 0zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
                                        <use href="#"></use>
                                    </svg>
                                    {{ __('Claire') }}
                                </button>
                            </li>
                            <li class="mb-1">
                                <button class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark"
                                        type="button">
                                    <svg class="bi bi-moon-stars-fill fa-fw mode-switch me-1" fill="currentColor"
                                         height="16" viewBox="0 0 16 16"
                                         width="16" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
                                        <path
                                            d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
                                        <use href="#"></use>
                                    </svg>
                                    {{ __('Sombre') }}
                                </button>
                            </li>
                            <li>
                                <button class="dropdown-item d-flex align-items-center active"
                                        data-bs-theme-value="auto"
                                        type="button">
                                    <svg class="bi bi-circle-half fa-fw mode-switch me-1" fill="currentColor"
                                         height="16"
                                         viewBox="0 0 16 16"
                                         width="16" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
                                        <use href="#"></use>
                                    </svg>
                                    {{ __('Auto') }}
                                </button>
                            </li>
                        </ul>
                    </div>
                @endguest

                <!-- Top social -->
                <ul class="list-unstyled d-flex mb-0">
                    <li>
                        <a class="px-2 nav-link" href="#">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a class="px-2 nav-link" href="#">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a class="px-2 nav-link" href="#">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </li>
                    <li>
                        <a class="px-2 nav-link" href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Top header END -->

<!-- Header START -->
<header class="navbar-light header-static navbar-sticky">
    <!-- Logo Nav START -->
    <nav class="navbar navbar-expand-xl">
        <div class="container-fluid px-3 px-xl-5">
            <!-- Logo START -->
            <a class="navbar-brand me-0" href="{{ route( $profile . '.index') }}">
                {{--<img alt="{{ __('Logo :app-name', ['app-name' => config('app.name')]) }}"--}}
                {{--     class="navbar-brand-item"--}}
                {{--     src="{{ asset('assets/images/blue_logo.png') }}">--}}
                <span style="color: #0972b5" class="fs-3">PayDunya Lotto</span>
            </a>
            <!-- Logo END -->

            <!-- Responsive navbar toggler -->
            <button aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"
                    class="navbar-toggler ms-auto" data-bs-target="#navbarCollapse" data-bs-toggle="collapse"
                    type="button">
				<span class="navbar-toggler-animation">
					<span></span>
					<span></span>
					<span></span>
				</span>
            </button>

            <!-- Main navbar START -->
            <div class="navbar-collapse collapse" id="navbarCollapse">
                <!-- Nav Search END -->
                <ul class="navbar-nav navbar-nav-scroll mx-auto">
                    <li class="nav-item">
                        <a class="nav-link @if($routeName == $profile . '.index') active @endif"
                           href="{{ route( $profile . '.index') }}">
                            {{ __('Accueil') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link @if($routeName == $profile . '.sites') active @endif"
                           href="">
                            {{ __('Tirages') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link @if($routeName == $profile . '.contact') active @endif"
                           href="#">
                            {{ __('Contact') }}
                        </a>
                    </li>

                </ul>
            </div>
            <!-- Main navbar END -->

            @auth('customer')

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
                            @if(auth('customer')->user()->unreadNotifications->count() > 0)
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
                                                    {{ __(':nbr-notification nouveaux', ['nbr-notification' => auth('customer')->user()->unreadNotifications->count()]) }}
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
                                                                                @if(!@empty(auth('customer')->user()->avatar))
                                                                                    <img
                                                                                        class="avatar-img rounded-circle"
                                                                                        src="{{ '/storage/' . auth('customer')->user()->avatar }}"
                                                                                        alt="{{ __('Avatar de l\'utilisateur') }}">
                                                                                @elseif(!@empty(auth('customer')->user()->first_name) && !@empty(auth('customer')->user()->last_name))
                                                                                    <span
                                                                                        class="text-orange position-absolute top-50 start-50 translate-middle fw-bold">
                                                                                {{ substr(auth('customer')->user()->first_name ?? 'A', 0, 1) }}
                                                                                        {{ substr(auth('customer')->user()->last_name ?? 'E', 0, 1) }}
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
                                        <a href="{{ route($profile . '.notification.index') }}" class="stretched-link">
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
                                @if(!@empty(auth('customer')->user()->avatar))
                                    <img class="avatar-img rounded-circle"
                                         src="{{ '/storage/' . auth('customer')->user()->avatar }}"
                                         alt="{{ __('Avatar de l\'utilisateur') }}">
                                @elseif(!@empty(auth('customer')->user()->first_name) && !@empty(auth('customer')->user()->last_name))
                                    <span
                                        class="text-orange position-absolute top-50 start-50 translate-middle fw-bold">
                                                {{ substr(auth('customer')->user()->first_name ?? 'A', 0, 1) }}
                                        {{ substr(auth('customer')->user()->last_name ?? 'E', 0, 1) }}
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
                                            @if(!@empty(auth('customer')->user()->avatar))
                                                <!-- Avatar -->
                                                <div class="avatar me-3">
                                                    <img class="avatar-img rounded-circle shadow"
                                                         src="{{ '/storage/' . auth('customer')->user()->avatar }}"
                                                         alt="{{ __('Avatar de l\'utilisateur') }}">
                                                </div>
                                            @elseif(!@empty(auth('customer')->user()->first_name) && !@empty(auth('customer')->user()->last_name))
                                                <div class="avatar avatar-md flex-shrink-0 me-3">
                                                    <div
                                                        class="avatar-img rounded-circle bg-orange bg-opacity-10">
                                        <span
                                            class="text-orange position-absolute top-50 start-50 translate-middle fw-bold">
                                            {{ substr(auth('customer')->user()->first_name ?? 'A', 0, 1) }}
                                            {{ substr(auth('customer')->user()->last_name ?? 'E', 0, 1) }}
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
                                                    @if(!@empty(auth('customer')->user()->first_name))
                                                        {{ auth('customer')->user()->first_name }}
                                                    @endif
                                                    @if(!@empty(auth('customer')->user()->last_name))
                                                        {{ auth('customer')->user()->last_name }}
                                                    @endif

                                                    @if(!@empty(auth('customer')->user()->user_name))
                                                        {{ '(@' . auth('customer')->user()->user_name . ')' }}
                                                    @endif

                                                    @if(!@empty(auth('customer')->user()->email))
                                                        <p class="small m-0">
                                                            {{ auth('customer')->user()->email }}
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
                                    <a class="dropdown-item @if(str_starts_with($routeName, $profile . '.dashboard')) active @endif"
                                       href="{{ route($profile . '.dashboard') }}">
                                        <i class="bi bi-house fa-fw me-2"></i>
                                        {{ __('Ma Loterie') }}
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item @if(str_starts_with($routeName, $profile . '.package.')) active @endif"
                                       href="{{-- route($profile . '.package.index') --}}">
                                        <i class="fas fa-wallet fa-fw me-2"></i>
                                        {{ __('Mes transactions') }}
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
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-info-circle fa-fw me-2"></i>
                                        {{ __('Aides') }}
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
                                        class="bg-light dark-mode-switch theme-icon-active d-flex align-items-center justify-content-center p-1 rounded mt-2">
                                        <button type="button" class="btn btn-sm mb-0" data-bs-theme-value="light">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor"
                                                 class="bi bi-sun fa-fw mode-switch" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
                                                <use href="#"></use>
                                            </svg>
                                            Light
                                        </button>
                                        <button type="button" class="btn btn-sm mb-0" data-bs-theme-value="dark">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor"
                                                 class="bi bi-moon-stars fa-fw mode-switch" viewBox="0 0 16 16">
                                                <path
                                                    d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278zM4.858 1.311A7.269 7.269 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.316 7.316 0 0 0 5.205-2.162c-.337.042-.68.063-1.029.063-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286z"/>
                                                <path
                                                    d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
                                                <use href="#"></use>
                                            </svg>
                                            Dark
                                        </button>
                                        <button type="button" class="btn btn-sm mb-0 active" data-bs-theme-value="auto">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor"
                                                 class="bi bi-circle-half fa-fw mode-switch" viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
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

            @endauth

            @guest('customer')
                <!-- Main navbar END -->
                <div class="navbar-nav">
                    @if(explode('.', $routeName)[0] == 'customer')
                        <a href="{{ route($profile .'.auth.sign-in') }}"
                           class="btn btn-sm btn-success-soft mb-0 d-none d-sm-block">
                            {{ __('Rejoindre PayDunya Lotto') }}
                        </a>
                        <a href="{{ route($profile .'.auth.sign-in') }}"
                           class="btn btn-sm btn-success-soft mb-0 d-sm-none">
                            {{ __('Rejoindre PDL') }}
                        </a>
                    @endif
                    @if(explode('.', $routeName)[0] == 'agent')
                        <a href="{{ route($profile .'.auth.sign-in') }}" class="btn btn-sm btn-success-soft mb-0">
                            {{ __('Tableau de bord') }}
                        </a>
                    @endif
                </div>
            @endguest
        </div>
    </nav>
    <!-- Logo Nav END -->
</header>
<!-- Header END -->
