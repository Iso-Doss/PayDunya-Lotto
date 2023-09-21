{{-- ressources/views/components/footer.blade.php --}}

@php $routeName = request()->route()?->getName(); @endphp

    <!-- Footer START -->
<footer class="p-3">
    <div class="container">
        <div class="row align-items-center">
            <!-- Widget -->
            <div class="col-md-3 text-center text-md-start mb-3 mb-md-0">
                <!-- Logo START -->
                <a href="{{ route($profile . '.index') }}">
                    {{--<img class="h-40px" src="{{ asset('assets/images/blue_logo.png') }}"--}}
                    {{--     alt="{{ __('Logo :app-name', ['app-name' => config('app.name')]) }}">--}}
                    <span style="color: #0972b5" class="fs-3">PayDunya Lotto</span>
                </a>
            </div>

            <!-- Widget -->
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="text-center">
                    Copyrights &copy; {{ date('Y') }}
                    <a href="{{ route($profile . '.index') }}" class="text-reset btn-link">
                        {{ config('app.name') }}
                    </a>.
                    {{ __('Tous les droits sont réservés.') }}
                </div>
            </div>

            <!-- Widget -->
            <div class="col-md-3">
                <!-- Rating -->
                <ul class="list-inline mb-0 text-center text-md-end">
                    <li class="list-inline-item ms-2">
                        <a href="#">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </li>

                    <li class="list-inline-item ms-2">
                        <a href="#">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>

                    <li class="list-inline-item ms-2">
                        <a href="#">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </li>

                    <li class="list-inline-item ms-2">
                        <a href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- Footer END -->
