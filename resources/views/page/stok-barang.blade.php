@extends('components.master')
@section('title', 'PENJUALAN')
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
            <h3>Stok Barang</h3>
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
                                    data-bs-target="#modalTambah">Tambah</button>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Barang</th>
                                            <th>Kategori</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah Barang</th>
                                            <th>Harga Jual</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
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
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Input Stok Barang</h5>
                </div>
                <form action="" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card row-color">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <fieldset class="form-group">
                                                        <label for="basicInput">No Transaksi *</label>
                                                        <input type="number" class="form-control mb-3 mt-2"
                                                            name="no_transaksi" required>
                                                    </fieldset>
                                                    <fieldset class="form-group">
                                                        <label for="basicInput">Nama Kasir</label>
                                                        <input type="text" class="form-control mb-3 mt-2"
                                                            name="nama_kasir" readonly>
                                                    </fieldset>
                                                    <fieldset class="form-group">
                                                        <label for="basicInput">Tanggal</label>
                                                        <input type="date" class="form-control mb-3 mt-2" name="tanggal">
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="for-flex">
                                            <center>
                                                <p class="mt-3">ID Barang</p>
                                                <input type="text" value="B001">
                                            </center>
                                            <center>
                                                <p class="mt-3">Kategori</p>
                                                <input type="text" value="Minuman">
                                            </center>
                                            <center>
                                                <p class="mt-3">Nama Barang</p>
                                                <input type="text" value="Nutrisari">
                                            </center>
                                            <center>
                                                <p class="mt-3">Harga Jual</p>
                                                <input type="number" value="5000">
                                            </center>
                                            <center>
                                                <p class="mt-3">Harga Asli</p>
                                                <input type="number" value="3000">
                                            </center>
                                            <center>
                                                <p class="mt-3">Keterangan</p>
                                                <input type="text" value="Fast Moving">
                                            </center>
                                        </div>
                                        <center>
                                            <button class="btn btn-primary mt-3">Simpan</button>
                                        </center>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>ID Barang</th>
                                                        <th>Kategori</th>
                                                        <th>Nama Barang</th>
                                                        <th>Harga Jual</th>
                                                        <th>harga Beli</th>
                                                        <th>Harga Akhir</th>
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
                                </div>
                            </div>
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
    <script>
        $(document).ready(function() {
            $('#tableLaporan').DataTable();
        }); <
        script src = "https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity = "sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin = "anonymous" >
    </script>
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js') }}"></script>
@endpush
