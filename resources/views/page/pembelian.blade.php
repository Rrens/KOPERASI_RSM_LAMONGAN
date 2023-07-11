@extends('components.master')
@section('title', 'PEMBELIAN')
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
                                            <th>Jumlah Barang</th>
                                            <th>Total Harga</th>
                                            <th>Keterangan</th>
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
                                                    {{ $item->jumlah_barang != null ? $item->jumlah_barang : '' }}
                                                </td>
                                                <td class="text-bold-500">
                                                    {{ $item->total_bayar != null ? number_format($item->total_bayar) : '' }}
                                                </td>
                                                <td class="text-bold-500">
                                                    {{ $item->keterangan != null ? $item->keterangan : '' }}
                                                </td>
                                                <td class="text-bold-500">
                                                    {{ $item->created_at != null ? $item->created_at->toDateString() : '' }}
                                                </td>
                                                <td>
                                                    <a class="tagA btn btn-outline-warning" href="#"
                                                        data-bs-toggle="modal" data-bs-target="#modalEditAdmin"
                                                        data-id="{{ $item->id }}" onclick="modal(this)">
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
                                                        data-bs-target="#modalViewAdmin{{ $item->id }}"><i
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
                                        <Option selected hidden>Pilih Kategori</Option>
                                        <option value="Bahan Sembako">Bahan Sembako</option>
                                        <option value="Kebutuhan rumah tangga">Kebutuhan rumah tangga</option>
                                        <option value="Obat-obatan">Obat-obatan</option>
                                        <option value="Alat tulis">Alat tulis</option>
                                        <option value="Perlengkapan bayi">Perlengkapan bayi</option>
                                        <option value="Produk Digital">Produk Digital</option>
                                        <option value="Lain-lain">Lain-lain</option>
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
                                <select class="form-select" aria-label="Default select example" name="keterangan"
                                    id="keterangan">
                                    <option selected hidden>Pilih Keterangan</option>
                                    <option value="Fast Moving">Fast Moving</option>
                                    <option value="Slow Moving">Slow Moving</option>
                                </select>
                                {{-- <textarea type="text" class="form-control mt-3" id="keterangan" name="keterangan"></textarea> --}}
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
                                <input type="number" class="form-control mt-3" id="total_harga" name="total_harga"
                                    readonly>
                            </div>
                            <div class="form-group mb-3">
                                <a href="#" class="btn btn-primary mt-5" id="tambah_tabel" hidden
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
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Pembelian</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="basicInput">Nama Barang</label>
                                <input type="number" id="id_pembelian" value="" hidden>
                                <input type="text" class="form-control mt-3" id="nama_barang_edit"
                                    name="nama_barang">
                            </div>
                            <div class="form-group mb-3">
                                <label for="basicInput">Kategori</label>
                                <fieldset class="form-group mt-3">
                                    <select class="form-select" id="kategori_edit" name="kategori">
                                        <button hidden>Pilih Kategori</button>
                                        <option value="Bahan Sembako">Bahan Sembako</option>
                                        <option value="Kebutuhan rumah tangga">Kebutuhan rumah tangga</option>
                                        <option value="Obat-obatan">Obat-obatan</option>
                                        <option value="Alat tulis">Alat tulis</option>
                                        <option value="Perlengkapan bayi">Perlengkapan bayi</option>
                                        <option value="Produk Digital">Produk Digital</option>
                                        <option value="Lain-lain">Lain-lain</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="form-group mb-3">
                                <label for="basicInput">Jumlah Barang</label>
                                <input type="text" class="form-control mt-3" id="jumlah_barang_edit"
                                    name="jumlah_barang">
                            </div>
                            <div class="form-group mb-3">
                                <label for="basicInput">Keterangan</label>
                                {{-- <textarea type="text" class="form-control mt-3" id="keterangan_edit" name="keterangan"></textarea> --}}
                                <select class="form-select" aria-label="Default select example" name="keterangan"
                                    id="keterangan_edit">
                                    <option value="Fast Moving">Fast Moving</option>
                                    <option value="Slow Moving">Slow Moving</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group mb-3">
                                <label for="basicInput">Harga Beli</label>
                                <input type="text" class="form-control mt-3" id="harga_beli_edit" name="harga_beli">
                            </div>
                            <div class="form-group mb-3">
                                <label for="basicInput">Harga Jual</label>
                                <input type="text" class="form-control mt-3" id="harga_jual_edit" name="harga_jual">
                            </div>
                            <div class="form-group mb-3">
                                <label for="basicInput">Total Harga</label>
                                <input type="text" class="form-control mt-3" id="total_harga_edit"
                                    name="total_harga">
                            </div>
                            <div class="form-group mb-3">
                                <a href="#" class="btn btn-primary mt-5" id="simpan_sementara_edit"
                                    onclick="tambahBarisEdit()">Tambah</a>
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive" id="table_edit">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Jumlah Barang</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($pembelian_detail->where('id_pembelian', $item->id) as $row) --}}

                                {{-- @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Batal</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1" id="btn_save_edit">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Simpan</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- @endforeach --}}

    {{-- MODAL DELETE --}}
    @foreach ($data as $item)
        <div class="modal fade" id="modalDeleteAdmin{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-center">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Pembelian</h5>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Batal</span>
                        </button>
                        <form action="{{ route('pembelian.delete') }}" method="post">
                            @csrf
                            <input type="number" name="id_pembelian" value="{{ $item->id }}" hidden>
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

    @foreach ($data as $item)
        <div class="modal fade" id="modalViewAdmin{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-center">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">View Pembelian</h5>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive" id="tableView">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Jumlah Barang</th>
                                        <th>Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pembelian_detail->where('id_pembelian', $item->id) as $row)
                                        <tr>
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
                                                {{ $row->harga_jual }}
                                            </td>
                                            <td class="text-bold-500">
                                                {{ $row->jumlah_barang }}
                                            </td>
                                            <td class="text-bold-500">
                                                {{ $row->jumlah_barang * $row->harga_beli }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-success" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Tutup</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


@endsection

@push('scripts')
    <script>
        window.addEventListener('pageshow', function(event) {
                if (event.persisted || performance.getEntriesByType("navigation")[0].type === 'back_forward') {
                    location.reload();
                }
            },
            false);
    </script>
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @include('scripts.pembelian-tambah')
    @include('scripts.pembelian-edit')
@endpush
