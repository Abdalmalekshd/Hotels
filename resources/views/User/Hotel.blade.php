@extends('User.layout.UserMaster')

@section('content')
@if ($hotel->translation->locale == 'ar' )
        <style>
            html{
                direction: rtl;
            }
        </style>
        @endif

        <div class="container">
            <input type="hidden" value="{{ $hotel->latitude }}" id='latitude'>

            <input type="hidden" value="{{ $hotel->longitude }}" id='longitude'>

            <div class="row">
                <div class="col-md-12 text-center hotname">{{ $hotel->name }}</div>
            </div>

            <div class="row hotimgmap">
                <div class="col-md-6">
                    <img class="hotimg" src="{{  url('storage/hotels/'. $hotel->photo ) }}" alt="">
                </div>

                <div class="col-md-6">
                    <div class="map" id="map" style="height: 410px;">

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center hotname">{{ __('admin.email') }}: {{ $hotel->email }}</div>

            </div>

            <div class="row">
                <div class="col-md-12 text-center hotname">{{ __('admin.phone') }}: {{ $hotel->phone }}</div>

            </div>
            <hr>


            <p class="text-center" style="font-size: 20px;font-weight:bold">Rate This Hotel:</p>
            <div class="row">

            <form action="" id="ratehotel">
                @csrf

                <input type="hidden" id="hotel_id" name="hotel_id" value="{{ $hotel->id }}">
                <input type="hidden" id="user_id" name="user_id" value="{{ Auth()->user()->id }}">

                  </div>
                  <div class="row">
                    <div class="col-md-12 text-center">
                    <div class="user-rating">
                      <div data-productid="{{ $hotel->id }}" class="ratings">
                        <div class="rating">

                            <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                            <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
                            <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                            <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                            <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                        </div>
                      </div>
                    </div>

                    <button id="rate"
                class="btn btn-danger" style="margin-right:60px;"  >rate</button>
                <br>
                <small id="rate_error" class='btn-danger' style="margin-right: 40px;"></small>
                <div class="alert alert-success" id="success_msg" style="display:none">
                    Rating Added successfully
                </div>
            </form>
                </div>
            </div>




            <hr>


            <div class="row">
                <div class="col-md-12 text-center hotelbtn">
                  <p class="text-center" style="font-size: 20px;font-weight:bold">  {{ __('hotel.rating') }} :</p>
                     <div class="ratings-wrapper">
                        <div class="ratings">
                          <span data-rating="5" >&#9733;</span>
                          @if($rating >= 5)
                            <style>
                                span[data-rating="5"],span[data-rating="5"] ~ span{
                                    color:orange;
                                }
                            </style>
                          @endif
                          <span data-rating="4">&#9733;</span>
                          @if($rating >= 4)
                          <style>
                              span[data-rating="4"],span[data-rating="4"] ~ span{
                                  color:orange;
                              }
                          </style>
                        @endif

                          <span data-rating="3">&#9733;</span>
                          @if($rating >= 3)
                          <style>
                              span[data-rating="3"],span[data-rating="3"] ~ span{
                                  color:orange;
                              }
                          </style>
                        @endif

                          <span data-rating="2" >&#9733;</span>

                          @if($rating >= 2)
                          <style>
                              span[data-rating="2"],span[data-rating="2"] ~ span{
                                  color:orange;
                              }
                          </style>
                        @endif
                          <span data-rating="1">&#9733;</span>
                          @if($rating >= 1)
                          <style>
                              span[data-rating="1"],span[data-rating="1"] ~ span{
                                  color:orange;
                              }
                          </style>
                        @endif

                        </div>
                      </div>


                </div>
            </div>

            <hr>
<div class="row" style="font-size: 20px;">
    <label for="" class="text-center" style="font-weight: bold;">{{ __('admin.hotattach') }}:</label>
    <div class="col-md-12">
        <p class="card-text"  style="margin-right:500px;margin-top:10px">
            @if ($hotel->attachments)

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

                        <div class="rooms_buttons">

                            <a href="{{ route('complete.reser',$room->id) }}" class="btn btn-primary">{{ __('user.res') }}</a>
                            <a href="{{ route('room.showinfo',$room->id) }}" class="btn btn-success">{{ __('user.showinfo') }}</a>
                        </div>
                        @forelse($room->rooms as $img)
                        <img class="card-img roomimg" style="margin-right: 0px" src="{{ url('storage/rooms/'.$img->img) }}" alt="{{ $room->room_id }}">


                        @empty

                        <img class="card-img roomimg" style="margin-right: 0px;" src="https://t3.ftcdn.net/jpg/02/48/42/64/360_F_248426448_NVKLywWqArG2ADUxDq6QprtIzsF82dMF.jpg" alt="{{ $room->room_id }}">
                        @endforelse



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




        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>



        <script>
            var latit = document.getElementById('latitude').value;
            var longit = document.getElementById('longitude').value;




        var map = L.map('map').setView([latit, longit], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var previousMarker=L.marker([latit,longit]).addTo(map);

        $(document).on('click','#rate',function(e){
            e.preventDefault();

            $('#rate_error').text('');

            var formdata=new FormData($('#ratehotel')[0]);

        $.ajax({
            type: 'post',
            url: "{{ route('rate.hotel') }}",
            data: formdata,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {

                if (data.status == true) {

                    $('#success_msg').show();
                document.getElementById('ratehotel').reset();

                }
            },

            error: function (reject) {
                var response = $.parseJSON(reject.responseText);
                $.each(response.errors, function (key, val) {
                    $("#" + key + "_error").text(val[0]);
                });
            }
        });
    });
        </script>
@stop
