@extends('components.master')
@section('title', 'LAPORAN')
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
            <h3>Laporan</h3>
        </div>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#anggota"
                                        role="tab" aria-controls="anggota" aria-selected="true">Anggota</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#penjualan"
                                        role="tab" aria-controls="penjualan" aria-selected="false">Penjualan</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#pembelian"
                                        role="tab" aria-controls="pembelian" aria-selected="false">Pembelian</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="anggota" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <div class="col-12">
                                        <div class="card mt-4">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    @if (!empty($lap_anggota_detail[0]->user))
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Tanggal</th>
                                                                    <th>No Laporan</th>
                                                                    <th>Jumlah Credit</th>
                                                                    <th>Credit Masuk</th>
                                                                    <th>Credit Keluar</th>
                                                                    <th>Opsi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($lap_anggota as $item)
                                                                    <tr>
                                                                        <td class="text-bold-500">
                                                                            {{ $loop->iteration }}
                                                                        </td>
                                                                        <td class="text-bold-500">
                                                                            {{ $item->tanggal }}
                                                                        </td>
                                                                        <td class="text-bold-500">
                                                                            {{ $item->id }}
                                                                        </td>
                                                                        <td class="text-bold-500">
                                                                            {{ $lap_anggota_detail[0]->user[0]->credit }}
                                                                        </td>
                                                                        <td class="text-bold-500">
                                                                            {{ $lap_anggota_detail->where('id_lap_anggota', $item->id)->sum('credit_masuk') }}
                                                                        </td>
                                                                        <td class="text-bold-500">
                                                                            {{ $lap_anggota_detail->where('id_lap_anggota', $item->id)->sum('credit_keluar') }}
                                                                        </td>
                                                                        <td>
                                                                            <a class="tagA btn btn-success"
                                                                                href="{{ route('laporan.anggota.print', $item->id) }}"
                                                                                target="_blank">Cetak
                                                                            </a>
                                                                            <a class="tagA btn btn-primary"
                                                                                href="javascript:void"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#ModalAnggota{{ $item->id }}"><i
                                                                                    class="bi bi-exclamation-triangle-fill"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    @else
                                                        <div class="d-flex justify-content-center">
                                                            <p>Tidak ada data</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="penjualan" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="col-12">
                                        <div class="card mt-4">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Tanggal</th>
                                                                <th>No Laporan</th>
                                                                <th>Barang Terjual</th>
                                                                <th>Pemasukan</th>
                                                                <th>Opsi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($lap_penjualan as $item)
                                                                @php
                                                                    // dd($lap_penjualan);
                                                                @endphp
                                                                <tr>
                                                                    <td class="text-bold-500">
                                                                        {{ $loop->iteration }}
                                                                    </td>
                                                                    <td class="text-bold-500">
                                                                        {{ $item->tanggal }}
                                                                    </td>
                                                                    <td class="text-bold-500">
                                                                        {{ $item->id }}
                                                                    </td>
                                                                    <td class="text-bold-500">
                                                                        {{ $penjualan_detail->where('id_penjualan', $item->id_penjualan)->sum('jumlah_barang') }}
                                                                    </td>
                                                                    <td class="text-bold-500">
                                                                        {{ $penjualan_detail->where('id_penjualan', $item->id_penjualan)->sum('harga_akhir') }}
                                                                    </td>
                                                                    <td>
                                                                        <a class="tagA btn btn-success" target="_blank"
                                                                            href="{{ route('laporan.penjualan.print', $item->id_penjualan) }}">Cetak
                                                                        </a>
                                                                        <a class="tagA btn btn-primary" href="#"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#ModalPenjualan{{ $item->id_penjualan }}"><i
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
                                <div class="tab-pane fade" id="pembelian" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="col-12">
                                        <div class="card mt-4">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Tanggal</th>
                                                                <th>No Laporan</th>
                                                                <th>Barang Dibeli</th>
                                                                <th>Pengeluaran</th>
                                                                <th>Keterangan</th>
                                                                <th>Opsi</th>
                                                                <th>Cetak</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($lap_pembelian as $item)
                                                                <tr>
                                                                    <td class="text-bold-500">
                                                                        {{ $loop->iteration }}1
                                                                    </td>

                                                                    <td class="text-bold-500">
                                                                        {{ $item->tanggal }}
                                                                    </td>
                                                                    <td class="text-bold-500">
                                                                        {{ $item->id }}
                                                                    </td>
                                                                    <td class="text-bold-500">
                                                                        {{ $item->barang_dibeli }}
                                                                    </td>
                                                                    <td class="text-bold-500">
                                                                        {{ $item->pengeluaran }}
                                                                    </td>
                                                                    <td class="text-bold-500">
                                                                        {{ $item->keterangan }}
                                                                    </td>
                                                                    <td>
                                                                        <a class="tagA btn btn-primary" href="#"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#ModalPembelian{{ $item->id }}"><i
                                                                                class="bi bi-exclamation-triangle-fill"></i>
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{ route('laporan.pembelian.print', $item->id) }}"
                                                                            target="_blank"
                                                                            class="btn btn-success">Cetak</a>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>

    {{-- MODAL ANGGOTA --}}
    @if (!empty($lap_anggota_detail[0]->user[0]))
        @foreach ($lap_anggota as $item)
            <div class="modal fade" id="ModalAnggota{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header d-flex justify-content-center">
                            <h5 class="modal-title" id="exampleModalScrollableTitle">laporan Anggota
                                {{ $lap_anggota_detail[0]->user[0]->nama }}</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="card row-color">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <fieldset class="form-group">
                                                            <label for="basicInput">No Laporan</label>
                                                            <input type="number" class="form-control mb-3 mt-2"
                                                                name="no_laporan" value="{{ $item->id }}" readonly>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label for="basicInput">Tanggal</label>
                                                            <input type="date" class="form-control mb-3 mt-2"
                                                                name="tanggal" value="{{ $item->tanggal }}" readonly>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label for="basicInput">Anggota Baru</label>
                                                            <input type="text" class="form-control mb-3 mt-2"
                                                                name="anggota_baru"
                                                                value="{{ $user->where('tanggal', $item->tanggal)->count('tanggal') }}"
                                                                readonly>
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
                                                            <label for="basicInput">Jumlah</label>
                                                            <input type="number" class="form-control mb-3 mt-2"
                                                                name="jumlah"
                                                                value="{{ $lap_anggota_detail->where('id_lap_anggota', $item->id)->count('id') }}"
                                                                readonly>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label for="basicInput">Anggota Bayar</label>
                                                            <input type="text" class="form-control mb-3 mt-2"
                                                                name="anggota_bayar" style="color: red"
                                                                value="{{ $lap_anggota_detail->where('id_lap_anggota', $item->id)->sum('total_bayar') }}"
                                                                readonly>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label for="basicInput">Total Pendapatan</label>
                                                            <input type="text" class="form-control mb-3 mt-2"
                                                                name="total_pendapatan"
                                                                value="{{ $lap_anggota_detail->where('id_lap_anggota', $item->id)->sum('total_bayar') }}"
                                                                readonly>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <p>Credit</p>
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>ID Anggota</th>
                                                            <th>Nama</th>
                                                            <th>Poin</th>
                                                            <th>Kredit</th>
                                                            <th>Waktu</th>
                                                            <th>Keterangan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($lap_anggota_detail->where('id_lap_anggota', $item->id) as $row)
                                                            <tr>
                                                                <td class="text-bold-500">
                                                                    {{ $loop->iteration }}
                                                                </td>
                                                                <td class="text-bold-500">
                                                                    {{ $row->user[0]->id }}
                                                                </td>
                                                                <td class="text-bold-500">
                                                                    {{ $row->user[0]->name }}
                                                                </td>
                                                                <td class="text-bold-500">
                                                                    {{ $row->user[0]->poin }}
                                                                </td>
                                                                <td class="text-bold-500">
                                                                    {{ $row->user[0]->credit }}
                                                                </td>
                                                                <td class="text-bold-500">
                                                                    {{ $row->tanggal }}
                                                                </td>
                                                                <td class="text-bold-500">
                                                                    @php
                                                                        if ($row->credit_keluar != 0) {
                                                                            echo 'keluar';
                                                                        } elseif ($row->credit_masuk != 0) {
                                                                            echo 'masuk';
                                                                        } else {
                                                                            echo '-';
                                                                        }
                                                                    @endphp
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <p>Poin</p>
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>ID Anggota</th>
                                                            <th>Nama</th>
                                                            <th>Poin</th>
                                                            <th>tambahan</th>
                                                            <th>Waktu</th>
                                                            <th>Keterangan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($lap_anggota_detail->where('id_lap_anggota', $item->id) as $row)
                                                            <tr>
                                                                <td class="text-bold-500">
                                                                    {{ $loop->iteration }}
                                                                </td>
                                                                <td class="text-bold-500">
                                                                    {{ $row->user[0]->id }}
                                                                </td>
                                                                <td class="text-bold-500">
                                                                    {{ $row->user[0]->name }}
                                                                </td>
                                                                <td class="text-bold-500">
                                                                    {{ $row->poin }}
                                                                </td>
                                                                <td class="text-bold-500">
                                                                    {{ empty($row->poin_masuk) ? 0 : $row->poin_masuk }}
                                                                </td>
                                                                <td class="text-bold-500">
                                                                    {{ $row->tanggal }}
                                                                </td>
                                                                <td class="text-bold-500">
                                                                    @php
                                                                        if ($row->poin_masuk != 0) {
                                                                            echo 'keluar';
                                                                        } elseif ($row->poin_keluar != 0) {
                                                                            echo 'masuk';
                                                                        } else {
                                                                            echo '-';
                                                                        }
                                                                    @endphp
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
            </div>
        @endforeach
    @endif

    {{-- MODAL PENJUALAN --}}
    @foreach ($lap_penjualan as $item)
        <div class="modal fade" id="ModalPenjualan{{ $item->id_penjualan }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-center">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">laporan Penjualan</h5>
                    </div>
                    <form action="" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="card row-color">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <fieldset class="form-group">
                                                            <label for="basicInput">No Laporan</label>
                                                            <input type="number" class="form-control mb-3 mt-2"
                                                                name="no_laporan" value="{{ $item->id }}" readonly>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label for="basicInput">No Transaksi</label>
                                                            <input type="number" class="form-control mb-3 mt-2"
                                                                name="no_transaksi" value="{{ $item->id_penjualan }}"
                                                                readonly>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label for="basicInput">Tanggal</label>
                                                            <input type="date" class="form-control mb-3 mt-2"
                                                                name="tanggal" value="{{ $item->tanggal }}" readonly>
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
                                                            <label for="basicInput">Sub Total</label>
                                                            <input type="number" class="form-control mb-3 mt-2"
                                                                name="sub_total" value="{{ $item->subtotal }}" required>
                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label for="basicInput">Diskon</label>
                                                            <div class="row">
                                                                <div class="col-5">
                                                                    <input type="number" class="form-control mb-3 mt-2"
                                                                        name="diskon"
                                                                        value="{{ $item->diskon != null ? 10 : '' }}">
                                                                </div>
                                                                <div class="col-1">
                                                                    <p class="text-center">%=</p>
                                                                </div>
                                                                <div class="col-6">
                                                                    <input type="number" class="form-control mb-3 mt-2"
                                                                        name="hasil_diskon" value="{{ $item->diskon }}">
                                                                </div>

                                                        </fieldset>
                                                        <fieldset class="form-group">
                                                            <label for="basicInput">Total Pendapatan</label>
                                                            <input type="number" class="form-control mb-3 mt-2"
                                                                name="total_pendapatan" value="{{ $item->total_bayar }}"
                                                                readonly>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if (empty($item->id_user))
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <p>Non Anggota</p>
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>ID Barang</th>
                                                                <th>Kategori</th>
                                                                <th>Nama Barang</th>
                                                                <th>Jumlah Barang</th>
                                                                <th>Harga Total</th>
                                                                <th>Metode</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($penjualan_detail->where('id_penjualan', $item->id_penjualan) as $row)
                                                                <tr>
                                                                    <td class="text-bold-500">
                                                                        {{ $loop->iteration }}
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
                                                                        {{ $item->harga_akhir }}
                                                                    </td>
                                                                    <td class="text-bold-500">
                                                                        {{ $item->metode_pembayaran }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <p>Anggota</p>
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>ID Barang</th>
                                                                <th>Kategori</th>
                                                                <th>Nama Barang</th>
                                                                <th>Jumlah Barang</th>
                                                                <th>Harga Total</th>
                                                                <th>Metode</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($penjualan_detail->where('id_penjualan', $item->id_penjualan) as $row)
                                                                @php
                                                                    // dd($penjualan_detail->where('id_penjualan', 5));
                                                                @endphp
                                                                <tr>
                                                                    <td class="text-bold-500">
                                                                        {{ $loop->iteration }}
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
                                                                        {{ $item->harga_akhir }}
                                                                    </td>
                                                                    <td class="text-bold-500">
                                                                        {{ $item->metode_pembayaran }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>
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
        </div>
    @endforeach

    {{-- MODAL PEMBELIAN --}}
    @foreach ($lap_pembelian as $item)
        <div class="modal fade" id="ModalPembelian{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-center">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">laporan Pembelian</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card row-color">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <fieldset class="form-group">
                                                        <label for="basicInput">No Laporan</label>
                                                        <input type="number" class="form-control mb-3 mt-2"
                                                            name="no_laporan" value="{{ $item->id }}" readonly>
                                                    </fieldset>
                                                    <fieldset class="form-group">
                                                        <label for="basicInput">No Transaksi</label>
                                                        <input type="number" class="form-control mb-3 mt-2"
                                                            name="no_transaksi" value="{{ $item->id_pembelian }}"
                                                            readonly>
                                                    </fieldset>
                                                    <fieldset class="form-group">
                                                        <label for="basicInput">Waktu</label>
                                                        <input type="date" class="form-control mb-3 mt-2"
                                                            name="waktu" value="{{ $item->tanggal }}">
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <p>Barang Dibeli</p>
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
                                                    @foreach ($pembelian_detail->where('id_pembelian', $item->id_pembelian) as $row)
                                                        <tr>
                                                            <td class="text-bold-500">
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td class="text-bold-500">
                                                                {{ $row->product[0]->nama }}
                                                            </td>
                                                            <td class="text-bold-500">
                                                                {{ $row->product[0]->kategori }}
                                                            </td>
                                                            <td class="text-bold-500">
                                                                {{ $row->harga_beli }}
                                                            </td>
                                                            <td class="text-bold-500">
                                                                {{ $row->jumlah_barang }}
                                                            </td>
                                                            <td class="text-bold-500">
                                                                {{ $row->harga_beli * $row->jumlah_barang }}
                                                            </td>
                                                            <td class="text-bold-500">
                                                                {{ $item->keterangan }}
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
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-success" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Cetak</span>
                </button>
                <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Tutup</span>
                </button>
            </div>
        </div>
    @endforeach



@endsection

@push('scripts')
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js') }}"></script>
@endpush
