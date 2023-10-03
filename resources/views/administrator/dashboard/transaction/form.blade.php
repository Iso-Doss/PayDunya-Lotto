{{-- resources/view/administrator/dashboard/transaction-type/form.blade.php --}}

@extends($profile . '.dashboard.base')

@section('sub-title', ($transactionType->exists) ? __('Modifier le type de transaction') : __('Ajouter un type de transaction'))

@section('main-content')
    <div class="page-content-wrapper border">
        <!-- Card header START -->
        <div class="card-header bg-transparent border-bottom">
            <div class="row mb-3">
                <div class="col-12">
                    <h1 class="h3 mb-2 mb-sm-0">
                        {{ ($transactionType->exists) ? __('Modifier le type de transaction') : __('Ajouter un type de transaction') }}
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
                          action="{{ ($transactionType->exists) ? route($profile . '.transaction-type.update', ['transaction_type' => $transactionType]) : route($profile . '.transaction-type.create', ['transaction_type' => $transactionType]) }}">

                        @csrf

                        <!-- Nom -->
                        <div class="col-md-12">
                            <label for="transaction-type-name" class="form-label">
                                {{ __('Nom') }}
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="name" id="transaction-type-name"
                                   class="form-control transaction-type-name @error('name'){{'is-invalid'}}@enderror"
                                   value="{{ old('name', $transactionType->name) }}"
                                   placeholder="{{ __('Veuillez entrer le nom du type de transaction') }}">
                            @error('name')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Code -->
                        <div class="col-md-12">
                            <label for="transaction-type-code" class="form-label">
                                {{ __('Code') }}
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="code" id="transaction-type-code"
                                   class="form-control transaction-type-code @error('code'){{'is-invalid'}}@enderror"
                                   value="{{ old('code', $transactionType->code) }}"
                                   placeholder="{{ __('Veuillez entrer le code du statut') }}">
                            @error('code')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="col-md-12">
                            <label for="transaction-type-description" class="form-label">
                                {{ __('Description') }}
                                {{--<span class="text-danger">*</span>--}}
                            </label>

                            <textarea name="description" id="transaction-type-description"
                                      class="form-control transaction-type-description @error('description'){{'is-invalid'}}@enderror"
                                      placeholder="{{ __('Veuillez entrer la description du type de transaction') }}">{{old('description', $transactionType->description)}}</textarea>

                            @error('description')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Save button -->
                        <div class="d-sm-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mb-0">
                                {{ ($transactionType->exists) ? __('Modifier') : __('Enregistrer') }}
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
