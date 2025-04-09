    @extends('layout')
    @section('content')
    <div class="container py-3">
        <div class="d-flex justify-content-center">
            <div class="w-75">
                <h2 class="text-center">Köszönjük a megrendelését!</h2>
                @foreach ($order as $row)
                    <div class="row">
                        <div class="col-8"><b>{{ $row['nev'] }} - {{ $row['db']}} darab</b></div>
                        <div class="col-4 text-end"><b>{{ number_format($row['ar']*$row['db'],0,',',' ') }} Ft</b></div>
                    </div>
                @endforeach
                <hr>
                <p><b>Összesen: {{ number_format( $total,0,',',' ') }}</b> Ft</p>
            </div>
        </div>
    </div>
    @endsection
