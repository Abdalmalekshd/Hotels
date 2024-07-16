@extends('admin.layout.adminMaster')


@section('content')

<div class="container">

    <div class="col-md-12">
        <h1 class="text-center">{{ __('admin.ed_hotel') }}</h1>
    </div>

    <div class="create">
        <form class="form-group" method="POST" action="{{ route('admin.update.hotel') }}" enctype="multipart/form-data">
            @csrf
          <div class="row">
            <div class="col-md-6">
                <input class="form-control" type="hidden" name="id" value="{{ $hotel->id }}">



                <input type="hidden"  value="{{ $hotel->latitude }}" id="latitude" name="latitude">

            <input type="hidden" value="{{ $hotel->longitude }}" id="longitude"  name="longitude">


                <input class="form-control" type="text" name="name" value="{{ $hotel->name }}" placeholder="{{ __('admin.hot_name') }}">

                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>
            <div class="col-md-6">
                <input class="form-control" type="email" name="email" value="{{ $hotel->email }}" placeholder="{{ __('admin.hot_email') }}">
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>





          </div>

          <div class="row">

            <div class="col-md-6">
                <input class="form-control" type="text" name="phone"  value="{{ $hotel->phone }}" placeholder="{{ __('admin.hot_phone') }}">
                @error('phone')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>






            <div class="col-md-6">

            <select name="city_id" id="" class="select-city form-control" >
                    <optgroup label="{{ __('admin.hot_city') }}">
                    @if($city && $city -> count() > 0)
                    @foreach ($city as $city)
                    <option value="{{ $city->id }}" @if($city->id == $hotel->city_id)
                        selected
                        @endif>{{ $city->name }}
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
                    @error('attach')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
              </div>
            <div class="col-md-6">
                @include('admin.Layout.uploadimage')
            </div>




            <div class="col-md-6"><img class="card-img" src="{{ url('storage/hotels/'.$hotel->photo) }}" alt="{{ $hotel->name }}"  style="width: 350px;height:350px;margin-top:-245px;margin-bottom: 20px;border-radius: 5px;"></div>
        </div>


        <div id="map" style="height: 400px;">


        </div>

          <input class="btn btn-primary submit" type="submit" value="{{ __('admin.sub') }}">
        </form>


    </div>



</div>
<br>

@include('Admin.Layout.successmesage')


@include('Admin.Layout.errormesage')

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
