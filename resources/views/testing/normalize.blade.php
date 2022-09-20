@extends('layouts.component.sidebar1')
{{-- @extends('admin.isi') --}}

@section('content')
    {{-- <div style="margin-left:20%; padding:1px 16px;height:1000px;"> --}}
    <br>
    <br>

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
            </tr>
        </thead>
        <tbody>
            @foreach ($dt as $t)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $t->datatest->name }}</td>
                    <td>{{ $t->testram }}</td>
                    <td>{{ $t->testinternal }}</td>
                    <td>{{ $t->testbaterai }}</td>
                    <td>{{ $t->testkam_depan }}</td>
                    <td>{{ $t->testkam_belakang }}</td>
                    <td>{{ $t->testharga }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
