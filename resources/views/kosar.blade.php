@extends('layout')
@section('content')
        <div class="container-fluid">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

            <div class="container">
                <div class="row">
                    <div class="col-xl-8">
                        <div class="card border shadow-none">
                            <div class="card-body">

                                <div class="d-flex align-items-start border-bottom pb-3">
                                    <div class="me-4">
                                        <img src="https://www.bootdey.com/image/380x380/008B8B/000000" alt="" class="avatar-lg rounded">
                                    </div>
                                    <div class="flex-grow-1 align-self-center overflow-hidden">
                                        <div>
                                            <h5 class="text-truncate font-size-18"><a href="#" class="text-dark">Vízálló Mobiltelefon </a></h5>
                                            <p class="text-muted mb-0">
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star-half text-warning"></i>
                                            </p>
                                            <p class="mb-0 mt-1">Szín : <span class="fw-medium">Szürke</span></p>
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
                                                <h5 class="mb-0 mt-2"><span class="text-muted me-2"><del class="font-size-16 fw-normal">$500</del></span>$450</h5>
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
                                        <div class="col-md-3">
                                            <div class="mt-3">
                                                <p class="text-muted mb-2">Összesen</p>
                                                <h5>$900</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- end card -->

                        <div class="card border shadow-none">
                            <div class="card-body">

                                <div class="d-flex align-items-start border-bottom pb-3">
                                    <div class="me-4">
                                        <img src="https://www.bootdey.com/image/380x380/FF00FF/000000" alt="" class="avatar-lg rounded">
                                    </div>
                                    <div class="flex-grow-1 align-self-center overflow-hidden">
                                        <div>
                                            <h5 class="text-truncate font-size-18"><a href="#" class="text-dark">Dupla kamerás Okostelefon </a></h5>
                                            <p class="text-muted mb-0">
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                            </p>
                                            <p class="mb-0 mt-1">Szín : <span class="fw-medium">Zöld</span></p>
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
                                                <h5 class="mb-0 mt-2"><span class="text-muted me-2"><del class="font-size-16 fw-normal">$280</del></span>$240</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="mt-3">
                                                <p class="text-muted mb-2">Mennyiség</p>
                                                <div class="d-inline-flex">
                                                    <select class="form-select form-select-sm w-xl">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3" selected="">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mt-3">
                                                <p class="text-muted mb-2">Összesen</p>
                                                <h5>$720</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- end card -->

                        <div class="card border shadow-none">
                            <div class="card-body">

                                <div class="d-flex align-items-start border-bottom pb-3">
                                    <div class="me-4">
                                        <img src="https://www.bootdey.com/image/380x380/FF8C00/000000" alt="" class="avatar-lg rounded">
                                    </div>
                                    <div class="flex-grow-1 align-self-center overflow-hidden">
                                        <div>
                                            <h5 class="text-truncate font-size-18"><a href="#" class="text-dark">Fekete színű Okostelefon </a></h5>
                                            <p class="text-muted mb-0">
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                            </p>
                                            <p class="mb-0 mt-1">Szín : <span class="fw-medium">Kék</span></p>
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
                                                <h5 class="mb-0 mt-2"><span class="text-muted me-2"><del class="font-size-16 fw-normal">$750</del></span>$950</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="mt-3">
                                                <p class="text-muted mb-2">Mennyiség</p>
                                                <div class="d-inline-flex">
                                                    <select class="form-select form-select-sm w-xl">
                                                        <option value="1" selected="">1</option>
                                                        <option value="2">2</option>
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
                                        <div class="col-md-3">
                                            <div class="mt-3">
                                                <p class="text-muted mb-2">Összesen</p>
                                                <h5>$950</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- end card -->

                        <div class="row my-4">
                            <div class="col-sm-6">
                                <a href="./sablon.html" class="btn btn-link text-muted">
                                    <i class="mdi mdi-arrow-left me-1"></i> Vásárlás folytatása </a>
                            </div> <!-- end col -->
                            <div class="col-sm-6">
                                <div class="text-sm-end mt-2 mt-sm-0">
                                    <a href="#" class="btn btn-success">
                                        <i class="mdi mdi-cart-outline me-1"></i> Adatok megadása </a>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row-->
                    </div>

                    <div class="col-xl-4">
                        <div class="mt-5 mt-lg-0">
                            <div class="card border shadow-none">
                                <div class="card-header bg-transparent border-bottom py-3 px-4">
                                    <h5 class="font-size-16 mb-0">Rendelés összesítés <span class="float-end">#MN0124</span></h5>
                                </div>
                                <div class="card-body p-4 pt-2">

                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <tbody>
                                                <tr>
                                                    <td>Tételek összege :</td>
                                                    <td class="text-end">$ 780</td>
                                                </tr>
                                                <tr>
                                                    <td>Kedvezmény : </td>
                                                    <td class="text-end">- $ 78</td>
                                                </tr>
                                                <tr>
                                                    <td>Házhozszállítás díja :</td>
                                                    <td class="text-end">$ 25</td>
                                                </tr>
                                                <tr>
                                                    <td>ÁFA : </td>
                                                    <td class="text-end">$ 18.20</td>
                                                </tr>
                                                <tr class="bg-light">
                                                    <th>Összesen :</th>
                                                    <td class="text-end">
                                                        <span class="fw-bold">
                                                            $ 745.2
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- end table-responsive -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div>
        </div>
@endsection
