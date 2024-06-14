@extends('admin.layout.adminMaster')


@section('content')

<div class="container">

    <div class="col-md-12">
        <h1 class="text-center">{{ __('admin.add_hotel') }}</h1>
    </div>

    <div class="create">
        <form class="form-group" method="POST" action="{{ route('create.new.hotel') }}" enctype="multipart/form-data">
            @csrf


            <input type="hidden"  value="" id="latitude" name="latitude">

            <input type="hidden" value="" id="longitude"  name="longitude">

          <div class="row">
            <div class="col-md-6">
                <input class="form-control" type="text" name="name" placeholder="{{ __('admin.hot_name') }}">

                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>
            <div class="col-md-6">
                <input class="form-control" type="email" name="email" placeholder="{{ __('admin.hot_email') }}">
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


          </div>

          <div class="row">

            <div class="col-md-6">
                <input class="form-control" type="text" name="phone" placeholder="{{ __('admin.hot_phone') }}">
                @error('phone')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-md-6">
                <input class="form-control" type="password" name="password" placeholder="{{ __('admin.hot_pass') }}" required>
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-md-6">

            <select name="city_id" id="" class="select-city form-control" >
                    <optgroup label="{{ __('admin.hot_city') }}">
                    @if($city && $city -> count() > 0)
                    @foreach ($city as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}
                    </option>
                    @endforeach
            @endif
                </optgroup>
                </select>
                @error('city_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
          </div>



          <div class="col-md-6">

            <select name="attach[]" id="" class="select-city form-control" multiple required >
                    <optgroup label="{{ __('admin.hotattach') }}">
                    @if($attachments && $attachments -> count() > 0)
                    @foreach ($attachments as $attach)
                    <option value="{{ $attach->name_en }}">{{ $attach->Name }}
                    </option>
                    @endforeach
            @endif
                </optgroup>
                </select>
                @error('city_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
          </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                @include('admin.Layout.uploadimage')
            </div>
        </div>

        <div class="row">
            <div id="map" style="height: 400px;">


            </div>

        </div>

          <input class="btn btn-primary submit" type="submit" value="{{ __('admin.sub') }}">
        </form>


    </div>



</div>
<br>

@include('Admin.Layout.successmesage')


@include('Admin.Layout.errormesage')

<script>


var map = L.map('map').setView([51.4661, 7.2491], 14);

 L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);


    var previousMarker; // Declare a global variable for the previous marker

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
