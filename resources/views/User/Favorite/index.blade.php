@extends('User.layout.UserMaster')

@section('content')

<h3 class="text-center title">{{ __('user.fav') }}</h3>
<div class="container">

@include('Admin.Layout.successmesage')


@include('Admin.Layout.errormesage')

<div class="row">
    <div class="col-md-12">
        <form action="{{ route('searchinfav') }}" method="GET">
            @csrf
        <input type="search" name="searchforfav" class="form-control searchforfav" placeholder="{{ __('user.searchforhot') }}">
    </form>

    </div>
</div>

    <div class="row">
@if ($search)

@foreach ($search as $hotel)




        <div class="col-md-3 hotel">

    <a href="{{ route('prehotel',$hotel->id) }}">    <div class="card">

    <img class="card-img roomimg" style="height:150px;max-height: 150px" src="{{ url('images/hotels/'.$hotel->photo) }}" alt="{{ $hotel->name }}">



    <div class="card-body crdbody">


        <h5 class="card-title text-center">{{ $hotel->name }}</h5></a>

        <div class="hotel-data">

          <p class="card-text"><label for="">{{ __('hotel.cityname') }}:</label> {{ $hotel->city->name}}</p>

          <p class="card-text"><label for="">{{ __('hotel.country') }}:</label> {{ $hotel->city->country->name}}</p>


            //Available Rooms




            <p class="card-text">

          @if ($hotel->attachments)
       <label for="">{{ __('admin.hotattach') }}:</label>
            @foreach (json_decode($hotel->attachments->attachemnts) as $attachment)
           {{ LaravelLocalization::getCurrentLocale() == 'en' ? $attach=\App\Models\Attachment::where('name_en',$attachment)->first()->name_en .',': $attach=\App\Models\Attachment::where('name_en',$attachment)->first()->name_ar .','}}
        @endforeach
    </p>

        @endif
          </p>






<div class="card-footer">
    <a href="{{ route('removefromfav',$hotel->id) }}" class="btn btn-default addtofav">
    <i class="fa fa-heart"></i> {{ __('user.removefromfav') }}
</a>

</div>

        </div>
        </div>
    </div>





    </div>
@endforeach


@else
        @foreach ($fav as $fav)


        <style>
            html{
                direction: rtl;
            }
        </style>


        <div class="col-md-3 hotel">

    <a href="{{ route('prehotel',$fav->hotels->id) }}">    <div class="card">

    <img class="card-img roomimg" style="height:150px;max-height: 150px" src="{{  url('storage/hotels/'.$fav->hotels->photo) }}" alt="{{ $fav->hotels->name }}">



    <div class="card-body crdbody">


        <h5 class="card-title text-center">{{ $fav->hotels->name }}</h5></a>

        <div class="hotel-data">

          <p class="card-text"><label for="">{{ __('hotel.cityname') }}:</label> {{ $fav->hotels->city->name}}</p>

          <p class="card-text"><label for="">{{ __('hotel.country') }}:</label> {{ $fav->hotels->city->country->name}}</p>


            //Available Rooms




            <p class="card-text">

          @if ($fav->hotels->attachments)
       <label for="">{{ __('admin.hotattach') }}:</label>
            @foreach (json_decode($fav->hotels->attachments->attachemnts) as $attachment)
           {{ LaravelLocalization::getCurrentLocale() == 'en' ? $attach=\App\Models\Attachment::where('name_en',$attachment)->first()->name_en .',': $attach=\App\Models\Attachment::where('name_en',$attachment)->first()->name_ar .','}}
        @endforeach
    </p>

        @endif
          </p>






<div class="card-footer">
    <a href="{{ route('removefromfav',$fav->hotels->id) }}" class="btn btn-default addtofav">
    <i class="fa fa-heart"></i> {{ __('user.removefromfav') }}
</a>

</div>

        </div>
        </div>
    </div>





    </div>
@endforeach
@endif

</div>

</div>
{{--  {!! $Hotels->links() !!}  --}}

@endsection
