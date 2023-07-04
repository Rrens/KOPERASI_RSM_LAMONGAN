@extends('components.master')
@section('title', 'ANGGOTA')
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

        @media(max-width: 991px) {
            .p-5 {
                padding: 1rem !important;
                margin: 10px 10px !important;
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
            <h3>Pembayaran Kredit</h3>
        </div>
    </div>
    <div class="page-content">
        <form action="">
            @csrf
            <section class="row">
                <div class="col-lg-5 col-md-12 col-sm-12">
                    <div class="card row-color">
                        <div class="card-header header-color">
                            <h4 class="card-title text-center">Keterangan Anggota</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <fieldset class="form-group">
                                            <label for="basicInput">ID Anggota</label>
                                            <input type="number" class="form-control mb-3 mt-2" name="id_anggota"
                                                id="id_anggota" value="">
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <label for="basicInput">Nama</label>
                                            <input type="text" class="form-control mb-3 mt-2" name="nama"
                                                id="nama" value="" readonly>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6">
                                        <fieldset class="form-group">
                                            <label for="basicInput">Alamat</label>
                                            <input type="text" class="form-control mb-3 mt-2" name="alamat"
                                                id="alamat" value="" readonly>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <label for="basicInput">Credit</label>
                                            <input type="number" class="form-control mb-3 mt-2" name="credit"
                                                id="credit" value="" readonly>
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
                            <h4 class="card-title text-center">Pembayaran</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <fieldset class="form-group">
                                            <label for="basicInput">Total Credit</label>
                                            <input type="number" class="form-control mb-3 mt-2" name="total_credit"
                                                id="total_credit" readonly>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <label for="basicInput">Jumlah Bayar</label>
                                            <input type="number" class="form-control mb-3 mt-2" name="jumlah_bayar"
                                                id="jumlah_bayar" value="" readonly>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6">
                                        <fieldset class="form-group">
                                            <label for="basicInput">Sisa</label>
                                            <input type="number" class="form-control mb-3 mt-2" name="sisa"
                                                id="sisa" value="" readonly>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <label for="basicInput">Keterangan</label>
                                            <input type="text" class="form-control mb-3 mt-2" name="keterangan"
                                                id="keterangan" value="" readonly>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-12 col-sm-12">
                    <div class="row">
                        <center>
                            <button type="button" class="btn btn-primary mb-1 px-5 py-4 mb-5" id="bayar"
                                hidden>Bayar</button>
                        </center>
                    </div>
                </div>
                <div class="col-12 col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table1">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>ID Anggota</th>
                                                    <th>Nama</th>
                                                    <th>Poin</th>
                                                    <th>Kredit</th>
                                                    <th>No Telepon</th>
                                                    <th>Alamat</th>
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
                                                            {{ $item->name }}
                                                        </td>
                                                        <td class="text-bold-500">
                                                            {{ $item->poin }}
                                                        </td>
                                                        <td class="text-bold-500">
                                                            Rp. {{ number_format($item->credit) }}
                                                        </td>
                                                        <td class="text-bold-500">
                                                            {{ $item->phone }}
                                                        </td>
                                                        <td class="text-bold-500">
                                                            {{ $item->address }}
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
            </section>
        </form>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @include('scripts.kredit')
    {{-- <script type="text/javascript">
        document.forms['filter_date'].submit();
    </script> --}}
@endpush
