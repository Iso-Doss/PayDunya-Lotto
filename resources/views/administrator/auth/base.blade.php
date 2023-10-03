{{-- ressources/views/administrator/auth/base.blade.php --}}

@extends($profile . '.base')

@section('main')
    <!-- **************** MAIN CONTENT START **************** -->
    <main>
        <section class="p-0 d-flex align-items-center position-relative overflow-hidden">
            <div class="container-fluid">
                <div class="row">
                    <!-- left -->
                    <div
                        class="col-12 col-lg-6 d-md-flex align-items-center justify-content-center bg-primary bg-opacity-10 vh-lg-100">
                        <div class="p-3 p-lg-5">
                            <!-- Title -->
                            <div class="text-center">
                                <h2 class="fw-bold">@yield('base.auth.title', __('Bienvenue sur :app-name.', ['app-name' => config('app.name')]))</h2>
                                <p class="mb-0 h6 fw-light">@yield('base.auth.sub-title', __('Entreprise de fret et de cargo, spécialisée dans le transport de marchandise depuis la Chine vers Cotonou et dans l\'aide à l\'achat en ligne.'))</p>
                            </div>
                            <!-- SVG Image -->

                            <img src="@yield('base.auth.banner', asset('assets/images/auth-illustration.svg'))"
                                 class="mt-5" alt="{{ __('Illustration de la bannière des pages d\'authentification') }}">

                            <!-- Info -->
                            <div class="d-sm-flex mt-5 align-items-center justify-content-center">
                                <!-- Avatar group -->
                                <ul class="avatar-group mb-2 mb-sm-0">
                                    <li class="avatar avatar-sm">
                                        <img class="avatar-img rounded-circle"
                                             src="@yield('base.auth.community-image-1', asset('assets/images/avatar/01.jpg'))"
                                             alt="avatar">
                                    </li>
                                    <li class="avatar avatar-sm">
                                        <img class="avatar-img rounded-circle"
                                             src="@yield('base.auth.community-image-2', asset('assets/images/avatar/02.jpg'))"
                                             alt="avatar">
                                    </li>
                                    <li class="avatar avatar-sm">
                                        <img class="avatar-img rounded-circle"
                                             src="@yield('base.auth.community-image-3', asset('assets/images/avatar/03.jpg'))"
                                             alt="avatar">
                                    </li>
                                    <li class="avatar avatar-sm">
                                        <img class="avatar-img rounded-circle"
                                             src="@yield('base.auth.community-image-4', asset('assets/images/avatar/04.jpg'))"
                                             alt="avatar">
                                    </li>
                                </ul>
                                <!-- Content -->
                                <p class="mb-0 h6 fw-light ms-0 ms-sm-3">@yield('base.auth.community-message', __('4k+ utilisateurs nous ont rejoints, maintenant c\'est à votre tour.'))</p>
                            </div>
                        </div>
                    </div>

                    <!-- Right -->
                    <div class="col-12 col-lg-6 m-auto">
                        <div class="row my-5">
                            <div class="col-sm-10 col-xl-8 m-auto">
                                <!-- Title -->
                                @yield('base.auth.form-title-icon')
                                <h1 class="fs-2">@yield('base.auth.form-title', __('Ouvrez votre compte sur :app-name.', ['app-name' => config('app.name')]))</h1>
                                <p class="lead mb-4">@yield('base.auth.form-sub-title', __('Ravi de vous voir, cher administrateur ! Veuillez vous inscrire.'))</p>

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

                                @yield('base.auth.form')
                            </div>
                        </div> <!-- Row END -->
                    </div>
                </div> <!-- Row END -->
            </div>
        </section>
    </main>
    <!-- **************** MAIN CONTENT END **************** -->
@endsection
