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
                                            <th>Nominal Bayar</th>
                                            <th>Total Bayar</th>
                                            <th>Kembalian</th>
                                            <th>Waktu</th>
                                            <th>Aksi</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td class="text-bold-500">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="text-bold-500">
                                                    {{ $item->id }}
                                                </td>
                                                <td class="text-bold-500">
                                                    {{ $item->subtotal }}
                                                </td>
                                                <td class="text-bold-500">
                                                    {{ $item->total_bayar }}
                                                </td>
                                                <td class="text-bold-500">
                                                    {{ $item->kembalian }}
                                                </td>
                                                <td class="text-bold-500">
                                                    {{ $item->created_at != null ? $item->created_at->toDateString() : '' }}
                                                </td>
                                                <td>
                                                    <a class="tagA btn btn-outline-warning" href="#"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalEditAdmin{{ $item->id }}">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </a>
                                                    <a class="tagA btn btn-outline-danger" href="#"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalDeleteAdmin{{ $item->id }}">
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
                                        @endforeach
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
                                                                name="tanggal" id="tanggal" value="{{ $date }}">
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
                                                        <a type="submit" class="btn btn-primary mt-3" id="btn_tambah"
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
                                <div class="col-lg-6 col-md-12 col-sm-12" id="isTunai" hidden>
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
    @foreach ($data as $item)
        <div class="modal fade" id="modalEditAdmin{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div>
                        <form id="form_kasir_edit">
                            <div class="modal-header d-flex justify-content-center">
                                <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Kasir</h5>
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
                                                                <input type="number" value="{{ $item->id }}"
                                                                    name="id_penjualan" hidden>
                                                                <input type="number" class="form-control mb-3 mt-2"
                                                                    name="id_pelanggan_edit" id="id_pelanggan_edit"
                                                                    value="{{ $item->user[0]->id != null ? $item->user[0]->id : '' }}"
                                                                    readonly>
                                                            </fieldset>
                                                            <fieldset class="form-group">
                                                                <label for="basicInput">Tanggal</label>
                                                                <input type="date" class="form-control mb-3 mt-2"
                                                                    name="tanggal_edit" id="tanggal_edit"
                                                                    value="{{ $item->created_at != null ? $item->created_at->toDateString() : '' }}"
                                                                    readonly>
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
                                                        @php
                                                            // dd($item->user[0]);
                                                        @endphp
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <fieldset class="form-group">
                                                                <label for="basicInput">ID ANGGOTA</label>
                                                                <input type="number" class="form-control mb-3 mt-2"
                                                                    name="id_anggota_edit" id="id_anggota_edit"
                                                                    value="{{ $item->user[0]->id != null ? $item->user[0]->id : '' }}"
                                                                    readonly>
                                                            </fieldset>
                                                            <fieldset class="form-group">
                                                                <label for="basicInput">Nama</label>
                                                                <input type="text" id="nama_anggota_edit"
                                                                    class="form-control mb-3 mt-2"
                                                                    name="nama_anggota_edit"
                                                                    value="{{ $item->user[0]->name != null ? $item->user[0]->name : '' }}"
                                                                    readonly>
                                                            </fieldset>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <fieldset class="form-group">
                                                                <label for="basicInput">Poin</label>
                                                                <input type="number" class="form-control mb-3 mt-2"
                                                                    name="poin_edit" id="poin_edit"
                                                                    value="{{ $item->user[0]->poin != null ? $item->user[0]->poin : 0 }}"
                                                                    readonly>
                                                            </fieldset>
                                                            <fieldset class="form-group">
                                                                <label for="basicInput">Credit</label>
                                                                <input type="number" class="form-control mb-3 mt-2"
                                                                    name="credit_edit"
                                                                    value="{{ $item->user[0]->credit != null ? $item->user[0]->credit : 0 }}"
                                                                    id="credit_edit" readonly>
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
                                                <a href="#" id="tukar_poin_edit" type="button" value="1"
                                                    name="tukar_poin_edit" class="btn btn-primary mb-1 px-5 py-4">Tukar
                                                    Poin</a>
                                                <input type="number" name="jumlah_poin_edit" id="jumlah_poin_edit"
                                                    value="" hidden>
                                                {{-- <a href="#"
                                                    class="btn btn-success mb-1 px-5 py-4">&nbsp;Cetak&nbsp;</a> --}}
                                            </center>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="for-flex">
                                                    <form id="add_table_kasir_edit" method="post">
                                                        @csrf
                                                        <center>
                                                            <p>ID Barang</p>
                                                            <input type="number" id="id_barang_edit"
                                                                name="id_barang_edit" readonly>
                                                            <input type="number" id="edit_id_product" value=""
                                                                hidden>
                                                        </center>
                                                        <center>
                                                            <p>Stok</p>
                                                            <input type="number" id="stok_edit" name="stok_edit"
                                                                readonly>
                                                        </center>
                                                        <center>
                                                            <p>Jumlah Barang</p>
                                                            <input type="number" id="jumlah_barang_edit"
                                                                name="jumlah_barang_edit">
                                                        </center>
                                                        <center>
                                                            <p>Harga Jual</p>
                                                            <input type="number" id="harga_jual_edit"
                                                                name="harga_jual_edit" readonly>
                                                        </center>
                                                        <center>
                                                            <p>Harga Akhir</p>
                                                            <input type="number" id="harga_akhir_edit"
                                                                name="harga_akhir_edit" readonly>
                                                        </center>
                                                        <center>
                                                            {{-- <p class="mt-3">Tambah produk</p> --}}
                                                            <a type="submit" class="btn btn-primary mt-3"
                                                                id="btn_tambah" onclick="tambahBarisEdit()">Tambah</a>
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
                                                    <table class="table table-striped" id="table_kasir_edit">
                                                        <thead>
                                                            <tr>
                                                                <th>Action</th>
                                                                <th>ID Barang</th>
                                                                <th>Kategori</th>
                                                                <th>Nama Barang</th>
                                                                <th>Jumlah Barang</th>
                                                                <th>Harga Jual</th>
                                                                <th>Harga Akhir</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($penjualan_detail->where('id_penjualan', $item->id) as $row)
                                                                <tr>
                                                                    <td class="text-bold-500">
                                                                        <a href="#" class="btn btn-outline-warning"
                                                                            name="edit_row" onclick="editRowEdit(this)"
                                                                            data-id="{!! $loop->iteration !!}"
                                                                            data-value="{{ $row->id_product }}">
                                                                            <i class="bi bi-pencil-fill"></i>
                                                                        </a>
                                                                        <a href="#" class="btn btn-outline-danger"
                                                                            name="delete_row"
                                                                            onclick="deleteRowEdit(this)">
                                                                            <i class="bi bi-trash-fill"></i>
                                                                        </a>
                                                                    </td>
                                                                    <td class="text-bold-500">
                                                                        {{ $row->id_product }}
                                                                    </td>
                                                                    <td class="text-bold-500">
                                                                        {{ $row->product[0]->kategori }}
                                                                    </td>
                                                                    <td class="text-bold-500">
                                                                        {{ $row->product[0]->nama }}
                                                                    </td>
                                                                    <td class="text-bold-500">
                                                                        {{ $row->jumlah_barang }}
                                                                    </td>
                                                                    <td class="text-bold-500">
                                                                        {{ $row->harga_jual }}
                                                                    </td>
                                                                    <td class="text-bold-500">
                                                                        {{ $row->harga_akhir }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="#" class="btn btn-primary my-5" id="hitung_sub_total_edit">Hitung</a>
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
                                                                    name="sub_total_edit" id="sub_total_edit" readonly>
                                                            </fieldset>
                                                            <fieldset class="form-group">
                                                                <label for="basicInput">Diskon</label>
                                                                <div class="row">
                                                                    <div class="col-5">
                                                                        <input type="number"
                                                                            class="form-control mb-3 mt-2"
                                                                            name="diskon_edit" id="diskon_edit" readonly>
                                                                    </div>
                                                                    <div class="col-1">
                                                                        <p class="text-center">%=</p>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <input type="number"
                                                                            class="form-control mb-3 mt-2"
                                                                            name="hasil_diskon_edit"
                                                                            id="hasil_diskon_edit" readonly>
                                                                    </div>

                                                            </fieldset>
                                                            <fieldset class="form-group">
                                                                <label for="basicInput">Nominal Bayar</label>
                                                                <input type="number" class="form-control mb-3 mt-2"
                                                                    name="nominal_bayar_edit" id="nominal_bayar_edit"
                                                                    readonly>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12" id="isTunai_edit" hidden>
                                        <div class="card row-color">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <fieldset class="form-group">
                                                                <label for="basicInput">Uang Bayar</label>
                                                                <input type="number" class="form-control mb-3 mt-2"
                                                                    name="uang_bayar_edit" id="uang_bayar_edit" required
                                                                    readonly>
                                                            </fieldset>
                                                            <fieldset class="form-group">
                                                                <label for="basicInput">Kembalian</label>
                                                                <input type="number" class="form-control mb-3 mt-2"
                                                                    name="kembalian_edit" id="kembalian_edit" readonly>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-around align-items-center">
                                        <p>Tambahan Poin Sebesar: <input type="number" id="tambahan_poin_edit"
                                                name="tambahan_poin_edit" readonly></p>
                                        <p>Metode Pembayaran:
                                            <select name="metode_pembayaran_edit" id="metode_pembayaran_edit">
                                                <option selected hidden>Pilih Metode Pembayaran</option>
                                                <option value="tunai">Tunai</option>
                                                <option value="kredit" id="option_kredit_edit">Kredit</option>
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
                                <button type="submit" class="btn btn-primary ml-1" id="btn_save_edit" hidden>
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Simpan</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    {{-- MODAL DELETE --}}
    @foreach ($data as $item)
        <div class="modal fade" id="modalDeleteAdmin{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-center">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Delete Penjualan {{ $item->id }}?
                        </h5>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Batal</span>
                        </button>
                        <form action="{{ route('delete_table_kasir') }}" method="post">
                            @csrf
                            <input type="number" name="id_penjualan" value="{{ $item->id }}" hidden>
                            <button type="submit" class="btn btn-danger ml-1">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Hapus</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


@endsection

@push('scripts')
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @include('scripts.kasir')
    @include('scripts.edit')
@endpush
