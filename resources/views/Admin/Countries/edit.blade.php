@extends('admin.layout.adminMaster')


@section('content')

<div class="container">
<div class="row">
    <div class="col-md-12">
        <h1 class="text-center">{{ __('admin.ed_country') }}</h1>
    </div>
</div>
    <div class="create">
        <form class="form-group" method="POST" action="{{ route('update.country') }}" enctype="multipart/form-data">
            @csrf
          <div class="row">
            <div class="col-md-12">
                <input class="form-control" type="hidden" name="id" value="{{ $country->id }}">


                <input class="form-control" type="text" name="name" value="{{ $country->name }}" placeholder="{{ __('admin.country_name') }}">

                @error('name')
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
