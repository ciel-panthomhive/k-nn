@extends('layouts.component.sidebar1')
{{-- @extends('admin.isi') --}}

@section('content')
    {{-- <div style="margin-left:20%; padding:1px 16px;height:1000px;"> --}}
    <br>
    <br>

    <a href="{{ route('modal') }}" class="btn btn-primary" style="float:left; width: 150px">Kembali</a>

    <br>
    <br>

    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th style="width:1%">No</th>
                <th style="width:20%">Nama</th>
                <th style="width:4%">RAM</th>
                <th style="width:8%">Internal</th>
                <th style="width:8%">Baterai</th>
                <th style="width:8%">Kamera Depan</th>
                <th style="width:8%">Kamera Belakang</th>
                <th style="width:8%">Harga</th>
                {{-- <th style="width:10%">Klasifikasi</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($dt as $t)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $t->nname }}</td>
                    <td>{{ $t->nram }}</td>
                    <td>{{ $t->ninternal }}</td>
                    <td>{{ $t->nbaterai }}</td>
                    <td>{{ $t->nkam_depan }}</td>
                    <td>{{ $t->nkam_belakang }}</td>
                    <td>{{ $t->nharga }}</td>
                    {{-- <td>{{ $t->datatest->name }}</td> --}}
                    {{-- <td>
                        @isset($t->datatest->kelas)
                            {{ $t->datatest->kelas->klas }}
                        @endisset
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <br>
    </div>
@endsection
