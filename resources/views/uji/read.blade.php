@extends('layouts.component.sidebar1')
{{-- @extends('admin.isi') --}}

@section('content')
    {{-- <div style="margin-left:20%; padding:1px 16px;height:1000px;"> --}}

    <br>
    <br>
    <a href="{{ route('uji.add') }}" class="btn btn-success" style="float:left; width: 150px">Tambah Data</a>
    <a href="{{ route('uji.kosong') }}" class="btn btn-danger" style="margin-left: 20px; width: 150px">Kosongkan Data</a>
    {{-- <a href="#" class="btn btn-primary" style="margin-left: 20px; width: 150px">Import Data</a> --}}

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" style="margin-left: 20px; width: 150px" data-bs-toggle="modal"
        data-bs-target="#exampleModal">Import Data</button>

    {{-- <a href="#" class="btn btn-warning" style="margin-left: 20px; width: 150px">Normalisasi Data</a> --}}
    <button type="button" class="btn btn-warning" style="margin-left: 20px; width: 150px" data-bs-toggle="modal"
        data-bs-target="#normModal">Normalisasi Data</button>

    <br>
    <br>
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>No</th>
                {{-- <th>Nama</th> --}}
                <th>RAM</th>
                <th>Internal</th>
                <th>Baterai</th>
                <th>Kamera Depan</th>
                <th>Kamera Belakang</th>
                <th>Klasifikasi</th>
                {{-- <th>Klasifikasi</th> --}}
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($uji as $t)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    {{-- <td>{{ $t->nama_u }}</td> --}}
                    <td>{{ $t->ram_u }}</td>
                    <td>{{ $t->internal_u }}</td>
                    <td>{{ $t->baterai_u }}</td>
                    <td>{{ $t->kam_depan_u }}</td>
                    <td>{{ $t->kam_belakang_u }}</td>
                    {{-- <td>{{ $t->kid_u }}</td>  --}}
                    <td>
                        @isset($t->kelas)
                            {{ $t->kelas->klas }}
                        @endisset
                    </td>
                    <td>
                        <a href="{{ route('uji.delete', ['id' => $t->id]) }}" class="btn btn-danger"><i
                                class='bx bx-trash nav_icon'></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('uji.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="file" name="file" class="form-control">
                        </div>
                        <button class="btn btn-primary" style="float: right" type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <form method="post" action="{{ route('uji.norm') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="normModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Normalisasi Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Apakah anda ingin melakukan normalisasi?</label>
                            {{-- <input class="form-control" type="file" id="formFile"> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button> --}}
                        {{-- <button type="button" class="btn btn-primary">Normalisasi</button> --}}
                        <input type="submit" class="btn btn-success" value="Normalisasi">
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
