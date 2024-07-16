@extends('User.layout.UserMaster')

@section('content')

<h3 class="text-center title">{{ __('user.weprov') }}</h3>
<div class="container">
    <div class="row">

    <form action='{{route('user.search')}}' method="GET" class="location-search-form">

            <input type="text" name="country" placeholder="{{ __('user.counttovisit') }}" style="width: 300px;
            height:30px;
            border: 2px solid white;
            border-radius: 5px;">


            <input type="date" name="checkin" placeholder="Check In" class="CheckIn-box">


            <input type="date" name="checkout" placeholder="Check Out" class="Checkout-box">

            {{--  <input type="number" name="guests" placeholder="2 Guest" class="Guest-box">  --}}


            <input type="submit" class="btn  btn-primary" name="submit" value="{{ __('user.sear') }}" class="search-box">


        </form>

</div>
@include('Admin.Layout.successmesage')


@include('Admin.Layout.errormesage')
    <div class="row">

@if ($search)
@foreach ($search as $ser)
@if ($ser->translation->locale == 'ar' )
<style>
    html{
        direction: rtl;
    }
</style>
@endif

<div class="col-md-3 hotel">

<a href="{{ route('prehotel',$ser->id) }}">    <div class="card">

<img class="card-img roomimg" style="height:150px;max-height: 150px" src="{{ url('storage/hotels/'.$ser->photo) }}" alt="{{ $ser->name }}">



<div class="card-body crdbody">


<h5 class="card-title text-center">{{ $ser->name }}</h5></a>

<div class="hotel-data">

  <p class="card-text"><label for="">{{ __('hotel.cityname') }}:</label> {{ $ser->city->name}}</p>

  <p class="card-text"><label for="">{{ __('hotel.country') }}:</label> {{ $ser->city->country->name}}</p>


 <label for="" style="display: contents;">{{ __('hotel.availablethatday') }}:</label>{{ $ser->rooms_count }}




    <p class="card-text">

  @if ($ser->attachments)
<label for="">{{ __('admin.hotattach') }}:</label>
    @foreach (json_decode($ser->attachments->attachemnts) as $attachment)
   {{ LaravelLocalization::getCurrentLocale() == 'en' ? $attach=\App\Models\Attachment::where('name_en',$attachment)->first()->name_en .',': $attach=\App\Models\Attachment::where('name_en',$attachment)->first()->name_ar .','}}
@endforeach
</p>

@endif
  </p>




{{--  <div class="row">
    <div class="col-md-12 text-center hotelbtn">

        {{  $displayrate= \app\Models\Rating::select('rating')->where('hotel_id',$hotel->id)->get()->sum('rating')   }}



         <div class="ratings-wrapper">
            <div class="homeratings">
              <span data-rating="5" >&#9733;</span>
              @if( $displayrate >= 5)
                <style>
                    span[data-rating="5"],span[data-rating="5"] ~ span{
                        color:orange;

                </style>
              @endif
              <span data-rating="4">&#9733;</span>
              @if($displayrate == 4)
              <style>
                  span[data-rating="4"],span[data-rating="4"] ~ span{
                      color:orange;
                  }
              </style>
            @endif

              <span data-rating="3">&#9733;</span>
              @if($displayrate == 3)
              <style>
                  span[data-rating="3"],span[data-rating="3"] ~ span{
                      color:orange;
                  }
              </style>
            @endif

              <span data-rating="2" >&#9733;</span>

              @if($displayrate == 2)
              <style>
                  span[data-rating="2"],span[data-rating="2"] ~ span{
                      color:orange;
                  }
              </style>
            @endif
              <span data-rating="1">&#9733;</span>
              @if($displayrate == 1)
              <style>
                  span[data-rating="1"],span[data-rating="1"] ~ span{
                      color:orange;
                  }
              </style>
            @endif

            </div>
          </div>



    </div>
</div>  --}}


<div class="card-footer">
<a href="{{ route('addtofav',$ser->id) }}" class="btn btn-default addtofav">
<i class="fa fa-heart"></i> {{ __('user.addtofav') }}
</a>

</div>

</div>
</div>
</div>



</div>


@endforeach
@else

        @foreach ($Hotels as $hotel)

        @if ($hotel->translation->locale == 'ar' )
        <style>
            html{
                direction: rtl;
            }
        </style>
        @endif

        <div class="col-md-3 hotel">

    <a href="{{ route('prehotel',$hotel->id) }}">    <div class="card">

    <img class="card-img roomimg" style="height:150px;max-height: 150px" src="{{  url('storage/hotels/'.$hotel->photo) }}" alt="{{ $hotel->name }}">



    <div class="card-body crdbody">


        <h5 class="card-title text-center">{{ $hotel->name }}</h5></a>

        <div class="hotel-data">

          <p class="card-text"><label for="">{{ __('hotel.cityname') }}:</label> {{ $hotel->city->name}}</p>

          <p class="card-text"><label for="">{{ __('hotel.country') }}:</label> {{ $hotel->city->country->name}}</p>

<label for="" style="display: contents;"> {{ __('hotel.availablenow') }}:</label> {{ $hotel->rooms_count }}





            <p class="card-text">

          @if ($hotel->attachments)
       <label for="">{{ __('admin.hotattach') }}:</label>
            @foreach (json_decode($hotel->attachments->attachemnts) as $attachment)
           {{ LaravelLocalization::getCurrentLocale() == 'en' ? $attach=\App\Models\Attachment::where('name_en',$attachment)->first()->name_en .',': $attach=\App\Models\Attachment::where('name_en',$attachment)->first()->name_ar .','}}
        @endforeach
    </p>

        @endif
          </p>

          <p class="card-text">
       <label for="">{{ __('admin.rating') }}:</label>
            @if ($hotel->ratingrelation->where('hotel_id',$hotel->id)->sum('rating') / 5  == 0)
            {{ __('admin.ratingeqzero') }}
            @else
            {{ $hotel->ratingrelation->where('hotel_id',$hotel->id)->sum('rating') / 5 }} / 5

            @endif
        </p>




<div class="card-footer">
<a href="{{ route('addtofav',$hotel->id) }}" class="btn btn-default addtofav">
    <i class="fa fa-heart"></i> {{ __('user.addtofav') }}
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
