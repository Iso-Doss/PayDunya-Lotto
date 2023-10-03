{{-- resources/view/administrator/base.blade.php --}}

@extends('base')

@section('title')
    @yield('sub-title')
    {{ __(' | Administrateur ') }}
@endsection

@section('plugins-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/apexcharts/css/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendor/overlay-scrollbar/css/overlayscrollbars.min.css') }}">
@endsection

@section('theme-css')
    <style>
        @media (min-width: 1200px) {
            .navbar-expand-xl .navbar-brand .navbar-brand-item {
                height: 70px;
            }
        }

        header.navbar-sticky-on .navbar-brand .navbar-brand-item {
            height: 70px;
        }

        .navbar-brand {
            padding: 5px !important;
        }

        @media (max-width: 1199.98px) {
            .navbar-expand-xl .navbar-brand .navbar-brand-item {
                height: 70px;
            }

            .navbar-brand {
                padding: 5px !important;
            }
        }
    </style>
@endsection

{{--@section('header')--}}
{{--    @include('components.header')--}}
{{--@endsection--}}

{{--@section('footer')--}}
{{--    @include('components.footer')--}}
{{--@endsection--}}

@section('vendors')

    <!-- Vendors -->
    <script src="{{ asset('assets/vendor/select2/js/select2.full.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounterjs/dist/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/apexcharts/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/overlay-scrollbar/js/overlayscrollbars.min.js') }}"></script>

    <!--select2-->
    <script>
        (function ($) {
            $(document).ready(function () {
                //Initialize Select2 Elements
                $('.select2').select2()

                //Initialize Select2 Elements
                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })

                //Bootstrap Duallistbox
                // $('.duallistbox').bootstrapDualListbox()
            });
        }(jQuery));
    </script>

@endsection

{{--@section('plugins-css')@endsection--}}

{{--@section('vendors')--}}
{{--    <!-- Vendors -->--}}
{{--@endsection--}}
