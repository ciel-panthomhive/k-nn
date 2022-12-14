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
                            <input type="text" name="ram_u" class="form-control" placeholder="Kapasitas RAM">

                            @if ($errors->has('ram_u'))
                                <div class="text-danger">
                                    {{ $errors->first('ram_u') }}
                                </div>
                            @endif

                        </div>

                        <div class="col">
                            <label>Kapasitas Internal</label>
                            <input type="text" name="internal_u" class="form-control"
                                placeholder="Kapasitas memori internal">

                            @if ($errors->has('internal_u'))
                                <div class="text-danger">
                                    {{ $errors->first('internal_u') }}
                                </div>
                            @endif

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label>Kamera Utama</label>
                            <input type="text" name="kam_belakang_u" class="form-control"
                                placeholder="Resolusi kamera utama">

                            @if ($errors->has('kam_belakang_u'))
                                <div class="text-danger">
                                    {{ $errors->first('kam_belakang_u') }}
                                </div>
                            @endif

                        </div>

                        <div class="col">
                            <label>Kamera Depan</label>
                            <input type="text" name="kam_depan_u" class="form-control"
                                placeholder="Resolusi kamera depan">

                            @if ($errors->has('kam_depan_u'))
                                <div class="text-danger">
                                    {{ $errors->first('kam_depan_u') }}
                                </div>
                            @endif

                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <label>Kapasitas Baterai</label>
                            <input type="text" name="baterai_u" class="form-control" placeholder="Kapasitas baterai">

                            @if ($errors->has('baterai_u'))
                                <div class="text-danger">
                                    {{ $errors->first('baterai_u') }}
                                </div>
                            @endif

                        </div>

                        <div class="col">
                            <label>Harga</label>
                            <input type="text" name="harga_u" class="form-control"
                                placeholder="Harga smartphone yang diinginkan">

                            @if ($errors->has('harga_u'))
                                <div class="text-danger">
                                    {{ $errors->first('harga_u') }}
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
