{{-- resources/view/administrator/dashboard/country/form.blade.php --}}

@extends($profile . '.dashboard.base')

@section('sub-title', ($country->exists) ? __('Modifier pays') : __('Ajouter pays'))

@section('main-content')
    <div class="card bg-transparent border rounded-3">
        <div class="card-header bg-transparent border-bottom">
            <h5 class="card-header-title mb-0">
                {{ ($country->exists) ? __('Modifier pays') : __('Ajouter pays') }}
            </h5>
            <p class="text-danger mb-0">
                {{ __('Les champs avec * sont obligatoires.') }}
            </p>
        </div>

        <div class="card-body">
            <form class="row g-4"
                  action="{{ ($country->exists) ? route($profile . '.country.update', ['country' => $country]) : route($profile . '.country.create', ['country' => $country]) }}"
                  method="post">

                @csrf

                <input type="hidden" name="country_id" value="{{ $country->id }}">

                <!-- Nom -->
                <div class="col-md-4">
                    <label class="form-label" for="country-name">
                        {{ __('Nom du pays') }}
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="name" id="country-name"
                           class="form-control country-name @error('name'){{'is-invalid'}}@enderror"
                           value="{{ old('name', $country->name) }}"
                           placeholder="{{ __('Veuillez entrer le nom du pays') }}">
                    @error('name')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Code -->
                <div class="col-md-4">
                    <label class="form-label" for="country-code">
                        {{ __('Code du pays') }}
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="code" id="country-code"
                           class="form-control country-code @error('code'){{'is-invalid'}}@enderror"
                           value="{{ old('code', $country->code) }}"
                           placeholder="{{ __('Veuillez entrer le code du pays') }}">
                    @error('code')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Indicatif -->
                <div class="col-md-4">
                    <label class="form-label" for="country-phone-code">
                        {{ __('Indicatif téléphonique') }}
                        <span class="text-danger">*</span>
                    </label>
                    <input type="number" name="phone_code" id="country-phone-code"
                           class="form-control country-phone-code @error('phone_code'){{'is-invalid'}}@enderror"
                           placeholder="{{ __('Veuillez entrer l\'indicatif téléphonique') }}"
                           value="{{ old('phone_code', substr($country->phone_code, 1)) }}">
                    @error('phone_code')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Save button -->
                <div class="d-sm-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary mb-0">
                        {{ ($country->exists) ? __('Modifier') : __('Enregistrer') }}
                    </button>
                </div>

            </form>
        </div>
    </div>

@endsection

