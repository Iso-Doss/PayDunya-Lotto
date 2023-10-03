{{-- resources/view/administrator/dashboard/ticket/form.blade.php --}}

@extends($profile . '.dashboard.base')

@section('sub-title', ($ticket->exists) ? __('Modifier le billet de loterie') : __('Ajouter un billet de loterie'))

@section('main-content')
    <div class="page-content-wrapper border">
        <!-- Card header START -->
        <div class="card-header bg-transparent border-bottom">
            <div class="row mb-3">
                <div class="col-12">
                    <h1 class="h3 mb-2 mb-sm-0">
                        {{ ($ticket->exists) ? __('Modifier le billet de loterie') : __('Ajouter un billet de loterie') }}
                    </h1>

                    <p class="text-danger mb-0">
                        {{ __('Les champs avec * sont obligatoires.') }}
                    </p>
                </div>
            </div>
        </div>
        <!-- Card header END -->

        <div class="card-body">
            <!-- Search and select START -->
            <div class="row g-3 align-items-center justify-content-between mt-1 mb-4">
                <!-- Content -->
                <div class="col-md-12">
                    <form class="row g-4" method="post" enctype="multipart/form-data"
                          action="{{ ($ticket->exists) ? route($profile . '.ticket.update', ['ticket' => $ticket]) : route($profile . '.ticket.create', ['ticket' => $ticket]) }}">

                        @csrf

                        <!-- Nom -->
                        <div class="col-md-12">
                            <label for="ticket-name" class="form-label">
                                {{ __('Nom') }}
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="name" id="ticket-name"
                                   class="form-control ticket-name @error('name'){{'is-invalid'}}@enderror"
                                   value="{{ old('name', $ticket->name) }}"
                                   placeholder="{{ __('Veuillez entrer le nom du billet') }}">
                            @error('name')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="col-md-12">
                            <label for="ticket-price" class="form-label">
                                {{ __('Prix') }}
                                <span class="text-danger">*</span>
                            </label>

                            <input type="number" name="price" id="ticket-price"
                                   class="form-control ticket-name @error('price'){{'is-invalid'}}@enderror"
                                   value="{{ old('price', $ticket->price) }}"
                                   placeholder="{{ __('Veuillez entrer le prix du billet') }}">
                            @error('price')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="col-md-12">
                            <label for="ticket-short-description" class="form-label">
                                {{ __('Description courte') }}
                                {{--<span class="text-danger">*</span>--}}
                            </label>

                            <input type="text" name="short_description" id="ticket-short-description"
                                   class="form-control ticket-name @error('short_description'){{'is-invalid'}}@enderror"
                                   value="{{ old('short_description', $ticket->price) }}"
                                   placeholder="{{ __('Veuillez entrer la description courte du billet') }}">
                            @error('short_description')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="col-md-12">
                            <label for="ticket-description" class="form-label">
                                {{ __('Description') }}
                                {{--<span class="text-danger">*</span>--}}
                            </label>

                            <textarea name="description" id="ticket-description"
                                      class="form-control ticket-description @error('description'){{'is-invalid'}}@enderror"
                                      placeholder="{{ __('Veuillez entrer la description du billet') }}">{{old('description', $ticket->description)}}</textarea>

                            @error('description')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Image -->
                        <div class="col-12 justify-content-center align-items-center">
                            <label class="form-label" for="profile-avatar">
                                {{ __('Image') }}
                                {{--<span class="text-danger">*</span>--}}
                            </label>
                            <div class="d-flex align-items-center">
                                <label class="position-relative me-4" for="profile-avatar"
                                       title="{{ __('Ajouter une image') }}">
                                    <!-- Avatar place holder -->
                                    @if(old('image', $ticket->image))
                                        <label class="position-relative me-4" for="package-image"
                                               title="Replace this pic">
                                            <!-- Avatar place holder -->
                                            <span class="avatar avatar-xl">
                                                <img id="aec-upload-image-preview"
                                                     class="avatar-img rounded-circle border border-white border-3 shadow"
                                                     src="{{ "/storage/" . $ticket->image }}"
                                                     alt="{{ __('L\'image du colis :package-name', ['package-name' => $ticket->name ]) }}">
                                            </span>
                                            {{--<!-- Remove btn -->--}}
                                            {{--<button type="button" class="uploadremove">--}}
                                            {{--    <i class="bi bi-x text-white"></i>--}}
                                            {{--</button>--}}
                                        </label>
                                    @else
                                        <label class="position-relative me-4 aec-upload-package d-none"
                                               for="package-image"
                                               title="Replace this pic">
                                            <!-- Avatar place holder -->
                                            <span class="avatar avatar-xl">
                                                <img id="aec-upload-image-preview"
                                                     class="avatar-img rounded-circle border border-white border-3 shadow"
                                                     src="#">
                                            </span>
                                        </label>
                                        <div
                                            class="aec-default-image icon-lg bg-orange rounded-circle bg-opacity-10 text-orange rounded-2 flex-shrink-0">
                                            <i class="bi bi-ticket"></i>
                                        </div>
                                    @endif
                                    <!-- Remove btn
                                    <button type="button" class="uploadremove">
                                        <i class="bi bi-x text-white"></i>
                                    </button>
                                    -->
                                </label>
                                <!-- Upload button -->
                                <label class="btn btn-primary-soft mb-0" for="profile-avatar">
                                    {{ ($ticket->image) ?  __('Changer') : __('Ajouter une photo') }}
                                </label>
                                <input name="image" id="profile-avatar" class="form-control d-none" type="file">
                            </div>
                        </div>

                        <!-- Save button -->
                        <div class="d-sm-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mb-0">
                                {{ ($ticket->exists) ? __('Modifier') : __('Enregistrer') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('template-functions')
    <script>
        (function ($) {
            $(document).ready(function () {

            });
        }(jQuery));
    </script>--}}
@endsection
