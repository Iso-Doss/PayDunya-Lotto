{{-- ressources/views/errors/416.blade.php --}}

@php
    $profile ??= 'customer';
@endphp

@extends($profile . '.base')

@section('title', __('Erreur 416'))

@section('main')
    <!-- **************** MAIN CONTENT START **************** -->
    <main>
        <section class="pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <!-- Image -->
                        <img src="{{ asset('assets/images/element/error404-01.svg') }}" class="h-200px h-md-400px mb-4"
                             alt="{{ __('Image 404') }}">
                        <!-- Title -->
                        <h1 class="display-1 text-danger mb-0">
                            {{ __('404') }}
                        </h1>
                        <!-- Subtitle -->
                        <h2>
                            {{  __('Oh non, quelque chose s\'est mal passé !') }}
                        </h2>
                        <!-- info -->
                        <p class="mb-4">
                            {{ __('Soit quelque chose s\'est mal passé, soit cette page n\'existe plus.') }}
                        </p>
                        <!-- Button -->
                        <a href="{{ route($profile . '.index') }}" class="btn btn-primary mb-0">
                            {{ __('Emmenez-moi à la page d\'accueil') }}
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- **************** MAIN CONTENT END **************** -->
@endsection
