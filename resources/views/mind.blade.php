@extends('layout')
@section('content')
@foreach ($result as $row)
<div class="card border shadow-none">
    <div class="card-body">

        <div class="d-flex align-items-start border-bottom pb-3">
            <div class="me-4">
                <img src="https://www.bootdey.com/image/380x380/008B8B/000000" alt="" class="avatar-lg rounded">
            </div>
            <div class="flex-grow-1 align-self-center overflow-hidden">
                <div>
                    <h5 class="text-truncate font-size-18"><a href="#" class="text-dark">{{$row->tnev}}</a></h5>
                    <p class="text-muted mb-0">
                        <i class="bx bxs-star text-warning"></i>
                        <i class="bx bxs-star text-warning"></i>
                        <i class="bx bxs-star text-warning"></i>
                        <i class="bx bxs-star text-warning"></i>
                        <i class="bx bxs-star-half text-warning"></i>
                    </p>
                </div>
            </div>
            <div class="flex-shrink-0 ms-2">
                <ul class="list-inline mb-0 font-size-16">
                    <li class="list-inline-item">
                        <a href="#" class="text-muted px-1">
                            <i class="mdi mdi-trash-can-outline"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="text-muted px-1">
                            <i class="mdi mdi-heart-outline"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div>
            <div class="row">
                <div class="col-md-4">
                    <div class="mt-3">
                        <p class="text-muted mb-2">Ár</p>
                        <h5 class="mb-0 mt-2">{{$row->tar}} Ft</h5>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="mt-3">
                        <p class="text-muted mb-2">Mennyiség</p>
                        <div class="d-inline-flex">
                            <select class="form-select form-select-sm w-xl">
                                <option value="1">1</option>
                                <option value="2" selected="">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endforeach
@endsection
