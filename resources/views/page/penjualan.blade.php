@extends('components.master')
@section('title', 'PENJUALAN')
@push('head')
    <style>
        .color-card {
            background-color: rgb(14, 12, 27);
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

            .for-flex {
                display: flex;
                justify-content: space-around;
                flex-wrap: wrap;
            }

        }

        @media (min-width: 1200px) {
            .for-flex {
                display: flex;
                flex-direction: row;
                justify-content: space-around;
            }
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css') }}">
@endpush

@section('container')
    <div class="page-heading d-flex justify-content-between">
        <div class="flex-start">
            <h3>Penjualan</h3>
        </div>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <p>Penjualan Table</p>
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalKasir">Kasir</button>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Transaksi</th>
                                            <th>Jumlah Barang</th>
                                            <th>Nominal Bayar</th>
                                            <th>Total Bayar</th>
                                            <th>Kembalian</th>
                                            <th>Waktu</th>
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
                                                100000
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

    {{-- MODAL KASIR --}}
    <div class="modal fade" id="modalKasir" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div>
                    <form id="form_kasir">
                        <div class="modal-header d-flex justify-content-center">
                            <h5 class="modal-title" id="exampleModalScrollableTitle">Kasir</h5>
                        </div>
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-5 col-md-12 col-sm-12">
                                    <div class="card row-color">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <fieldset class="form-group">
                                                            <label for="basicInput">ID Pelanggan</label>
                                                            <input type="number" class="form-control mb-3 mt-2"
                                                                name="id_pelanggan" id="id_pelanggan">
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label for="basicInput">Tanggal</label>
                                                            <input type="date" class="form-control mb-3 mt-2"
                                                                name="tanggal" id="tanggal">
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-12 col-sm-12">
                                    <div class="card row-color">
                                        <div class="card-header header-color">
                                            <h4 class="card-title text-center">Keterangan Anggota</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <fieldset class="form-group">
                                                            <label for="basicInput">ID ANGGOTA</label>
                                                            <input type="number" class="form-control mb-3 mt-2"
                                                                name="id_anggota" id="id_anggota" readonly>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label for="basicInput">Nama</label>
                                                            <input type="text" id="nama_anggota"
                                                                class="form-control mb-3 mt-2" name="nama" readonly>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <fieldset class="form-group">
                                                            <label for="basicInput">Poin</label>
                                                            <input type="number" class="form-control mb-3 mt-2"
                                                                name="poin" id="poin" readonly>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label for="basicInput">Credit</label>
                                                            <input type="number" class="form-control mb-3 mt-2"
                                                                name="credit" id="credit" readonly>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="row">

                                        <center>
                                            <a href="#" id="tukar_poin" type="button" value="1"
                                                name="tukar_poin" class="btn btn-primary mb-1 px-5 py-4">Tukar Poin</a>
                                            <input type="number" name="jumlah_poin" id="jumlah_poin" hidden>
                                            <a href="#" class="btn btn-success mb-1 px-5 py-4">&nbsp;Cetak&nbsp;</a>
                                        </center>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="for-flex">
                                                <form id="add_table_kasir" method="post">
                                                    @csrf
                                                    <center>
                                                        <p>ID Barang</p>
                                                        <input type="number" id="id_barang" name="id_barang">
                                                    </center>
                                                    <center>
                                                        <p>Stok</p>
                                                        <input type="number" id="stok" name="stok" readonly>
                                                    </center>
                                                    <center>
                                                        <p>Jumlah Barang</p>
                                                        <input type="number" id="jumlah_barang" name="jumlah_barang">
                                                    </center>
                                                    <center>
                                                        <p>Harga Jual</p>
                                                        <input type="number" id="harga_jual" name="harga_jual" readonly>
                                                    </center>
                                                    <center>
                                                        <p>Harga Akhir</p>
                                                        <input type="number" id="harga_akhir" name="harga_akhir"
                                                            readonly>
                                                    </center>
                                                    <center>
                                                        {{-- <p class="mt-3">Tambah produk</p> --}}
                                                        <a type="submit"" class="btn btn-primary mt-3" id="btn_tambah"
                                                            onclick="tambahBaris()">Tambah</a>
                                                    </center>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {{-- TABLE --}}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="table_kasir">
                                                    <thead>
                                                        <tr>
                                                            <th>Delete</th>
                                                            <th>ID Barang</th>
                                                            <th>Kategori</th>
                                                            <th>Nama Barang</th>
                                                            <th>Jumlah Barang</th>
                                                            <th>Harga Jual</th>
                                                            <th>Harga Akhir</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <a href="#" class="btn btn-primary my-5" id="hitung_sub_total">Hitung</a>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="card row-color">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <fieldset class="form-group">
                                                            <label for="basicInput">Sub Total</label>
                                                            <input type="number" class="form-control mb-3 mt-2"
                                                                name="sub_total" id="sub_total" readonly>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label for="basicInput">Diskon</label>
                                                            <div class="row">
                                                                <div class="col-5">
                                                                    <input type="number" class="form-control mb-3 mt-2"
                                                                        name="diskon" id="diskon" readonly>
                                                                </div>
                                                                <div class="col-1">
                                                                    <p class="text-center">%=</p>
                                                                </div>
                                                                <div class="col-6">
                                                                    <input type="number" class="form-control mb-3 mt-2"
                                                                        name="hasil_diskon" id="hasil_diskon" readonly>
                                                                </div>

                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label for="basicInput">Nominal Bayar</label>
                                                            <input type="number" class="form-control mb-3 mt-2"
                                                                name="nominal_bayar" id="nominal_bayar" readonly>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="card row-color">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <fieldset class="form-group">
                                                            <label for="basicInput">Uang Bayar</label>
                                                            <input type="number" class="form-control mb-3 mt-2"
                                                                name="uang_bayar" id="uang_bayar" required readonly>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label for="basicInput">Kembalian</label>
                                                            <input type="number" class="form-control mb-3 mt-2"
                                                                name="kembalian" id="kembalian" readonly>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-around align-items-center">
                                    <p>Tambahan Poin Sebesar: <input type="number" id="tambahan_poin"
                                            name="tambahan_poin" readonly></p>
                                    <p>Metode Pembayaran:
                                        <select name="metode_pembayaran" id="metode_pembayaran">
                                            <option selected hidden>Pilih Metode Pembayaran</option>
                                            <option value="tunai">Tunai</option>
                                            <option value="kredit" id="option_kredit">Kredit</option>
                                        </select>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Batal</span>
                            </button>
                            <button type="submit" class="btn btn-primary ml-1" id="btn_save" hidden>
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Simpan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div class="modal fade" id="modalEditAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Profile</h5>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="d-flex justify-content-between">
                            <div class="flex-start">
                                <div class="form-group mb-3">
                                    <label for="basicInput">NIK</label>
                                    <input type="text" class="form-control mt-3"round id="basicInput" name="nik">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">Nama Lengkap</label>
                                    <input type="text" class="form-control mt-3"round id="basicInput"
                                        name="nama_lengkap">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">Tempat Lahir</label>
                                    <input type="text" class="form-control mt-3"round id="basicInput"
                                        name="tempat_lahir">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">Tanggal Lahir</label>
                                    <input type="date" class="form-control mt-3"round id="basicInput"
                                        name="tanggal_lahir">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">Alamat Lengkap</label>
                                    <textarea type="text" class="form-control mt-3"round id="basicInput" name="nama_lengkap"></textarea>
                                </div>
                            </div>
                            <div class="flex-end">
                                <div class="form-group mb-3">
                                    <label for="basicInput">Jenis Kelamin</label>
                                    <select class="form-select mt-3" id="basicSelect" name="jenis_kelamin">
                                        <option selected hidden>Pilih Jenis Kelamin</option>
                                        <option value="0">Laki-laki</option>
                                        <option value="1">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">No Telepon</label>
                                    <input type="number" class="form-control mt-3"round id="basicInput" name="telp">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">Status Pernikahan</label>
                                    <select class="form-select mt-3" id="basicSelect" name="status_nikah">
                                        <option selected hidden>Pilih Status Pernikahan</option>
                                        <option value="0">Menikah</option>
                                        <option value="1">Belum Menikah</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">PIN</label>
                                    <input type="number" class="form-control mt-3"round id="basicInput" name="PIN">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">Re-type PIN</label>
                                    <input type="number" class="form-control mt-3"round id="basicInput" name="rpin">
                                </div>
                            </div>
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

    {{-- MODAL DELETE --}}
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
    @include('scripts.kasir')
@endpush
