@extends('layouts.public')

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
    <div class="container">
        <div class="card mt-5">
            <div class="card-header text-center">
                Cari Smartphone
            </div>
            <div class="card-body">

                <br />
                <br />

                <form method="post" action="{{ route('cari') }}">
                    {{-- <form method="get" action="#"> --}}

                    {{ csrf_field() }}

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
                            <input type="text" name="kam_bel" class="form-control" placeholder="Resolusi kamera utama">

                            @if ($errors->has('kam_bel'))
                                <div class="text-danger">
                                    {{ $errors->first('kam_bel') }}
                                </div>
                            @endif

                        </div>

                        <div class="col">
                            <label>Kamera Depan</label>
                            <input type="text" name="kam_dep" class="form-control" placeholder="Resolusi kamera depan">

                            @if ($errors->has('kam_bel'))
                                <div class="text-danger">
                                    {{ $errors->first('kam_bel') }}
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

                            @if ($errors->has('klasifikasi'))
                                <div class="text-danger">
                                    {{ $errors->first('klasifikasi') }}
                                </div>
                            @endif

                        </div>
                    </div>

                    <br />
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Cari">
                    </div>

                </form>
            </div>
        </div>
    </div>

    <br />
    <br />
@endsection
