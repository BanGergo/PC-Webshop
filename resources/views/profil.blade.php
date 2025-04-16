<style>
    td:last-child{
        width: 100px;
    }
</style>
@extends('layout')
@section('content')
    <div class="mx-auto my-2 col-md-8">
        @error('sv')
            <div class="alert alert-success my-3">
                {{ $message }}
            </div>
        @enderror
            <div class="row">
                <div class="col-md">
                    <h1 class="text-center py-3">{{ Auth::user()->username }} profilja</h1>
                    <p class="text-start">Felhasználónév: {{ Auth::user()->username }}</p>
                    <p class="text-start">E-mail cím: {{ Auth::user()->email }}</p>
                    <p class="text-start">Tag már: {{ date_format(date_create(Auth::user()->created_at), 'Y. m. d.') }} óta!
                    </p>
                    <p class="text-start">Jelszó módosítása: <a class="btn btn-primary" data-bs-target="#passChangeModal" data-bs-toggle="modal" id="passChangeInput">itt</a></p>
                    <p class="text-start">Utolsó módosítás dátuma:
                        {{ date_format(date_create(Auth::user()->updated_at), 'Y. m. d.') }} |
                        {{ date_format(date_create(Auth::user()->updated_at), 'h : m') }}</p>
                        <div class="modal fade justify-content-end" id="passChangeModal" aria-labelledby="passChangeModalLabel" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="loginModalLabel"><strong>Jelszó módosítás</strong></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/passMod" method="POST">
                                            @csrf
                                            <div class="py-2">
                                                <label class="form-label" for="old_pass"><strong>Régi jelszó:*</strong></label>
                                                <input type="password" name="old_pass" id="old_pass" class="form-control" >
                                                @error('old_pass')
                                                    <span class="text-danger">{{$message}}</span><br>
                                                @enderror
                                            </div>
                                            <div class="py-2">
                                                <label class="form-label" for="new_pass"><strong>Új jelszó:*</strong></label>
                                                <input type="password" name="new_pass" id="new_pass" class="form-control" >
                                                @error('new_pass')
                                                    <span class="text-danger">{{$message}}</span><br>
                                                @enderror
                                            </div>
                                            <div class="py-2">
                                                <label class="form-label" for="new_pass_confirmation"><strong>Új jelszó mégegyszer:*</strong></label>
                                                <input type="password" name="new_pass_confirmation" id="new_pass_confirmation" class="form-control" >
                                                @error('new_pass')
                                                    <span class="text-danger">{{$message}}</span><br>
                                                @enderror
                                            </div>
                                            <div class="py-2 d-flex justify-content-center">
                                                <button class="btn btn-primary" type="submit">Jelszó módosítása</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer mx-auto">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div>
                        <h2 class="text-center py-3">Korábbi rendelések</h2>
                        @if (count($result) == 0)
                            <p class="text-center">Nincsenek korábbi rendelések!</p>
                        @else
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Rendelés azonosító</th>
                                        <th>Termékek</th>
                                        <th>Mennyiség</th>
                                        <th>Ár</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < count($azon); $i++)
                                        <tr>
                                            <td>{{ $azon[$i]->rendt_id }}</td>
                                            <td>
                                                @foreach ($result as $termekek)
                                                    @if ($termekek->rendt_id == $azon[$i]->rendt_id)
                                                        {{ $termekek->cikkszam. ' - ' .$termekek->termek_nev}}<br>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($result as $mennyiseg)
                                                    @if ($mennyiseg->rendt_id == $azon[$i]->rendt_id)
                                                        {{$mennyiseg->menny}}<br>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($result as $arak)
                                                    @if ($arak->rendt_id == $azon[$i]->rendt_id)
                                                        {{ number_format($arak->netto*$arak->afa,0,',',' ') }}<br>
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
    </div>

    </div>
    <script type="text/javascript">
        const myModal = document.getElementById('passCahngeModal')
        const myInput = document.getElementById('passChangeInput')

        myModal.addEventListener('shown.bs.modal', () => {
            myInput.focus()
        })
    </script>
@endsection
