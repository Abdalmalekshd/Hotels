@extends('Hotel.layout.hotelMaster')

@section('content')

<div class="container">

<div class="col-md-12">
    <h1 class="text-center">{{ __('hotel.ed_hotel') }}</h1>
</div>

<div class="create">

    <form class="form-group" method="POST" action="{{ route('update.hotel') }}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" class="form-control" name="id" value="{{ $hotel->id }}" placeholder="">


        <input type="hidden"  value="{{ $hotel->latitude }}" id="latitude" name="latitude">

        <input type="hidden" value="{{ $hotel->longitude }}" id="longitude"  name="longitude">


        <div class="row">
            <div class="col-md-6">
        <input type="text" class="form-control" name="name" value="{{ $hotel->name }}" placeholder="">
        @error('name')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>



    <div class="col-md-6">
        <input type="text" class="form-control" name="email" value="{{ $hotel->email }}" placeholder="">
        @error('email')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">

    <div class="col-md-6">
        <input type="text" class="form-control" name="phone" value="{{ $hotel->phone }}" placeholder="">
        @error('phone')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <select name="attach[]" id="" class="select-city form-control" multiple required >
            <optgroup label="{{ __('admin.hotattach') }}">
            @if($attachments && $attachments -> count() > 0)
            @foreach ($attachments as $attachment)

            <option value="{{ $attachment->name_en }}"
                @if($hotel->attachments)
                @foreach (json_decode($hotel->attachments->attachemnts) as $attach)
                 @if ($attach == $attachment->name_en)
                selected
                 @endif
            @endforeach
            @endif
            >{{ $attachment->Name }} </option>

            @endforeach
    @endif
        </optgroup>
        </select>
</div>
</div>



    @if($hotel->photo)
    <div class="row">
        <div class="col-md-6">
            @include('admin.Layout.uploadimage')
        </div>
        <div class="col-md-6">
            <img class="card-img" src="{{ url('storage/hotels/'.$hotel->photo) }}" alt="{{ $hotel->name }}">

        </div>

        {{--  @error('email')
        <div class="text-danger">{{ $message }}</div>
        @enderror  --}}
        </div>


@endif

<div id="map" style="height: 400px;">


</div>
 <input type="submit" value="{{ __('admin.sub') }}" class="btn btn-success">
</div>

    </form>
</div>


<br>

@include('Admin.Layout.successmesage')


@include('Admin.Layout.errormesage')
</div>


<script>
    var latit = document.getElementById('latitude').value;
    var longit = document.getElementById('longitude').value;



var map = L.map('map').setView([latit, longit], 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

var previousMarker=L.marker([latit,longit]).addTo(map);


       map.locate({setView: true, maxZoom: 16});




       map.on('click', function (e) {
           // If the previousMarker exists, remove it from the map
           if (previousMarker) {
               map.removeLayer(previousMarker);
           }

           var latLng = e.latlng;
           console.log('You clicked the map at LAT: ' + latLng.lat + ' and LONG: ' + latLng.lng);

           // Create the new marker
           previousMarker = L.marker(latLng).addTo(map);
       });


   map.on('click',function(e){
       var lat=e.latlng.lat;
       var lng=e.latlng.lng;


       document.getElementById('latitude').value = lat;
       document.getElementById('longitude').value = lng;


       console.log("You clicked the map at latitude:" + lat +
       "and longitude:" +lng);
   });



</script>

@endsection
