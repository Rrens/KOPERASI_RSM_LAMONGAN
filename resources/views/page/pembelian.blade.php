@extends('components.master')
@section('title', 'PEMBELIAn')
@push('head')
    <style>
        .color-card {
            background-color: rgb(14, 12, 27);
        }

        .img-container {
            /* position: relative; */
            /* padding-top: 100%; */
        }

        img {
            max-width: 500px;
        }

        body.theme-dark a {
            /* text-decoration: none !important;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                color: white; */
            color: inherit;
            text-decoration: none !important;
        }

        .row-color,
        .header-color {
            background-color: #19191c !important;
        }
    </style>
    <style>
        .cards-wrapper {
            display: flex;
            justify-content: center;
        }

        .card img {
            max-width: 100%;
            max-height: 100%;
        }

        .card {
            margin: 0 0.5em;
            box-shadow: 2px 6px 8px 0 rgba(22, 22, 26, 0.18);
            border: none;
            border-radius: 0;
        }

        .carousel-inner {
            padding: 1em;
        }

        .carousel-control-prev,
        .carousel-control-next {
            background-color: #e1e1e1;
            width: 5vh;
            height: 5vh;
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
        }

        @media (min-width: 768px) {
            .card img {
                height: 11em;
            }
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css') }}">
@endpush

@section('container')
    <div class="page-heading d-flex justify-content-between">
        <div class="flex-start">
            <h3>Pembelian Control</h3>
        </div>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <p>Pembelian Table</p>
                                <div class="flex-end">
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modalTambah">Tambah</button>

                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Anggota</th>
                                            <th>Nama</th>
                                            <th>Password</th>
                                            <th>Kelamin</th>
                                            <th>No Telp</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-bold-500">
                                                1
                                            </td>

                                            <td class="text-bold-500">
                                                1229199
                                            </td>
                                            <td class="text-bold-500">
                                                Rahma Anjani
                                            </td>
                                            <td class="text-bold-500">
                                                RahmaPaheho123
                                            </td>
                                            <td class="text-bold-500">
                                                Perempuan
                                            </td>
                                            <td class="text-bold-500">
                                                081288812877
                                            </td>
                                            <td class="text-bold-500">
                                                Sebelahe omah ketek gede
                                            </td>
                                            <td>
                                                <a class="tagA btn btn-outline-warning" href="#"
                                                    data-bs-toggle="modal" data-bs-target="#modalEditAdmin">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <a class="tagA btn btn-outline-danger" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#modalDeleteAdmin">
                                                    <i class="bi bi-trash-fill"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a class="tagA btn btn-primary" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#modalToggleDetail"><i
                                                        class="bi bi-exclamation-triangle-fill"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>


    {{-- MODAL TAMBAH --}}
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Pembelian</h5>
                </div>
                {{-- <form action="" method="post" enctype="multipart/form-data"> --}}
                {{-- @csrf --}}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="basicInput">Nama Barang</label>
                                <input type="text" class="form-control mt-3" id="nama_barang" value=""
                                    name="nama_barang">
                            </div>
                            <div class="form-group mb-3">
                                <label for="basicInput">Kategori</label>
                                <fieldset class="form-group mt-3">
                                    <select class="form-select" id="kategori" name="kategori">
                                        <option value="makanan">Makanan</option>
                                        <option value="minuman">Minuman</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="form-group mb-3">
                                <label for="basicInput">Jumlah Barang</label>
                                <input type="number" class="form-control mt-3" id="jumlah_barang" value=""
                                    name="jumlah_barang">
                            </div>
                            <div class="form-group mb-3">
                                <label for="basicInput">Keterangan</label>
                                <textarea type="text" class="form-control mt-3" id="keterangan" name="keterangan"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="basicInput">Harga Beli</label>
                                <input type="number" class="form-control mt-3" id="harga_beli" name="harga_beli">
                            </div>
                            <div class="form-group mb-3">
                                <label for="basicInput">Harga Jual</label>
                                <input type="number" class="form-control mt-3" id="harga_jual" name="harga_jual">
                            </div>
                            <div class="form-group mb-3">
                                <label for="basicInput">Total Harga</label>
                                <input type="number" class="form-control mt-3" id="total_harga" name="total_harga">
                            </div>
                            <div class="form-group mb-3">
                                <a href="#" class="btn btn-primary mt-5" id="tambah_tabel"
                                    onclick="tambahBaris()">Tambah</a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped" id="table_tambah">
                            <thead>
                                <tr>
                                    <th>Hapus</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Jumlah Barang</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Total Harga</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Batal</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1" id="btn_save">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Simpan</span>
                    </button>
                </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div class="modal fade" id="modalEditAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Pembelian</h5>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="basicInput">No Transaksi</label>
                                    <input type="number" class="form-control mt-3"round id="basicInput"
                                        name="no_transaksi">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">Nama Barang</label>
                                    <input type="text" class="form-control mt-3"round id="basicInput"
                                        name="nama_barang">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">Kategori</label>
                                    <fieldset class="form-group mt-3">
                                        <select class="form-select" id="basicSelect" name="kategori">
                                            <option>Makanan</option>
                                            <option>Minuman</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">Keterangan</label>
                                    <textarea type="text" class="form-control mt-3"round id="keterangan" name="keterangan"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="basicInput">Harga Beli</label>
                                    <input type="number" class="form-control mt-3"round id="basicInput"
                                        name="harga_beli">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">Harga Jual</label>
                                    <input type="number" class="form-control mt-3"round id="basicInput"
                                        name="harga_jual">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">Total Harga</label>
                                    <input type="number" class="form-control mt-3"round id="total_harga"
                                        name="total_harga">
                                </div>
                                <div class="form-group mb-3">

                                    <button class="btn btn-primary mt-5" id="simpan_sementara">Simpan</button>
                                </div>
                            </div>
                        </div>


                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Harga Beli</th>
                                        <th>Jumlah Barang</th>
                                        <th>Total Harga</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-bold-500">
                                            1
                                        </td>
                                        <td class="text-bold-500">
                                            1229199
                                        </td>
                                        <td class="text-bold-500">
                                            Rahma Anjani
                                        </td>
                                        <td class="text-bold-500">
                                            RahmaPaheho123
                                        </td>
                                        <td class="text-bold-500">
                                            Perempuan
                                        </td>
                                        <td class="text-bold-500">
                                            081288812877
                                        </td>
                                        <td class="text-bold-500">
                                            Sebelahe omah ketek gede
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Batal</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div class="modal fade" id="modalDeleteAdmin" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Profile</h5>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Batal</span>
                    </button>
                    <a href="#" class="btn btn-danger ml-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Hapus</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @include('scripts.pembelian-tambah')
@endpush
