@extends('User.layout.UserMaster')


@section('content')

<div class="container" style="background-color: white">
<form action="{{ route('resrive.room') }}" class="reserform"  method="GET">
    @csrf
<div class="row">

    <input type="hidden" name="room_id" value="{{ $room->id }}">
    @error('room_id')
    <div class="text-danger">{{ $message }}</div>
    @enderror
    <input type="hidden" name="hotel_id" value="{{ $room->hotel_id }}">
    @error('hotel_id')
    <div class="text-danger">{{ $message }}</div>
    @enderror

    <div class="col-md-12">
        <label for="" class="time">{{ __('hotel.starttime') }} :</label>
    <input type="date" id="text1" class="form-control" name="start_date">
    @error('start_date')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
</div>
    <div class="row">

        <div class="col-md-12">
            <label for="" class="time">{{ __('hotel.endtime') }} :</label>
    <input type="date" id="text2" class="form-control" name="end_date">
    @error('end_date')
    <div class="text-danger">{{ $message }}</div>

    @enderror
</div>
</div>
<input type="submit" class="btn btn-success form-control" value="{{ __('user.conf') }}">
  </form>


</div>


@include('Admin.Layout.successmesage')


@include('Admin.Layout.errormesage')
  @endsection
