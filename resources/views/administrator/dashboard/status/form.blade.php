{{-- resources/view/administrator/dashboard/status/form.blade.php --}}

@extends($profile . '.dashboard.base')

@section('sub-title', ($status->exists) ? __('Modifier le statut pour une loterie, transaction') : __('Ajouter un statut pour une loterie, transaction'))

@section('main-content')
    <div class="page-content-wrapper border">
        <!-- Card header START -->
        <div class="card-header bg-transparent border-bottom">
            <div class="row mb-3">
                <div class="col-12">
                    <h1 class="h3 mb-2 mb-sm-0">
                        {{ ($status->exists) ? __('Modifier le statut pour une loterie, transaction') : __('Ajouter un statut pour une loterie, transaction') }}
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
                          action="{{ ($status->exists) ? route($profile . '.status.update', ['status' => $status]) : route($profile . '.status.create', ['status' => $status]) }}">

                        @csrf

                        <!-- Nom -->
                        <div class="col-md-12">
                            <label for="status-name" class="form-label">
                                {{ __('Nom') }}
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="name" id="status-name"
                                   class="form-control status-name @error('name'){{'is-invalid'}}@enderror"
                                   value="{{ old('name', $status->name) }}"
                                   placeholder="{{ __('Veuillez entrer le nom du statut') }}">
                            @error('name')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Code -->
                        <div class="col-md-12">
                            <label for="status-code" class="form-label">
                                {{ __('Code') }}
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="code" id="status-code"
                                   class="form-control status-code @error('code'){{'is-invalid'}}@enderror"
                                   value="{{ old('code', $status->code) }}"
                                   placeholder="{{ __('Veuillez entrer le code du statut') }}">
                            @error('code')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="col-md-12">
                            <label for="status-description" class="form-label">
                                {{ __('Description') }}
                                {{--<span class="text-danger">*</span>--}}
                            </label>

                            <textarea name="description" id="status-description"
                                      class="form-control status-description @error('description'){{'is-invalid'}}@enderror"
                                      placeholder="{{ __('Veuillez entrer la description du statut') }}">{{old('description', $status->description)}}</textarea>

                            @error('description')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Message -->
                        <div class="col-md-12">
                            <label for="status-message" class="form-label">
                                {{ __('Message (Mettre entre ~~ les caractères variables)') }}
                                {{--<span class="text-danger">*</span>--}}
                            </label>

                            <textarea name="message" id="status-message"
                                      class="form-control status-message @error('message'){{'is-invalid'}}@enderror"
                                      placeholder="{{ __('Veuillez entrer le message du statut') }}">{{old('message', $status->message)}}</textarea>

                            @error('message')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Entity Select -->
                        <div class="col-md-12">
                            <label for="package-entity" class="form-label">
                                {{ __('Entité : ') }}
                            </label>
                            <select name="entity" id="status-entity"
                                    aria-label=".form-select-sm status-entity"
                                    class="form-select me-1 mt-2 status-entity">
                                <option value="">{{ __('Sélectionner l\'entité du statut') }}</option>
                                <option
                                    value="LOTTERY" @selected(($input['entity'] ?? 'LOTTERY') == 'LOTTERY')>
                                    {{ __('Loterie') }}
                                </option>
                                <option
                                    value="LOTTERY_USER" @selected(($input['entity'] ?? 'LOTTERY') == 'LOTTERY_USER')>
                                    {{ __('Utilisateur loterie') }}
                                </option>
                                <option value="TRANSACTION" @selected(($input['entity'] ?? 'LOTTERY') == 'TRANSACTION')>
                                    {{ __('Transaction') }}
                                </option>

                            </select>
                        </div>

                        <!-- Icon -->
                        <div class="col-md-12">
                            <label for="status-icon" class="form-label">
                                {{ __('Icon') }}
                                {{--<span class="text-danger">*</span>--}}
                            </label>

                            <input type="text" name="icon" id="status-icon"
                                   class="form-control status-icon @error('icon'){{'is-invalid'}}@enderror"
                                   value="{{old('icon', $status->icon)}}"
                                   placeholder="{{ __('Veuillez entrer l\'icon du statut') }}">
                            @error('icon')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Couleur -->
                        <div class="col-md-12">
                            <label for="status-color" class="form-label">
                                {{ __('Couleur') }}
                                {{--<span class="text-danger">*</span>--}}
                            </label>

                            <input type="text" name="color" id="status-color"
                                   class="form-control status-color @error('color'){{'is-invalid'}}@enderror"
                                   value="{{old('color', $status->color  )}}"
                                   placeholder="{{ __('Veuillez entrer la couleur du statut') }}">
                            @error('color')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Save button -->
                        <div class="d-sm-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mb-0">
                                {{ ($status->exists) ? __('Modifier') : __('Enregistrer') }}
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
