{{-- resources/view/administrator/dashboard/lottery/form.blade.php --}}

@extends($profile . '.dashboard.base')

@section('sub-title', ($lottery->exists) ? __('Modifier la loterie') : __('Ajouter une loterie'))

@section('main-content')
    <div class="page-content-wrapper border">
        <!-- Card header START -->
        <div class="card-header bg-transparent border-bottom">
            <div class="row mb-3">
                <div class="col-12">
                    <h1 class="h3 mb-2 mb-sm-0">
                        {{ ($lottery->exists) ? __('Modifier la loterie') : __('Ajouter une loterie') }}
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
                          action="{{ ($lottery->exists) ? route($profile . '.lottery.update', ['lottery' => $lottery]) : route($profile . '.lottery.create', ['lottery' => $lottery]) }}">

                        @csrf

                        <!-- Nom -->
                        <div class="col-md-12">
                            <label for="lottery-name" class="form-label">
                                {{ __('Nom') }}
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="name" id="lottery-name"
                                   class="form-control lottery-name @error('name'){{'is-invalid'}}@enderror"
                                   value="{{ old('name', $lottery->name) }}"
                                   placeholder="{{ __('Veuillez entrer le nom de la loterie') }}">
                            @error('name')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Date -->
                        <div class="col-md-12">
                            <label for="lottery-date" class="form-label">
                                {{ __('Date (Veuillez choisir un date de loterie dont le jour est soit un Mardi soit un Jeudi)') }}
                                <span class="text-danger">*</span>
                            </label>

                            <input type="date" name="date" id="lottery-date"
                                   class="form-control lottery-name @error('date'){{'is-invalid'}}@enderror"
                                   value="{{ old('date', $lottery->date) }}"
                                   placeholder="{{ __('Veuillez entrer la date de la loterie') }}">
                            @error('date')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Jackpot -->
                        <div class="col-md-12">
                            <label for="lottery-jackpot" class="form-label">
                                {{ __('Cagnotte') }}
                                <span class="text-danger">*</span>
                            </label>

                            <input type="number" name="jackpot" id="lottery-jackpot"
                                   class="form-control lottery-name @error('jackpot'){{'is-invalid'}}@enderror"
                                   value="{{ old('jackpot', $lottery->price ?? 20000000) }}"
                                   placeholder="{{ __('Veuillez entrer la cagnotte de la loterie') }}">
                            @error('jackpot')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Short description -->
                        <div class="col-md-12">
                            <label for="lottery-short-description" class="form-label">
                                {{ __('Courte description') }}
                            </label>

                            <input type="text" name="short_description" id="lottery-short-description"
                                   class="form-control lottery-short-description @error('short_description'){{'is-invalid'}}@enderror"
                                   value="{{ old('short_description', $lottery->short_description) }}"
                                   placeholder="{{ __('Veuillez entrer la cagnotte de la loterie') }}">
                            @error('short_description')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="col-md-12">
                            <label for="lottery-description" class="form-label">
                                {{ __('Description') }}
                                {{--<span class="text-danger">*</span>--}}
                            </label>

                            <textarea name="description" id="lottery-description"
                                      class="form-control lottery-description @error('description'){{'is-invalid'}}@enderror"
                                      placeholder="{{ __('Veuillez entrer la description de la loterie') }}">{{old('description', $lottery->description)}}</textarea>

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
                                    @if(old('image', $lottery->image))
                                        <label class="position-relative me-4" for="package-image"
                                               title="Replace this pic">
                                            <!-- Avatar place holder -->
                                            <span class="avatar avatar-xl">
                                                <img id="aec-upload-image-preview"
                                                     class="avatar-img rounded-circle border border-white border-3 shadow"
                                                     src="{{ "/storage/" . $lottery->image }}"
                                                     alt="{{ __('L\'image du colis :package-name', ['package-name' => $lottery->name ]) }}">
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
                                            <i class="bi bi-box"></i>
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
                                    {{ ($lottery->image) ?  __('Changer') : __('Ajouter une photo') }}
                                </label>
                                <input name="image" id="profile-avatar" class="form-control d-none" type="file">
                            </div>
                        </div>

                        <!-- Save button -->
                        <div class="d-sm-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mb-0">
                                {{ ($lottery->exists) ? __('Modifier') : __('Enregistrer') }}
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
