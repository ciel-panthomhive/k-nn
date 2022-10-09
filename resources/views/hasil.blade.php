@extends('layouts.public')

@section('content')
    {{-- <a href="{{ route('test.add') }}" class="btn btn-success" style="float:left; width: 150px">Tambah Data</a>
    <a href="{{ route('test.kosong') }}" class="btn btn-danger" style="margin-left: 20px; width: 150px">Kosongkan Data</a>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" style="margin-left: 20px; width: 150px" data-bs-toggle="modal"
        data-bs-target="#exampleModal">Import Data</button>

    {{-- <a href="#" class="btn btn-primary" style="margin-left: 20px; width: 150px">Import Data</a> --}}
    {{-- <a href="{{ route('test.norm') }}" class="btn btn-warning" style="margin-left: 20px; width: 150px">Normalisasi Data</a> --}}

    {{-- <button type="button" class="btn btn-warning" style="margin-left: 20px; width: 150px" data-bs-toggle="modal"
        data-bs-target="#normModal">Normalisasi Data</button> --}}

    {{-- <br>
    <br> --}}
    <div class="padd1">
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th style="width:1%">No</th>
                    <th style="width:24%">Nama</th>
                    <th style="width:4%">RAM</th>
                    <th style="width:8%">Internal</th>
                    <th style="width:10%">Baterai</th>
                    <th style="width:9%">Kamera Depan</th>
                    <th style="width:9%">Kamera Belakang</th>
                    <th style="width:10%">Harga</th>
                    {{-- <th style="width:10%">Klasifikasi</th> --}}
                    {{-- <th style="width:12%">Action</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($hasil as $t)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            {{-- @isset($t->datatest) --}}
                            {{ $t->datatest->name }}
                            {{-- @endisset --}}
                        </td>
                        <td>
                            {{-- @isset($t->datatest) --}}
                            {{ $t->datatest->ram }}
                            {{-- @endisset --}}
                        </td>
                        <td>
                            {{-- @isset($t->datatest) --}}
                            {{ $t->datatest->internal }}
                            {{-- @endisset --}}
                        </td>
                        <td>
                            {{-- @isset($t->datatest) --}}
                            {{ $t->datatest->baterai }}
                            {{-- @endisset --}}
                        </td>
                        <td>
                            {{-- @isset($t->datatest) --}}
                            {{ $t->datatest->kam_depan }}
                            {{-- @endisset --}}
                        </td>
                        <td>
                            {{-- @isset($t->datatest) --}}
                            {{ $t->datatest->kam_belakang }}
                            {{-- @endisset --}}
                        </td>
                        <td>
                            {{-- @isset($t->datatest) --}}
                            {{ $t->datatest->harga }}
                            {{-- @endisset --}}
                        </td>
                        {{-- <td>
                        @isset($t->kelas)
                            {{ $t->kelas->klas }}
                        @endisset
                    </td> --}}
                        {{-- <td>
                        <a href="{{ route('test.edit', ['id' => $t->id]) }}" class="btn btn-warning btn-xs"><i
                                class='bx bx-edit nav_icon'></i></a>
                        <a href="{{ route('test.delete', ['id' => $t->id]) }}" class="btn btn-danger"><i
                                class='bx bx-trash nav_icon'></i></a>
                    </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('dashboard') }}" class="btn btn-success" style="float: right; width: 150px">Kembali</a>
        <br>
        <br>
    </div>
@endsection
