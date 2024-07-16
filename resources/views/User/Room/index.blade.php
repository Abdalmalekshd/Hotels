@extends('User.layout.UserMaster')

@section('content')
@if ($room->hotel->translation->locale == 'ar' )
        <style>
            html{
                direction: rtl;
            }
        </style>
        @endif

        <div class="container">


            <div class="row">
                <h3 class="text-center" style="margin-top: 10px;margin-bottom:10px;">{{ __('hotel.rooms') }}</h3>



                    <div class="col-md-12">

                    <div class="roomcard" style="margin: 20px">



                        @forelse($room->rooms as $img)
                        <img class="card-img roomimg" style="margin-right: 0px" src="{{ url('storage/rooms/'.$img->img) }}" alt="{{ $room->room_id }}">


                        @empty

                        <img class="card-img roomimg" style="margin-right: 0px;" src="https://t3.ftcdn.net/jpg/02/48/42/64/360_F_248426448_NVKLywWqArG2ADUxDq6QprtIzsF82dMF.jpg" alt="{{ $room->room_id }}">
                        @endforelse

                        <hr>


                <div class="crdbody">


                      <h5 class="title text-center">{{ __('hotel.roomid') }}:{{ $room->room_id }}</h5>

                      <hr>
                      <div class="room-data">

                        <p class="text-center"><label for="">{{ __('hotel.peoplenum') }}:</label> {{ $room->people_number}}</p>
                        <hr>

                        <p class="text-center"><label for="">{{ __('hotel.roomfloor') }}:</label> {{ $room->room_floor}}</p>
                        <hr>

                        <p class="text-center"><label for="">{{ __('hotel.cost') }}:</label> ${{ $room->cost}}</p>
                        <hr>

                        @if ($room->attachments)
                        <p class="text-center"><label for="">{{ __('hotel.roomattach') }}:</label>
                            @foreach (json_decode($room->attachments->attachemnts) as $attachment)
                           {{ LaravelLocalization::getCurrentLocale() == 'en' ? $attach=\App\Models\Attachment::where('name_en',$attachment)->first()->name_en .',': $attach=\App\Models\Attachment::where('name_en',$attachment)->first()->name_ar .','}}
                        @endforeach
                        <hr>
                        @endif


                        </p>

                        <button onclick="showForm()" class="btn btn-primary form-control" >{{ __('user.res') }}</button>
                        <div id="myForm" style="display:none;">
                          <form action="{{ route('resrive.room') }}" class="reserform"  method="GET">
                            @csrf
                        <div class="row">

                            <input type="hidden" name="room_id" value="{{ $room->id }}">
                            @error('room_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <input type="hidden" name="hotel_id" value="{{ $room->hotel_id }}">
                            @error('hotel_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <div class="col-md-12">

                            <input type="date" id="text1" class="form-control" name="start_date">
                        </div>
                    </div>
                            <div class="row">

                                <div class="col-md-12">

                            <input type="date" id="text2" class="form-control" name="end_date">
                        </div>
                    </div>
                    <input type="submit" class="btn btn-success form-control" value="{{ __('user.conf') }}">
                          </form>
                        </div>

                </div>


                        <br>


                        @include('Admin.Layout.successmesage')


                        @include('Admin.Layout.errormesage')
                    </div>

                    </div>
                </a>

                </div>

                </div>



                </div>




        </div>


@stop
