@extends('layouts.component.sidebar1')
{{-- @extends('admin.isi') --}}

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
                    <td>{{ $t->ujiram }}</td>
                    <td>{{ $t->ujiinternal }}</td>
                    <td>{{ $t->ujibaterai }}</td>
                    <td>{{ $t->ujikam_depan }}</td>
                    <td>{{ $t->ujikam_belakang }}</td>
                    <td>{{ $t->ujiharga }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
