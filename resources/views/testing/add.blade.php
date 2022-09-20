@extends('layouts.component.sidebar1')
{{-- @extends('admin.isi') --}}

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2-single').select2({
                theme: 'bootstrap4',
            });
        });
    </script>
@endpush

@section('content')
    {{-- <div style="margin-left:20%; padding:1px 16px;height:1000px;"> --}}
    <div class="container">
        <div class="card mt-5">
            <div class="card-header text-center">
                Tambah Data Testing
            </div>
            <div class="card-body">

                <br />
                <br />

                <form method="post" action="{{ route('test.new') }}">

                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col">
                            <label>Nama Smartphone</label>
                            <input type="text" name="name" class="form-control" placeholder="Brand dan type smartphone">

                            @if ($errors->has('name'))
                                <div class="text-danger">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif

                        </div>
                        <div class="col">
                            <label>Harga Smartphone</label>
                            <input type="text" name="harga" class="form-control" placeholder="Harga jual smartphone">

                            @if ($errors->has('harga'))
                                <div class="text-danger">
                                    {{ $errors->first('harga') }}
                                </div>
                            @endif

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label>Kapasitas RAM</label>
                            <input type="text" name="ram" class="form-control" placeholder="Kapasitas RAM">

                            @if ($errors->has('ram'))
                                <div class="text-danger">
                                    {{ $errors->first('ram') }}
                                </div>
                            @endif

                        </div>

                        <div class="col">
                            <label>Kapasitas Internal</label>
                            <input type="text" name="internal" class="form-control"
                                placeholder="Kapasitas memori internal">

                            @if ($errors->has('internal'))
                                <div class="text-danger">
                                    {{ $errors->first('internal') }}
                                </div>
                            @endif

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label>Kamera Utama</label>
                            <input type="text" name="kam_belakang" class="form-control"
                                placeholder="Resolusi kamera utama">

                            @if ($errors->has('kam_belakang'))
                                <div class="text-danger">
                                    {{ $errors->first('kam_belakang') }}
                                </div>
                            @endif

                        </div>

                        <div class="col">
                            <label>Kamera Depan</label>
                            <input type="text" name="kam_depan" class="form-control" placeholder="Resolusi kamera depan">

                            @if ($errors->has('kam_depan'))
                                <div class="text-danger">
                                    {{ $errors->first('kam_depan') }}
                                </div>
                            @endif

                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <label>Kapasitas Baterai</label>
                            <input type="text" name="baterai" class="form-control" placeholder="Kapasitas baterai">

                            @if ($errors->has('baterai'))
                                <div class="text-danger">
                                    {{ $errors->first('baterai') }}
                                </div>
                            @endif

                        </div>

                        <div class="col">
                            <label>Kelas Smartphone</label>
                            <select class="form-control select2-single" name="kid">
                                @forelse ($kelas as $k)
                                    <option value="{{ $k->id }}">{{ $k->klas }} </option>
                                @empty
                                    <option value=""> </option>
                                @endforelse
                            </select>

                            @if ($errors->has('kid'))
                                <div class="text-danger">
                                    {{ $errors->first('kid') }}
                                </div>
                            @endif

                        </div>
                    </div>

                    <br />
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Tambah">
                        <a href="{{ route('home') }}" class="btn btn-primary" style="float: right">Kembali</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <br />
    <br />
@endsection
