@extends('layouts.component.sidebar1')
{{-- @extends('admin.isi') --}}

@section('content')
    {{-- <div class="container">
        <div class="card mt-5">
            @include('layouts.alert')
            <div class="card-header">
                Dashboard
            </div>
            <div class="card-body">
                @role('admin')
                {{ __('You are logged in!') }}
                @endrole

                @role('redaktur')
                @include('redaktur.dashboard-redaktur')
                @endrole

                @role('jurnalis')
                @include('jurnalis.dashboard-jurnalis')
                @endrole

            </div>
        </div>
    </div>
    </div> --}}
    @include('testing.read')
@endsection
