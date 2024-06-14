@extends('admin.layout.adminMaster')


@section('content')

<div class="container">
<div class="row">
    <div class="col-md-12">
        <h1 class="text-center">{{ __('admin.ed_city') }}</h1>
    </div>
</div>
    <div class="create">
        <form class="form-group" method="POST" action="{{ route('update.city') }}" enctype="multipart/form-data">
            @csrf
          <div class="row">
            <div class="col-md-6">
                <input class="form-control" type="hidden" name="id" value="{{ $city->id }}">


                <input class="form-control" type="text" name="name" value="{{ $city->name }}" placeholder="{{ __('admin.cityname') }}">

                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>

            <div class="col-md-6">

                <select name="country_id" id="" class="select-city form-control" >
                    <optgroup label="{{ __('admin.countries') }}">
                    @if($countries && $countries -> count() > 0)
                    @foreach ($countries as $country)
                    <option value="{{ $country->id }}" @if($country->id == $city->country_id)
                        selected
                        @endif>{{ $country->name }}
                    </option>
                    @endforeach
            @endif
                </optgroup>
                </select>
                @error('country_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
            </div>
        </div>

          <input class="btn btn-primary submit" type="submit" value="{{ __('admin.sub') }}">
        </form>


    </div>



</div>

<br>

@include('Admin.Layout.successmesage')


@include('Admin.Layout.errormesage')


@endsection
