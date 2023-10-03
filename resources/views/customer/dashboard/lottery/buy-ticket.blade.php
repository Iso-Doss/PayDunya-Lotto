{{-- resources/view/customer/dashboard/lottery/buy-ticket.blade.php --}}

@extends($profile . '.dashboard.base')

@section('title', __('Acheter un billet de loterie'))

@section('main-content')
    <div class="card bg-transparent border rounded-3">
        <div class="card-header bg-transparent border-bottom">
            <h5 class="card-header-title mb-0">
                {{ __('Acheter un billet de loterie') }}
            </h5>
            <p class="text-danger mb-0">
                {{ __('Les champs avec * sont obligatoires.') }}
            </p>
        </div>
        <div class="card-body">
            <form class="row g-4" action="{{ route($profile . '.lottery.buy-ticket') }}" method="post"
                  enctype="multipart/form-data">
                @csrf

                <!-- Lottery -->
                <div class="col-12">
                    <label for="buy-ticket-lottery-id" class="form-label">
                        {{ __('Loterie : ') }}
                    </label>
                    @if(!empty($lotteries))
                        <select name="lottery_id" id="buy-ticket-lottery-id"
                                class="form-select me-1 mt-2 buy-ticket-lottery-id @error('lottery_id'){{'is-invalid'}}@enderror">
                            <option value="">
                                {{ __('Veuillez sélectionner la loterie') }}
                            </option>
                            @foreach($lotteries as $lottery)
                                <option
                                    value="{{ $lottery->id }}" @selected((@old('lottery_id') ?? '') == $lottery->id)>
                                    {{ $lottery->name }}
                                </option>
                            @endforeach
                        </select>
                    @else
                        <p class="me-1 mt-3">
                            {{ __('Aucune loterie n\'est disponible pour le moment.') }}
                        </p>
                    @endif

                    @error('lottery_id')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Ticket -->
                <div class="col-12">
                    <label for="buy-ticket-ticket-id" class="form-label">
                        {{ __('Billet de loterie : ') }}
                    </label>
                    @if(!empty($tickets))
                        <select name="ticket_id" id="buy-ticket-ticket-id"
                                class="form-select me-1 mt-2 buy-ticket-lottery-id @error('ticket_id'){{'is-invalid'}}@enderror">
                            <option value="">
                                {{ __('Veuillez sélectionner le billet de loterie') }}
                            </option>
                            @foreach($tickets as $ticket)
                                <option
                                    value="{{ $ticket->id }}" @selected((@old('ticket_id') ?? '') == $ticket->id)>
                                    {{ $ticket->name }}
                                </option>
                            @endforeach
                        </select>
                    @else
                        <p class="me-1 mt-3">
                            {{ __('Aucun billet n\'est disponible pour le moment.') }}
                        </p>
                    @endif

                    @error('ticket_id')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Numbers drawn -->
                <div class="col-12">
                    <label class="form-label" for="buy-ticket-numbers-drawn">
                        {{ __('Numéro de gagnant (Veuillez choisir sept numéros distinct compris entre 1 et 50, séparé par des virgule)') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <input type="text" name="numbers_drawn" id="buy-ticket-numbers-drawn"
                               class="form-control buy-ticket-numbers-drawn @error('numbers_drawn'){{'is-invalid'}}@enderror"
                               value="{{ old('numbers_drawn') }}"
                               placeholder="{{ __('Veuillez choisir sept numéros distinct compris entre 1 et 50, séparé par des virgule') }}">
                    </div>
                    @error('numbers_drawn')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Phone number -->
                <div class="col-12">
                    <label class="form-label" for="buy-ticket-phone-number">
                        {{ __('Numéro de téléphone') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-phone-alt"></i>
                        </span>
                        <input type="number" name="phone_number" id="buy-ticket-phone-number"
                               class="form-control buy-ticket-phone-number @error('phone_number'){{'is-invalid'}}@enderror"
                               value="{{ old('phone_number', auth('customer')->user()->phone_number) }}"
                               placeholder="{{ __('Veuillez entrer votre nom d\'utilisateur') }}">
                    </div>
                    @error('phone_number')
                    <div class="form-text text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Save button -->
                <div class="d-sm-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mb-0">
                        {{ __('Acheter un billet') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

{{--@section('template-functions')--}}
{{--@endsection--}}
