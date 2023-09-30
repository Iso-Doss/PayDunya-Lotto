{{-- resources/view/customer/dashboard/base.blade.php --}}

@extends($profile . '.base')

@php $routeName = request()->route()?->getName(); @endphp

@section('main')
    <!-- **************** MAIN CONTENT START **************** -->
    <main>

        <!-- =======================
        Page Banner START -->
        <section class="pt-0">
            <div class="container-fluid px-0">
                <div class="card bg-blue h-100px h-md-200px rounded-0"
                     style="background:url({{ asset('assets/images/pattern/04.png') }}) no-repeat center center; background-size:cover;">
                </div>
            </div>
            <div class="container mt-n4">
                <div class="row">
                    <div class="col-12">
                        <div class="card bg-transparent card-body pb-0 px-0 mt-2 mt-sm-0">
                            <div class="row d-sm-flex justify-sm-content-between mt-2 mt-md-0">
                                <!-- Avatar -->
                                {{--<div class="col-auto">--}}
                                {{--    <div class="avatar avatar-xxl position-relative mt-n3">--}}
                                {{--        @if(!@empty(auth('customer')->user()->avatar))--}}
                                {{--            <img class="avatar-img rounded-circle border border-white border-3 shadow"--}}
                                {{--                 src="{{ auth('customer')->user()->avatar }}"--}}
                                {{--                 alt="{{ __('Avatar de l\'utilisateur') }}">--}}
                                {{--        @elseif(!@empty(auth('customer')->user()->first_name) && !@empty(auth('customer')->user()->last_name))--}}
                                {{--            <div class="avatar avatar-md flex-shrink-0 me-3">--}}
                                {{--                <div class="avatar-img rounded-circle bg-orange bg-opacity-10">--}}
                                {{--                    <span--}}
                                {{--                        class="text-orange position-absolute top-50 start-50 translate-middle fw-bold">--}}
                                {{--                        {{ substr(auth('customer')->user()->first_name ?? 'A', 0, 1) }}--}}
                                {{--                        {{ substr(auth('customer')->user()->last_name ?? 'E', 0, 1) }}--}}
                                {{--                    </span>--}}
                                {{--                </div>--}}
                                {{--            </div>--}}
                                {{--        @else--}}
                                {{--            <div--}}
                                {{--                class="icon-lg bg-orange rounded-circle bg-opacity-10 text-orange rounded-2 flex-shrink-0">--}}
                                {{--                <i class="fas fa-user fs-5"></i>--}}
                                {{--            </div>--}}
                                {{--        @endif--}}
                                {{--    </div>--}}
                                {{--</div>--}}

                                <!-- Profile info -->
                                <div class="col mt-5 d-sm-flex justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            @if(!@empty(auth('customer')->user()->avatar))
                                                <!-- Avatar -->
                                                <div class="avatar avatar-xl me-3">
                                                    <img class="avatar-img rounded-circle shadow"
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
                                                    class="icon-lg bg-orange rounded-circle bg-opacity-10 text-orange rounded-2 flex-shrink-0 me-3">
                                                    <i class="fas fa-user fs-5"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <h1 class="my-1 fs-4">
                                                @if(!@empty(auth('customer')->user()->first_name))
                                                    {{ auth('customer')->user()->first_name }}
                                                @endif
                                                @if(!@empty(auth('customer')->user()->last_name))
                                                    {{ auth('customer')->user()->last_name }}
                                                @endif

                                                @if(!@empty(auth('customer')->user()->user_name))
                                                    {{ '(@' . auth('customer')->user()->user_name . ')' }}
                                                @endif
                                            </h1>
                                            @if(!@empty(auth('customer')->user()->email))
                                                <p>
                                                    {{ auth('customer')->user()->email }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Button -->
                                    <div class="mt-2 mt-sm-0">
                                        <a href="{{-- route($profile .'.package.create') --}}" class="btn btn-success mb-0">
                                            {{ __('Acheter un ticket') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Advanced filter responsive toggler START -->
                        <!-- Divider -->
                        <hr class="d-xl-none">
                        <div class="col-12 col-xl-3 d-flex justify-content-between align-items-center">
                            <a class="h6 mb-0 fw-bold d-xl-none" href="#">Menu</a>
                            <button class="btn btn-primary d-xl-none" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                                <i class="fas fa-sliders-h"></i>
                            </button>
                        </div>
                        <!-- Advanced filter responsive toggler END -->
                    </div>
                </div>
            </div>
        </section>
        <!-- =======================
        Page Banner END -->

        <!-- =======================
        Page content START -->
        <section class="pt-0">
            <div class="container">
                <div class="row">

                    <div class="col-12">
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

                    <!-- Left sidebar START -->
                    <div class="col-xl-3">
                        <!-- Responsive offcanvas body START -->
                        <div class="offcanvas-xl offcanvas-end" tabindex="-1" id="offcanvasSidebar">
                            <!-- Offcanvas header -->
                            <div class="offcanvas-header bg-light">
                                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                                    {{ __('Mon profil') }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                        data-bs-target="#offcanvasSidebar" aria-label="Close"></button>
                            </div>
                            <!-- Offcanvas body -->
                            <div class="offcanvas-body p-3 p-xl-0">
                                <div class="bg-dark border rounded-3 p-3 w-100">
                                    <!-- Dashboard menu -->
                                    <div class="list-group list-group-dark list-group-borderless collapse-list">
                                        <a class="list-group-item @if(str_starts_with($routeName, $profile . '.dashboard')) active @endif"
                                           href="{{ route($profile . '.dashboard') }}">
                                            <i class="bi bi-house fa-fw me-2"></i>
                                            {{ __('Ma Loterie') }}
                                        </a>

                                        <a class="list-group-item @if(str_starts_with($routeName, $profile . '.transactions.')) active @endif"
                                           href="{{-- route($profile . '.transactions.index') --}}">
                                            <i class="fas fa-wallet fa-fw me-2"></i>
                                            {{ __('Mes transactions') }}
                                        </a>

                                        <a class="list-group-item @if(str_starts_with($routeName, $profile . '.profile.')) active @endif"
                                           href="{{ route($profile . '.profile.index') }}">
                                            <i class="bi bi-person fa-fw me-2"></i>
                                            {{ __('Profil') }}
                                        </a>

                                        <a class="list-group-item @if(str_starts_with($routeName, $profile . '.settings.')) active @endif"
                                           href="{{-- route($profile . '.settings.index') --}}">
                                            <i class="bi bi-gear fa-fw me-2"></i>
                                            {{ __('Paramètres') }}
                                        </a>

                                        {{--<a class="list-group-item" href="#">--}}
                                        {{--    <i class="bi bi-gear fa-fw me-2"></i>--}}
                                        {{--    {{ __('Paramètres') }}--}}
                                        {{--</a>--}}

                                        <a class="list-group-item" href="{{-- route($profile . '.faq') --}}">
                                            <i class="bi bi-info-circle fa-fw me-2"></i>
                                            {{ __('Aides') }}
                                        </a>

                                        <form class="list-group-item bg-danger-soft-hover"
                                              action="{{ route($profile . '.auth.sign-out') }}" method="post">
                                            @csrf
                                            <button class="dropdown-item" type="submit">
                                                <i class="fas fa-sign-out-alt fa-fw me-2"></i>
                                                {{ __('Déconnexion') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Responsive offcanvas body END -->
                    </div>
                    <!-- Left sidebar END -->

                    <!-- Main content START -->
                    <div class="col-xl-9">
                        @yield('main-content')
                    </div><!-- Row END -->
                </div>
            </div>
        </section>
        <!-- =======================
        Page content END -->

    </main>
    <!-- **************** MAIN CONTENT END **************** -->
@endsection
