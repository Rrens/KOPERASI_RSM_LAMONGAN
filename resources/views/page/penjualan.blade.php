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
                                                            {{-- <th>No</th> --}}
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
                                    <p>Tambahan Poin Sebesar: <input type="number" id="tambahan_poin" readonly></p>
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
    <script>
        $('#metode_pembayaran').on('click', function(e) {
            const metode_pembayaran = e.target.value;
            let id_pelanggan = $('#id_pelanggan').val();

            if (!id_pelanggan) {
                $('#option_kredit').attr('hidden', true);
                $('#btn_save').attr('hidden', false);
            } else {
                $('#option_kredit').attr('hidden', false);
                $('#btn_save').attr('hidden', false);
            }
        })

        $('#id_pelanggan').on('change', function(e) {
            var id_pelanggan = e.target.value;
            // console.log(id_pelanggan)
            $.ajax({
                url: `/penjualan/get-id-anggota/${id_pelanggan}`,
                method: 'GET',
                success: function(data) {
                    // console.log(data);
                    $('#id_anggota').val(data.id);
                    $('#nama_anggota').val(data.name);
                    $('#poin').val(data.poin);
                    $('#credit').val(data.credit);
                },
                error: function() {
                    // alert(request.responseText);

                    $('#id_anggota').val('');
                    $('#nama_anggota').val('');
                    $('#poin').val('');
                    $('#credit').val('');
                }
            })

        });

        $('#tukar_poin').on('click', function() {
            $('#jumlah_poin').val($('#poin').val())
            // alert($('#jumlah_poin').val())
        })

        $('#hitung_sub_total').on('click', function(e) {
            e.stopPropagation();

            var harga_total = [];
            var id_anggota = $('#id_pelanggan').val();
            var poin = $('#jumlah_poin').val() * 3000;
            var metode_pembayaran = $('#metode_pembayaran').val();


            $('#table_kasir tbody tr').each(function() {
                var harga_akhir = $(this).find('td:eq(6)')[0]['innerText'];
                // console.log(id_barang, kategori, nama_barang, jumlah_barang, harga_jual, harga_akhir)
                harga_total.push({
                    harga_akhir: harga_akhir
                });
            });
            let sum = 0;

            harga_total.forEach(value => {
                // console.log(`VALUE: ${value}`)
                sum += parseInt(value['harga_akhir']);
            });






            // console.log('id_anggota: ' +
            //     id_anggota, 'POIN: ' + poin);



            // $('#nama_anggota').val(data.name);
            if (metode_pembayaran) {
                if (metode_pembayaran == 'Pilih Metode Pembayaran') {
                    $('#sub_total').val(sum - poin);
                } else if (metode_pembayaran == 'kredit') {
                    $('#sub_total').val((sum - poin) + ((sum - poin) * 0.05));
                } else {
                    $('#sub_total').val(sum - poin);
                }
            } else {
                $('#sub_total').val(sum - poin);
            }

            if (id_anggota) {
                // console.log('yaya')
                $('#diskon').val(10);
                $('#hasil_diskon').val(sum * 0.1);

                if ($('#sub_total').val() >= 100000) {
                    $('#tambahan_poin').val(1);
                }
                $('#nominal_bayar').val($('#sub_total').val() - $('#hasil_diskon').val())
            } else {
                $('#diskon').val('');
                $('#hasil_diskon').val('');
                $('#nominal_bayar').val(sum - poin)
            }


            console.log(harga_total, `sum: ${sum}`);
            // $('#uang_bayar').attr(hidden, false);
            $('#uang_bayar').attr('readonly', false);


        })


        $('#uang_bayar').on('change', function() {

            var uang_bayar = $('#uang_bayar').val();
            var nominal_bayar = $('#nominal_bayar').val();
            console.log(`UANG BAYAR: ${uang_bayar} NOMINAL BAYAR ${nominal_bayar}`)

            if (uang_bayar < nominal_bayar) {
                alert('Uang kurang ' + (nominal_bayar - uang_bayar))
                $('#kembalian').val('');
            } else {
                $('#kembalian').val(uang_bayar - nominal_bayar);
            }
        })




        // $('#jumlah_barang').on('change', function() {
        //     var data = [];
        //     var harga_total = [];

        //     $('#table_kasir tbody tr').each(function() {
        //         var id_barang = $(this).find('td:eq(1)')[0]['innerText'];
        //         var kategori = $(this).find('td:eq(2)')[0]['innerText'];
        //         var nama_barang = $(this).find('td:eq(3)')[0]['innerText'];
        //         var jumlah_barang = $(this).find('td:eq(4)')[0]['innerText'];
        //         var harga_jual = $(this).find('td:eq(5)')[0]['innerText'];
        //         var harga_akhir = $(this).find('td:eq(6)')[0]['innerText'];
        //         // console.log(id_barang, kategori, nama_barang, jumlah_barang, harga_jual, harga_akhir)
        //         data.push({
        //             id_barang: id_barang,
        //             kategori: kategori,
        //             nama_barang: nama_barang,
        //             jumlah_barang: jumlah_barang,
        //             harga_jual: harga_jual,
        //             harga_akhir: harga_akhir
        //         });
        //         harga_total.push({
        //             harga_akhir: harga_akhir
        //         });
        //     });
        //     let sum = 0;

        //     harga_total.forEach(value => {
        //         // console.log(`VALUE: ${value}`)
        //         sum += parseInt(value['harga_akhir']);
        //     });

        // })

        // var table_kasir = $('#table_kasir');
        $('#btn_save').on('click', function() {
            const data = [];

            $('#table_kasir tbody tr').each(function() {
                const id_barang = $(this).find('td:eq(1)')[0]['innerText'];
                const kategori = $(this).find('td:eq(2)')[0]['innerText'];
                const nama_barang = $(this).find('td:eq(3)')[0]['innerText'];
                const jumlah_barang = $(this).find('td:eq(4)')[0]['innerText'];
                const harga_jual = $(this).find('td:eq(5)')[0]['innerText'];
                const harga_akhir = $(this).find('td:eq(6)')[0]['innerText'];
                // console.log(id_barang, kategori, nama_barang, jumlah_barang, harga_jual, harga_akhir)
                data.push({
                    id_barang,
                    kategori,
                    nama_barang,
                    jumlah_barang,
                    harga_jual,
                    harga_akhir
                });

                const {
                    id_pelanggan,
                    tanggal,
                    id_anggota,
                    nama_anggota,
                    poin,
                    tukar_poin,
                    credit,
                    jumlah_poin,
                    sub_total,
                    diskon,
                    hasil_diskon,
                    nominal_bayar,
                    uang_bayar,
                    kembalian,
                    metode_pembayaran,
                    tambahan_poin
                } = $('#form_kasir').serializeArray().reduce((obj, item) => {
                    obj[item.name] = item.value;
                    return obj;
                }, {});

                data.push({
                    id_pelanggan,
                    tanggal,
                    id_anggota,
                    nama_anggota,
                    poin,
                    tukar_poin,
                    credit,
                    jumlah_poin,
                    sub_total,
                    diskon,
                    hasil_diskon,
                    nominal_bayar,
                    uang_bayar,
                    kembalian,
                    metode_pembayaran,
                    tambahan_poin
                });
            });

            console.log(data);

            $.ajax({
                url: '/penjualan',
                type: 'POST',
                dataType: "json",
                data: {
                    data: data,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.log(error, xhr, status);
                }
            })


        })

        function tambahBaris() {
            var stok = $('#stok').val();
            var harga_jual = $('#harga_jual').val();
            var jumlah_barang = $('#jumlah_barang').val();
            var harga_akhir = $('#harga_akhir').val();
            var id_barang = $('#id_barang').val();
            // console.log(stok, harga_akhir, harga_jual, jumlah_barang, id_barang);
            if (harga_akhir) {
                $.ajax({
                    url: `/penjualan/get-id-product/${id_barang}`,
                    method: 'GET',
                    success: function(data) {
                        // console.log(data)
                        var newRow = `
                            <tr>
                                <td class="text-bold-500">
                                    <button class="btn btn-outline-danger" name="delete_row" onclick="deleteRow(this)">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </td>
                                <td class="text-bold-500">
                                    ${id_barang}
                                </td>
                                <td class="text-bold-500">
                                    ${data.kategori}
                                </td>
                                <td class="text-bold-500">
                                    ${data.nama}
                                </td>
                                <td class="text-bold-500">
                                    ${jumlah_barang}
                                </td>
                                <td class="text-bold-500">
                                    ${data.harga}
                                </td>
                                <td class="text-bold-500">
                                    ${harga_akhir}
                                </td>
                            </tr>

                        `;
                        $('#table_kasir tbody').append(newRow);
                    }
                })
            }
        }



        function deleteRow(btn) {
            var row = btn.closest('tr');
            row.remove();
        }


        $('#id_barang').on('change', function(e) {
            var id_barang = e.target.value;
            // console.log(id_barang);


            $.ajax({
                url: `penjualan/get-id-product/${id_barang}`,
                method: 'GET',
                success: function(data) {
                    var checkDataDouble = [];
                    if ($('#table_kasir tbody tr').val() != null) {
                        $('#table_kasir tbody tr').each(function() {
                            var jumlah_barang = $(this).find('td:eq(4)')[0][
                                'innerText'
                            ];
                            var id_barang = $(this).find('td:eq(1)')[0][
                                'innerText'
                            ];
                            // console.log(id_barang, kategori, nama_barang, jumlah_barang, harga_jual, harga_akhir)
                            checkDataDouble.push({
                                jumlah_barang: jumlah_barang,
                                id_barang: id_barang
                            });
                        });
                        console.log(checkDataDouble);
                        let sum = 0;
                        let data_id_barang = []
                        checkDataDouble.forEach(value => {
                            console.log(`VALUE: ${value['jumlah_barang']}`)
                            if (parseInt(value['id_barang']) == id_barang) {
                                sum += parseInt(value['jumlah_barang']);
                            }
                            // console.log(sum, data.stok)
                            data_id_barang.push({
                                id_barang: value['id_barang'],
                                jumlah_barang: sum
                            });
                        });
                        // console.log(data_id_barang);
                        // let lastElement = [];
                        // for (let index = 0; index < data_id_barang.length; index++) {
                        //     const element = data_id_barang[index];
                        //     lastElement.push(element);

                        // }
                        // data_id_barang.each(value => {

                        // })
                        // console.log(lastElement);
                        console.log(sum)
                        var stok_awal = data.stok - sum;
                        $('#stok').val(stok_awal);
                    } else {
                        var stok_awal = data.stok;
                        $('#stok').val(stok_awal);
                    }

                    // console.log(data);
                    $('#harga_jual').val(data.harga);

                    $('#jumlah_barang').on('change', function(e) {
                        var checkDataDouble = [];
                        if ($('#table_kasir tbody tr').val() != null) {
                            $('#table_kasir tbody tr').each(function() {
                                var jumlah_barang = $(this).find('td:eq(4)')[0][
                                    'innerText'
                                ];
                                var id_barang = $(this).find('td:eq(1)')[0][
                                    'innerText'
                                ];
                                // console.log(id_barang, kategori, nama_barang, jumlah_barang, harga_jual, harga_akhir)
                                checkDataDouble.push({
                                    jumlah_barang: jumlah_barang,
                                    id_barang: id_barang
                                });
                            });
                            console.log(checkDataDouble);
                            let sum = 0;
                            let data_id_barang = []
                            checkDataDouble.forEach(value => {
                                console.log(`VALUE: ${value['jumlah_barang']}`)
                                if (parseInt(value['id_barang']) == id_barang) {
                                    sum += parseInt(value['jumlah_barang']);
                                }
                                // console.log(sum, data.stok)
                                data_id_barang.push({
                                    id_barang: value['id_barang'],
                                    jumlah_barang: sum
                                });
                            });
                            // console.log(data_id_barang);
                            // let lastElement = [];
                            // for (let index = 0; index < data_id_barang.length; index++) {
                            //     const element = data_id_barang[index];
                            //     lastElement.push(element);

                            // }
                            // data_id_barang.each(value => {

                            // })
                            // console.log(lastElement);
                            console.log(sum)
                            var stok_awal = data.stok - sum;
                            var jumlah_barang = e.target.value;
                            var stok_final = stok_awal - jumlah_barang;
                            var harga_akhir = data.harga * jumlah_barang;
                            $('#stok').val(stok_final);
                            $('#harga_akhir').val(harga_akhir);
                        } else {
                            var stok_awal = data.stok;
                            var jumlah_barang = e.target.value;
                            var stok_final = stok_awal - jumlah_barang;
                            var harga_akhir = data.harga * jumlah_barang;
                            $('#stok').val(stok_final);
                            $('#harga_akhir').val(harga_akhir);
                        }
                    })
                }
            })
        })
    </script>
@endpush
