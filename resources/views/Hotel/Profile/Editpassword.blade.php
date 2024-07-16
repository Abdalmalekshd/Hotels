@extends('Hotel.layout.hotelMaster')

@section('content')


<div class="container">

    <div class="col-md-12">
        <h1 class="text-center">{{ __('hotel.ed_pass') }}</h1>
    </div>

    <div class="create">

        <form class="form-group" method="POST" action="{{ route('update.hotel.pass') }}" enctype="multipart/form-data">
            @csrf


            <div class="row">
                <div class="col-md-12">
            <input type="password" class="form-control" name="old_pass"  placeholder="{{ __('hotel.oldpass') }}" autocomplete="off">
            @error('old_pass')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
    <input type="password" class="form-control" name="new_pass"  placeholder="{{ __('hotel.newpass') }}">
    @error('new_pass')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
</div>

<input type="submit" value="{{ __('admin.sub') }}" class="btn btn-success">


        </form>

    </div>



<br>

@include('Admin.Layout.successmesage')


@include('Admin.Layout.errormesage')

@endsection
