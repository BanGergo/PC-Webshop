<style>
    .range_container {
        display: flex;
        flex-direction: column;
        width: 80%;
        margin: 35% auto;
    }

    .sliders_control {
        position: relative;
        min-height: 50px;
    }

    .form_control {
        position: relative;
        display: flex;
        justify-content: space-between;
        font-size: 24px;
        color: #635a5a;
    }

    input[type=range]::-webkit-slider-thumb {
        -webkit-appearance: none;
        pointer-events: all;
        width: 24px;
        height: 24px;
        background-color: #fff;
        border-radius: 50%;
        box-shadow: 0 0 0 1px #C6C6C6;
        cursor: pointer;
    }

    input[type=range]::-moz-range-thumb {
        -webkit-appearance: none;
        pointer-events: all;
        width: 24px;
        height: 24px;
        background-color: #fff;
        border-radius: 50%;
        box-shadow: 0 0 0 1px #C6C6C6;
        cursor: pointer;
    }

    input[type=range]::-webkit-slider-thumb:hover {
        background: #f7f7f7;
    }

    input[type=range]::-webkit-slider-thumb:active {
        box-shadow: inset 0 0 3px #387bbe, 0 0 9px #387bbe;
        -webkit-box-shadow: inset 0 0 3px #387bbe, 0 0 9px #387bbe;
    }

    input[type="number"] {
        color: #8a8383;
        width: 50px;
        height: 30px;
        font-size: 20px;
        border: none;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        opacity: 1;
    }

    input[type="range"] {
        -webkit-appearance: none;
        appearance: none;
        height: 2px;
        width: 100%;
        position: absolute;
        background-color: #C6C6C6;
        pointer-events: none;
    }

    #fromSlider {
        height: 0;
        z-index: 1;
    }
</style>
@extends('layout')
@section('content')
    <div class="container">
        <h1 class="text-center">{{ $selectedCategory->kat_nev }}</h1>
        <hr class="mx-auto w-50">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Szűrők</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('products.filter') }}" method="get">
                            <!-- Hidden input to keep track of category -->
                            <input type="hidden" name="category" value="{{ $selectedCategory->kat_id }}">

                            <!-- Manufacturer filter -->
                            <div class="mb-3">
                                <label for="gyarto" class="form-label">Gyártók</label>
                                <select name="gyarto" id="gyarto" class="form-select" onchange="this.form.submit()">
                                    <option value="">Összes</option>
                                    @foreach ($gyartok as $gyarto)
                                        <option value="{{ $gyarto->gyarto_id }}"
                                            {{ isset($request) && $request->gyarto == $gyarto->gyarto_id ? 'selected' : '' }}>
                                            {{ $gyarto->gyarto_nev }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                @foreach ($tulajdonsagok as $tulajdonsag)
                                    <label for="{{ $tulajdonsag->tul_nev_id }}">{{ $tulajdonsag->tul_nev }}</label>
                                    @if ($tulajdonsag->mode == 'exact')
                                        <select name="tulajdonsag" id="tulajdonsag" class="form-select"
                                            onchange="this.form.submit()">
                                            <option value="">Összes</option>
                                            @foreach ($tulajdonsagok_ertek as $ertek)
                                                @if ($ertek->kat_tul_id == $tulajdonsag->kat_tul_id)
                                                    <option value="{{ $ertek->tul_ertek_id }}"
                                                        {{ isset($request) && $request->tulajdonsag == $ertek->tul_ertek_id ? 'selected' : '' }}>
                                                        {{ $ertek->tul_ertek }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    @else
                                        <div class="range_container">
                                            <div class="sliders_control">
                                                <input id="fromSlider_{{ $tulajdonsag->tul_nev_id }}" type="range"
                                                    value="{{ $tul_ertek_min[$tulajdonsag->tul_nev_id] }}"
                                                    min="{{ $tul_ertek_min[$tulajdonsag->tul_nev_id] }}"
                                                    max="{{ $tul_ertek_max[$tulajdonsag->tul_nev_id] }}"
                                                    name="min_{{ $tulajdonsag->tul_nev_id }}" />
                                                <input id="toSlider_{{ $tulajdonsag->tul_nev_id }}" type="range"
                                                    value="{{ $tul_ertek_max[$tulajdonsag->tul_nev_id] }}"
                                                    min="{{ $tul_ertek_min[$tulajdonsag->tul_nev_id] }}"
                                                    max="{{ $tul_ertek_max[$tulajdonsag->tul_nev_id] }}"
                                                    name="max_{{ $tulajdonsag->tul_nev_id }}" />
                                            </div>
                                            <div class="form_control">
                                                <div class="form_control_container">
                                                    <div class="form_control_container__time">Min</div>
                                                    <input class="form_control_container__time__input" type="number"
                                                        id="fromInput_{{ $tulajdonsag->tul_nev_id }}"
                                                        value="{{ $tul_ertek_min[$tulajdonsag->tul_nev_id] }}"
                                                        min="{{ $tul_ertek_min[$tulajdonsag->tul_nev_id] }}"
                                                        max="{{ $tul_ertek_max[$tulajdonsag->tul_nev_id] }}" />
                                                </div>
                                                <div class="form_control_container">
                                                    <div class="form_control_container__time">Max</div>
                                                    <input class="form_control_container__time__input" type="number"
                                                        id="toInput_{{ $tulajdonsag->tul_nev_id }}"
                                                        value="{{ $tul_ertek_max[$tulajdonsag->tul_nev_id] }}"
                                                        min="{{ $tul_ertek_min[$tulajdonsag->tul_nev_id] }}"
                                                        max="{{ $tul_ertek_max[$tulajdonsag->tul_nev_id] }}" />
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <!-- Price range filter -->
                            <div class="mb-3">
                                <label class="form-label">Ár tartomány</label>
                                <div class="row">
                                    <div class="col">
                                        <input type="number" name="min_price" class="form-control" placeholder="Min Ft"
                                            value="{{ isset($request) ? $request->min_price : '' }}">
                                    </div>
                                    <div class="col-1 text-center">-</div>
                                    <div class="col">
                                        <input type="number" name="max_price" class="form-control" placeholder="Max Ft"
                                            value="{{ isset($request) ? $request->max_price : '' }}">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Szűrés</button>
                            <a href="{{ route('products.byCategory', ['category' => $selectedCategory->kat_id]) }}"
                                class="btn btn-secondary">Alaphelyzet</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                @if ($products->count() > 0)
                    @foreach ($products as $product)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{ $product->url }}" alt="{{ $product->termek_nev }}" class="img-fluid">
                                    </div>
                                    <div class="col-md-8">
                                        <h5>{{ $product->termek_nev }}</h5>
                                        <p class="text-danger fw-bold">
                                            {{ number_format($product->netto * 1.27, 0, ',', ' ') }} Ft</p>
                                        <p>{{ Str::limit($product->leiras, 100) }}</p>
                                        <a href="/products/{{ $product->cikkszam }}" class="btn btn-primary">Részletek</a>
                                        <!-- Add to cart button could go here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-info">
                        Nincs találat a megadott szűrési feltételekkel.
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script text="javascript">
        function controlFromInput(fromSlider, fromInput, toInput, controlSlider) {
            const [from, to] = getParsed(fromInput, toInput);
            fillSlider(fromInput, toInput, '#C6C6C6', '#25daa5', controlSlider);
            if (from > to) {
                fromSlider.value = to;
                fromInput.value = to;
            } else {
                fromSlider.value = from;
            }
        }

        function controlToInput(toSlider, fromInput, toInput, controlSlider) {
            const [from, to] = getParsed(fromInput, toInput);
            fillSlider(fromInput, toInput, '#C6C6C6', '#25daa5', controlSlider);
            setToggleAccessible(toInput);
            if (from <= to) {
                toSlider.value = to;
                toInput.value = to;
            } else {
                toInput.value = from;
            }
        }

        function controlFromSlider(fromSlider, toSlider, fromInput) {
            const [from, to] = getParsed(fromSlider, toSlider);
            fillSlider(fromSlider, toSlider, '#C6C6C6', '#25daa5', toSlider);
            if (from > to) {
                fromSlider.value = to;
                fromInput.value = to;
            } else {
                fromInput.value = from;
            }
        }

        function controlToSlider(fromSlider, toSlider, toInput) {
            const [from, to] = getParsed(fromSlider, toSlider);
            fillSlider(fromSlider, toSlider, '#C6C6C6', '#25daa5', toSlider);
            setToggleAccessible(toSlider);
            if (from <= to) {
                toSlider.value = to;
                toInput.value = to;
            } else {
                toInput.value = from;
                toSlider.value = from;
            }
        }

        function getParsed(currentFrom, currentTo) {
            const from = parseInt(currentFrom.value, 10);
            const to = parseInt(currentTo.value, 10);
            return [from, to];
        }

        function fillSlider(from, to, sliderColor, rangeColor, controlSlider) {
            const rangeDistance = to.max - to.min;
            const fromPosition = from.value - to.min;
            const toPosition = to.value - to.min;
            controlSlider.style.background = `linear-gradient(
      to right,
      ${sliderColor} 0%,
      ${sliderColor} ${(fromPosition)/(rangeDistance)*100}%,
      ${rangeColor} ${((fromPosition)/(rangeDistance))*100}%,
      ${rangeColor} ${(toPosition)/(rangeDistance)*100}%,
      ${sliderColor} ${(toPosition)/(rangeDistance)*100}%,
      ${sliderColor} 100%)`;
        }

        function setToggleAccessible(currentTarget) {
            const toSlider = document.querySelector('#toSlider');
            if (Number(currentTarget.value) <= 0) {
                toSlider.style.zIndex = 2;
            } else {
                toSlider.style.zIndex = 0;
            }
        }

        const fromSlider = document.querySelector('#fromSlider');
        const toSlider = document.querySelector('#toSlider');
        const fromInput = document.querySelector('#fromInput');
        const toInput = document.querySelector('#toInput');
        fillSlider(fromSlider, toSlider, '#C6C6C6', '#25daa5', toSlider);
        setToggleAccessible(toSlider);

        fromSlider.oninput = () => controlFromSlider(fromSlider, toSlider, fromInput);
        toSlider.oninput = () => controlToSlider(fromSlider, toSlider, toInput);
        fromInput.oninput = () => controlFromInput(fromSlider, fromInput, toInput, toSlider);
        toInput.oninput = () => controlToInput(toSlider, fromInput, toInput, toSlider);
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            foreach ($tulajdonsagok as $tulajdonsag){
                if ($tulajdonsag->mode == 'range'){
                    initializeSlider('{{ $tulajdonsag->tul_nev_id }}');
                }
            }
        });

        function initializeSlider(id) {
            const fromSlider = document.querySelector(`#fromSlider_${id}`);
            const toSlider = document.querySelector(`#toSlider_${id}`);
            const fromInput = document.querySelector(`#fromInput_${id}`);
            const toInput = document.querySelector(`#toInput_${id}`);

            fillSlider(fromSlider, toSlider, '#C6C6C6', '#25daa5', toSlider);
            setToggleAccessible(toSlider);

            fromSlider.oninput = () => controlFromSlider(fromSlider, toSlider, fromInput);
            toSlider.oninput = () => controlToSlider(fromSlider, toSlider, toInput);
            fromInput.oninput = () => controlFromInput(fromSlider, fromInput, toInput, toSlider);
            toInput.oninput = () => controlToInput(toSlider, fromInput, toInput, toSlider);
        }

        // ... rest of your existing JavaScript functions ...
    </script>
@endsection
