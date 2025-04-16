<style>
    .range_container {
        display: flex;
        flex-direction: column;
        width: 80%;
        margin: 15px auto;
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
        width: 100px;
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
                <div class="accordion py-3" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Szűrők
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{ route('products.filter') }}" method="get" id="filter_form">
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
                                                        <select name="tulajdonsag_{{ $tulajdonsag->tul_nev_id }}" id="tulajdonsag" class="form-select"
                                                            onchange="this.form.submit()">
                                                            <option value="">Összes</option>
                                                            @foreach ($tulajdonsagok_ertek as $ertek)
                                                                @if ($ertek->kat_tul_id == $tulajdonsag->kat_tul_id)
                                                                    <option value="{{ $ertek->tul_ertek }}"
                                                                        {{ isset($request) && request()->get("tulajdonsag_$tulajdonsag->tul_nev_id") == $ertek->tul_ertek ? 'selected' : '' }}>
                                                                        {{ $ertek->tul_ertek }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    {{-- @else
                                                        <div class="range_container">
                                                            <div class="sliders_control">
                                                                <input id="fromSlider_{{ $tulajdonsag->tul_nev_id }}" type="range"
                                                                    value="{{ isset($request) && request()->get("min_$tulajdonsag->tul_nev_id") != null ? request()->get("min_$tulajdonsag->tul_nev_id") : $tul_ertek_min[$tulajdonsag->tul_nev_id] }}"
                                                                    min="{{ $tul_ertek_min[$tulajdonsag->tul_nev_id] }}"
                                                                    max="{{ $tul_ertek_max[$tulajdonsag->tul_nev_id] }}"
                                                                    name="min_{{ $tulajdonsag->tul_nev_id }}"
                                                                    onchange="handleChange(this)"/>
                                                                <input id="toSlider_{{ $tulajdonsag->tul_nev_id }}" type="range"
                                                                    value="{{ isset($request) && request()->get("max_$tulajdonsag->tul_nev_id") != null ? request()->get("max_$tulajdonsag->tul_nev_id") : $tul_ertek_max[$tulajdonsag->tul_nev_id] }}"
                                                                    min="{{ $tul_ertek_min[$tulajdonsag->tul_nev_id] }}"
                                                                    max="{{ $tul_ertek_max[$tulajdonsag->tul_nev_id] }}"
                                                                    name="max_{{ $tulajdonsag->tul_nev_id }}"
                                                                    onchange="handleChange(this)"/>
                                                            </div>
                                                            <div class="form_control">
                                                                <div class="form_control_container">
                                                                    <div class="form_control_container__time">Min</div>
                                                                    <input class="form_control_container__time__input" type="number"
                                                                        id="fromInput_{{ $tulajdonsag->tul_nev_id }}"
                                                                        value="{{ isset($request) && request()->get("min_$tulajdonsag->tul_nev_id") != null ? request()->get("min_$tulajdonsag->tul_nev_id") : $tul_ertek_min[$tulajdonsag->tul_nev_id] }}"
                                                                        min="{{ $tul_ertek_min[$tulajdonsag->tul_nev_id] }}"
                                                                        max="{{ $tul_ertek_max[$tulajdonsag->tul_nev_id] }}" />
                                                                </div>
                                                                <div class="form_control_container">
                                                                    <div class="form_control_container__time">Max</div>
                                                                    <input class="form_control_container__time__input" type="number"
                                                                        id="toInput_{{ $tulajdonsag->tul_nev_id }}"
                                                                        value="{{ isset($request) && request()->get("max_$tulajdonsag->tul_nev_id") != null ? request()->get("max_$tulajdonsag->tul_nev_id") : $tul_ertek_max[$tulajdonsag->tul_nev_id] }}"
                                                                        min="{{ $tul_ertek_min[$tulajdonsag->tul_nev_id] }}"
                                                                        max="{{ $tul_ertek_max[$tulajdonsag->tul_nev_id] }}" />
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                    @endif
                                                @endforeach
                                            </div>

                                            <!-- Price range filter -->
                                            {{-- <div class="mb-3">
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
                                            </div> --}}
                                                <div class="range_container">
                                                    <div class="sliders_control mt-3">
                                                        <input id="fromSlider_" type="range"
                                                            value="{{ old('min_price',$min_ar->min_ar) }}"
                                                            min="{{ $min_ar->min_ar }}"
                                                            max="{{ $max_ar->max_ar }}"
                                                            name="min_price"
                                                            onchange="handleChange(this)"/>
                                                        <input id="toSlider_" type="range"
                                                            value="{{ old('max_price',$max_ar->max_ar) }}"
                                                            min="{{ $min_ar->min_ar }}"
                                                            max="{{ $max_ar->max_ar }}"
                                                            name="max_price"
                                                            onchange="handleChange(this)"/>
                                                    </div>
                                                    <div class="form_control">
                                                        <div class="form_control_container">
                                                            <div class="form_control_container__time">Min</div>
                                                            <input class="form_control_container__time__input" type="number"
                                                                id="fromInput_"
                                                                value="{{ old('min_price',$min_ar->min_ar) }}"
                                                                min="{{ $min_ar->min_ar }}"
                                                                max="{{ $max_ar->max_ar }}" />
                                                        </div>
                                                        <div class="form_control_container">
                                                            <div class="form_control_container__time">Max</div>
                                                            <input class="form_control_container__time__input" type="number"
                                                                id="toInput_"
                                                                value="{{ old('max_price',$max_ar->max_ar) }}"
                                                                min="{{ $min_ar->min_ar }}"
                                                                max="{{ $max_ar->max_ar }}" />
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
                        </div>
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
                                            {{ number_format($product->netto * $product->afa, 0, ',', ' ') }} Ft</p>
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
        function handleChange(e) {
            const newValue = Number(e.value);
            const id = e.id.split("_");
            if (e.id.includes("fromSlider")) {
                const fromInput = document.getElementById(`fromInput_`);
                fromInput.value = newValue;
                const to = document.getElementById(`toSlider_`)
                const toValue = Number(to.value);
                if (newValue > toValue) {
                    console.log(e.id, newValue, toValue);
                    if (newValue == e.max){
                        to.value = newValue;
                    }
                    else {
                        to.value = newValue + 1;
                    }
                document.getElementById(`toInput_`).value = to.value;
                }
            }

            else if (e.id.includes("toSlider")) {
                const toInput = document.getElementById(`toInput_`);
                toInput.value = newValue;
                const from = document.getElementById(`fromSlider_`);
                const fromValue = Number(from.value);
                if (newValue < fromValue) {
                    console.log(e.id, newValue, fromValue);
                    if (newValue == e.min) {
                        from.value = newValue;
                    }
                    else {
                        from.value = newValue - 1;
                    }
                document.getElementById(`fromInput_`).value = from.value;
                }
            }
        document.getElementById("filter_form").submit();
        }

        var classList = document.getElementById('collapseOne').classList;

        var minWidth576 = window.matchMedia("(min-width: 576px)");

        function match() {
            minWidth576.matches ? classList.add('show') : classList.remove('show');
        }

        minWidth576.addListener(match);

        match();
    </script>
@endsection
