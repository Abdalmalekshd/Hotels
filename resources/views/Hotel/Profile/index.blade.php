@extends('Hotel.layout.hotelMaster')


@section('content')


<div class="container hotelprofile">

    <input type="hidden" value="{{ $hotel->latitude }}" id="latitude" name="latitude">

    <input type="hidden" value="{{ $hotel->longitude }}" id="longitude" name="longitude">

    <div class="row">
        <div class="col-md-12">

            <div id="map" style="height: 400px;">


            </div>

        <a href="{{ route('edit.hotel') }}"  class="btn btn-danger editbtn">{{ __('hotel.ed_info') }}</a>
        <a href="{{ route('edit.hotel.pass') }}"  class="btn btn-primary editbtnpass">{{ __('hotel.ed_pass') }}</a>
            @if($hotel -> active == 0)
        <a href="{{ route('req.hotel.active') }}"  class="btn btn-primary appbtnpass">{{ __('hotel.requestapp') }}</a>
    @endif
    </div>


</div>

<div class="row text-center">
<div class="col-md-6 hotelname" >
    @if($hotel->name)
    {{ $hotel->name }}
    @else
    {{ __('admin.langinthisname') }}
    @endif
</div>
</div>


@if(LaravelLocalization::getCurrentLocale() == 'ar')
<style>
     img{
    margin-right:-100px;
}

.hotelname{
    margin-right: 300px;

}
</style>
@endif
<br>
<hr>

<div class="row">
    <label for="" class="text-center">{{ __('hotel.cntinfo') }}</label>
<div class="col-md-6 hotelemail"><label for="email">{{__('admin.email') }}:</label> {{ $hotel->email }}</div>
<div class="col-md-6">
    <label for="phone">{{__('admin.phone') }}:</label>{{ $hotel->phone }}
</div>

</div>
<br>
<hr>
<div class="row">
    <div class="col-md-12">
        <img class="card-img" src="{{ url('storage/hotels/'.$hotel->photo) }}" alt="{{ $hotel->name }}">

</div>

</div>
</div>

<hr>
<div class="row">
    <label  class="text-center" style="font-weight: bold">{{ __('admin.hotattach') }}:</label>

    <div class="col-md-12">
            @if ($hotel->attachments)
            <p class="card-text" style="margin-right: 630px;
            font-size: 17px;
            margin-top: 10px;">
                @foreach (json_decode($hotel->attachments->attachemnts) as $attachment)
               {{ LaravelLocalization::getCurrentLocale() == 'en' ? $attach=\App\Models\Attachment::where('name_en',$attachment)->first()->name_en .',': $attach=\App\Models\Attachment::where('name_en',$attachment)->first()->name_ar .','}}
            @endforeach
            </p>

            @endif
    </div>
</div>
<hr>

<div class="row">
<h3 class="text-center" style="margin-top: 10px;margin-bottom:10px;">{{ __('hotel.rooms') }}</h3>
    @foreach ($rooms as $room)
    <div class="col-md-3">

    <div class="card roomcard" style="margin: 20px">

        @forelse($room->rooms as $img)
<img class="card-img roomimg" style="margin-right: 0px" src="{{ url('storage/rooms/'.$img->img) }}" alt="{{ $room->room_id }}">


@empty

<img class="card-img roomimg" style="margin-right: 0px;" src="https://t3.ftcdn.net/jpg/02/48/42/64/360_F_248426448_NVKLywWqArG2ADUxDq6QprtIzsF82dMF.jpg" alt="{{ $room->room_id }}">
@endforelse



<div class="rooms_buttons">

    <a href="{{ route('edit.room',$room->id) }}" class="btn btn-primary">{{ __('admin.ed') }}</a>
    <a href="{{ route('delete.room',$room->id) }}" class="btn btn-danger">{{ __('admin.de') }}</a>
</div>

<div class="card-body crdbody">


      <h5 class="card-title text-center">{{ __('hotel.roomid') }}:{{ $room->room_id }}</h5>

      <div class="hotel-data">

        <p class="card-text"><label for="">{{ __('hotel.peoplenum') }}:</label> {{ $room->people_number}}</p>

        <p class="card-text"><label for="">{{ __('hotel.roomfloor') }}:</label> {{ $room->room_floor}}</p>

        <p class="card-text"><label for="">{{ __('hotel.cost') }}:</label> ${{ $room->cost}}</p>

        @if ($room->attachments)
        <p class="card-text"><label for="">{{ __('hotel.roomattach') }}:</label>
            @foreach (json_decode($room->attachments->attachemnts) as $attachment)
           {{ LaravelLocalization::getCurrentLocale() == 'en' ? $attach=\App\Models\Attachment::where('name_en',$attachment)->first()->name_en .',': $attach=\App\Models\Attachment::where('name_en',$attachment)->first()->name_ar .','}}
        @endforeach
        @endif

        </p>

    </div>

    </div>
</a>

</div>

</div>

@endforeach

</div>

<script>
    var latit = document.getElementById('latitude').value;
    var longit = document.getElementById('longitude').value;



var map = L.map('map').setView([latit, longit], 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

var previousMarker=L.marker([latit,longit]).addTo(map);


</script>

@endsection
