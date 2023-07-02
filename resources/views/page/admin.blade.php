@extends('components.master')
@section('title', 'ADMIN')
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
            <h3>Admin Control</h3>
        </div>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <p>Admin Table</p>
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalTambahAdmin">Tambah</button>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Admin</th>
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
                                        @foreach ($data as $item)
                                            @php
                                                // dd($data);
                                            @endphp
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
                                                    {{ $item->pin }}
                                                </td>
                                                <td class="text-bold-500">
                                                    {{ $item->gender }}
                                                </td>
                                                <td class="text-bold-500">
                                                    {{ $item->phone }}
                                                </td>
                                                <td class="text-bold-500">
                                                    {{ $item->address }}
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
                                                        data-bs-target="#modalDetail{{ $item->id }}"><i
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
    <div class="modal fade" id="modalTambahAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Profile</h5>
                </div>
                <form action="{{ route('admin.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="d-flex justify-content-between">
                            <div class="flex-start">
                                <div class="form-group mb-3">
                                    <label for="basicInput">NIK</label>
                                    <input type="text" class="form-control mt-3"round id="basicInput" name="nik"
                                        value="{{ old('nik') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">Nama Lengkap</label>
                                    <input type="text" class="form-control mt-3"round id="basicInput" name="nama_lengkap"
                                        value="{{ old('nama_lengkap') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">Tempat Lahir</label>
                                    <input type="text" class="form-control mt-3"round id="basicInput" name="tempat_lahir"
                                        value="{{ old('tempat_lahir') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">Tanggal Lahir</label>
                                    <input type="date" class="form-control mt-3"round id="basicInput"
                                        name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">Alamat Lengkap</label>
                                    <textarea type="text" class="form-control mt-3"round id="basicInput" name="alamat">{{ old('alamat') }}</textarea>
                                </div>
                            </div>
                            <div class="flex-end">
                                <div class="form-group mb-3">
                                    <label for="basicInput">Jenis Kelamin</label>
                                    <select class="form-select mt-3" id="basicSelect" name="jenis_kelamin">
                                        <option selected hidden>Pilih Jenis Kelamin</option>
                                        <option value="0">Laki-laki
                                        </option>
                                        <option value="1">Perempuan
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">No Telepon</label>
                                    <input type="number" class="form-control mt-3"round id="basicInput" name="telp"
                                        value="{{ old('telp') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">Status Pernikahan</label>
                                    <select class="form-select mt-3" id="basicSelect" name="status_nikah">
                                        <option selected hidden>Pilih Status Pernikahan</option>
                                        <option value="0">Menikah
                                        </option>
                                        <option value="1">Belum
                                            Menikah</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">Password</label>
                                    <input type="number" class="form-control mt-3"round id="basicInput" name="pin"
                                        value="{{ old('pin') }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">Re-type Password</label>
                                    <input type="number" class="form-control mt-3"round id="basicInput"
                                        name="rpassword">
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


    {{-- MODAL EDIT --}}
    @foreach ($data as $item)
        <div class="modal fade" id="modalEditAdmin{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-center">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Profile</h5>
                    </div>
                    <form action="{{ route('admin.update') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="d-flex justify-content-between">
                                <div class="flex-start">
                                    <div class="form-group mb-3">
                                        <input type="text" name="id_admin" value="{{ $item->id }}" hidden>
                                        <label for="basicInput">NIK</label>
                                        <input type="text" class="form-control mt-3"round id="basicInput"
                                            value="{{ $item->nik }}" name="nik">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="basicInput">Nama Lengkap</label>
                                        <input type="text" class="form-control mt-3"round id="basicInput"
                                            value="{{ $item->name }}" name="nama_lengkap">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="basicInput">Tempat Lahir</label>
                                        <input type="text" class="form-control mt-3"round id="basicInput"
                                            value="{{ $item->tempat_lahir }}" name="tempat_lahir">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="basicInput">Alamat Lengkap</label>
                                        <textarea type="text" class="form-control mt-3"round id="basicInput" name="alamat">{{ $item->address }}</textarea>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="basicInput">Tanggal Lahir</label>
                                        <input type="date" class="form-control mt-3"round id="basicInput"
                                            value="{{ $item->tanggal_lahir }}" name="tanggal_lahir">
                                    </div>
                                </div>
                                <div class="flex-end">
                                    <div class="form-group mb-3">
                                        <label for="basicInput">Jenis Kelamin</label>
                                        <select class="form-select mt-3" id="basicSelect" name="jenis_kelamin">
                                            <option selected hidden>Pilih Jenis Kelamin</option>
                                            <option value="0" {{ $item->gender == 0 ? 'selected' : '' }}>Laki-laki
                                            </option>
                                            <option value="1"{{ $item->gender == 1 ? 'selected' : '' }}>Perempuan
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="basicInput">No Telepon</label>
                                        <input type="number" class="form-control mt-3"round id="basicInput"
                                            value="{{ $item->phone }}" name="telp">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="basicInput">Status Pernikahan</label>
                                        <select class="form-select mt-3" id="basicSelect" name="status_nikah">
                                            <option selected hidden>Pilih Status Pernikahan</option>
                                            <option value="0" {{ $item->status_pernikahan == 0 ? 'selected' : '' }}>
                                                Menikah</option>
                                            <option value="1" {{ $item->status_pernikahan == 1 ? 'selected' : '' }}>
                                                Belum Menikah</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="basicInput">PIN</label>
                                        <input type="number" class="form-control mt-3"round id="basicInput"
                                            value="{{ $item->pin }}" name="pin">
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
    @endforeach


    {{-- MODAL DELETE --}}
    @foreach ($data as $item)
        <div class="modal fade" id="modalDeleteAdmin{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-center">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Hapus Admin {{ $item->name }}</h5>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Batal</span>
                        </button>
                        <form action="{{ route('admin.delete') }}" method="post">
                            @csrf
                            <input name="id_admin" value="{{ $item->id }}" hidden>
                            <button type="submit" class="btn btn-danger ml-1" data-bs-dismiss="modal">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Hapus</span>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- MODAL DETAIL --}}
    @foreach ($data as $item)
        <div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-center">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Detail Profile {{ $item->name }}</h5>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-between">
                            <div class="flex-start">
                                <div class="form-group mb-3">
                                    <label for="basicInput">NIK</label>
                                    <input type="text" class="form-control mt-3"round id="basicInput" name="nik"
                                        value="{{ $item->nik }}" readonly>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">Nama Lengkap</label>
                                    <input type="text" class="form-control mt-3"round id="basicInput"
                                        name="nama_lengkap" value="{{ $item->name }}" readonly>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">Tempat Lahir</label>
                                    <input type="text" class="form-control mt-3"round id="basicInput"
                                        name="tempat_lahir" value="{{ $item->tempat_lahir }}" readonly>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">Tanggal Lahir</label>
                                    <input type="date" class="form-control mt-3"round id="basicInput"
                                        name="tanggal_lahir" value="{{ $item->tanggal_lahir }}" readonly>
                                </div>

                            </div>
                            <div class="flex-end">
                                <div class="form-group mb-3">
                                    <label for="basicInput">Jenis Kelamin</label>
                                    <select class="form-select mt-3" id="basicSelect" name="jenis_kelamin">
                                        <option selected value="{{ $item->gender }}">
                                            {{ $item->gender == 0 ? 'Laki-laki' : 'Perempuan' }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">No Telepon</label>
                                    <input type="number" class="form-control mt-3"round id="basicInput" name="telp"
                                        value="{{ $item->phone }}" readonly>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">Status Pernikahan</label>
                                    <select class="form-select mt-3" id="basicSelect" name="status_nikah">
                                        <option selected value="{{ $item->status_pernikahan }}">
                                            {{ $item->status_pernikahan == 0 ? 'Menikah' : 'Belum Menikah' }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="basicInput">Alamat Lengkap</label>
                                    <textarea type="text" class="form-control mt-3"round id="basicInput" name="alamat" readonly>{{ $item->address }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success ml-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Tutup</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


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
    {{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script> --}}
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js') }}"></script>
    {{-- <script type="text/javascript">
        document.forms['filter_date'].submit();
    </script> --}}
@endpush
