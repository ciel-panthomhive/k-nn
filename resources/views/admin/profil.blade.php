@extends('layouts.component.sidebar1')
{{-- @extends('admin.isi') --}}

@section('content')
    {{-- <div style="margin-left:3%; padding:1px 16px;height:800px;"> --}}

    <form method="post" action="{{ route('profil.update', ['id' => $users->id]) }}">


        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <h2>Profil</h2>

        <div class="col">
            <label>Nama</label>
            <input type="text" name="name" class=" form-control" value="{{ $users->name }}">

            @if ($errors->has('name'))
                <div class="text-danger">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>


        <div class="col">
            <label>Email</label>
            <input type="text" name="email" class="form-control" value="{{ $users->email }}">

            @if ($errors->has('email'))
                <div class="text-danger">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>
        <br>
        <br>
        <div class="col">
            <button type="submit" style="float:right; width: 150px" class="btn btn-success">Simpan</button>
            {{-- <a href="{{ route('profil.update', ['id' => $users->id]) }}" class="btn btn-success"
                    style="float:right; width: 150px">Normalisasi Data</a> --}}
        </div>
        <br>
        <br>
    </form>



    <div class="garis"></div>

    @include('admin.change')
@endsection
