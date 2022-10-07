{{-- @extends('layouts.component.sidebar1') --}}
{{-- @extends('admin.isi') --}}
@extends('layouts.public')

@section('content')
    {{-- <div style="margin-left:20%; padding:1px 16px;height:1000px;"> --}}

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
                <th>Harga</th>
                {{-- <th>Klasifikasi</th>
                <th>Action</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($uji as $t)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    {{-- <td>{{ $t->nama_u }}</td> --}}
                    <td>{{ $t->nram }}</td>
                    <td>{{ $t->ninternal }}</td>
                    <td>{{ $t->nbaterai }}</td>
                    <td>{{ $t->nkam_depan }}</td>
                    <td>{{ $t->nkam_belakang }}</td>
                    <td>{{ $t->nharga }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
