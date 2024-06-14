@extends('Hotel.layout.hotelMaster')


@section('content')

<div class="container">

    <div class="col-md-12">
        <h1 class="text-center">{{ __('hotel.add_room') }}</h1>
    </div>

    <div class="create">
        <form class="form-group" method="POST" action="{{ route('create.new.room') }}" enctype="multipart/form-data">
            @csrf
          <div class="row">
            <div class="col-md-12">
                <input class="form-control" type="file" name="file" placeholder="">

                @error('file')
                <div class="text-danger">{{ $message }}</div>
                @enderror


            </div>
          </div>


          <input class="btn btn-primary submit" type="submit" value="{{ __('admin.sub') }}">
        </form>


    </div>


</div>


<br>

@if(Session::has('success'))
<div class="row mr-2 ml-2">
    {!!   Session::get('success') !!}
</div>
</div>
@endif


@include('Admin.Layout.errormesage')



@endsection
