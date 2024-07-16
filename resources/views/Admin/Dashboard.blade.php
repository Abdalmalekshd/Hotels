@extends('admin.layout.adminMaster')


@section('content')

{{--  <?php
setcookie("LoginCookies",Auth::user()->id,time()+3600);
if($_COOKIE['LoginCookies']){
echo  $_COOKIE["LoginCookies"];
}
else{
    echo'Empty';
}
?>  --}}
<div class="container statistics" style="max-width: 1800px">
    <div class="row">
        <div class="col-md-5 text-center countriesnum">
            <h5>
                {{ __('admin.countrynumber') }}
            </h5>
            {{ $countrynumber }}
        </div>


        <div class="col-md-5 text-center citiesnum">
            <h5>
                {{ __('admin.country_cities_number') }}
            </h5>
            {{ $citynumber }}
        </div>
    </div>

    <div class="row">

        <div class="col-md-5 text-center hotelsnum">
            <h5>
                {{ __('admin.hotnumber') }}
            </h5>
            {{ $hotelnumber }}
        </div>


        <div class="col-md-5 text-center attachsnum">
            <h5>
                {{ __('admin.attachnum') }}
            </h5>
            {{ $attachnumber }}
        </div>
    </div>


    <div class="row">

        <div class="col-md-5 text-center usersnum" style="margin-right: 320px;">
            <h5>
                {{ __('admin.usersnum') }}
            </h5>
            {{ $usersnumber }}
        </div>

    </div>

    <br>
    <hr>

    <h3 class="text-center tableheader">{{ __('admin.country') }}</h3>

    <table class="table">
        <thead>
          <tr>
            <th class="text-center">{{ __('admin.country') }}</th>
            <th class="text-center">{{ __('admin.country_cities_number') }}</th>


            <th></th>

          </tr>
        </thead>
        <tbody>
            @foreach ($Countries as $Country)


          <tr>

            <td class="text-center">
                @if( $Country->name)
                {{  $Country->name }}
                @else
                {{ __('admin.langinthisname') }}
                @endif
                </td>
            <td class="text-center">{{ $Country->cities_count }}</td>



            <td class="text-center">
                <a href="{{ route('edit.country',$Country->id) }}" class="btn btn-success">{{ __('admin.ed') }}</a>
                <a href="{{ route('delete.country',$Country->id) }}" class="btn btn-danger">{{ __('admin.de') }}</a>
            </td>

          </tr>
          @endforeach

</tbody>
</table>



<br>
    <hr>
    <h3 class="text-center tableheader">{{ __('admin.city') }}</h3>
    <table class="table">
        <thead>
          <tr>

            <th class="text-center">{{ __('admin.cityname') }}</th>
            <th class="text-center">{{ __('admin.city-country') }}</th>
            <th class="text-center">{{ __('admin.hotnumber') }}</th>

            <th></th>

          </tr>
        </thead>
        <tbody>

            @foreach ($Cities as $City)

          <tr>

            <td class="text-center">
                @if($City->name)
                {{ $City->name }}
                @else
                {{ __('admin.langinthisname') }}
                @endif
            </td>
            <td class="text-center">
                @if($City->country->name)

                {{ $City->country->name }}
                @else
                {{ __('admin.langinthisname') }}
                @endif
            </td>
            <td class="text-center">{{ $City->hotels_count }}</td>


            <td class="text-center">
                <a href="{{ route('edit.city',$City->id) }}" class="btn btn-success">{{ __('admin.ed') }}</a>
                <a href="{{ route('delete.city',$City->id) }}" class="btn btn-danger">{{ __('admin.de') }}</a>
            </td>

          </tr>
          @endforeach

</tbody>
</table>




<br>
    <hr>
    <h3 class="text-center tableheader">{{ __('admin.hot') }}</h3>
    <table class="table">
        <thead>
          <tr>
            <th class="text-center">{{ __('admin.hotname') }}</th>
            <th class="text-center">{{ __('admin.cityname') }}</th>
            <th class="text-center">{{ __('admin.hotphone') }}</th>
            <th class="text-center">{{ __('admin.email') }}</th>
            <th class="text-center">{{ __('admin.roomscount') }}</th>
            <th class="text-center">{{ __('admin.active') }}</th>




            <th></th>

          </tr>
        </thead>
        <tbody>

            @foreach ($Hotels as $Hotel)

          <tr>
            <td class="text-center">{{ $Hotel->name }}</td>
            <td class="text-center">{{ $Hotel->city->name }}</td>
            <td class="text-center">{{ $Hotel->phone }}</td>
            <td class="text-center">{{ $Hotel->email }}</td>
            <td class="text-center">{{ $Hotel->rooms_count }}</td>
            <td class="text-center">0</td>


            <td class="text-center">
                <a href="{{ route('edit.hotel',$Hotel->id) }}" class="btn btn-success">{{ __('admin.ed') }}</a>
                <a href="{{ route('delete.hotel',$Hotel->id) }}" class="btn btn-danger">{{ __('admin.de') }}</a>
            </td>

          </tr>
          @endforeach

</tbody>
</table>


<br>
    <hr>
    <h3 class="text-center tableheader">{{ __('admin.attach') }}</h3>
    <table class="table">
        <thead>
          <tr>
            <th class="text-center">{{ __('admin.attachname') }}</th>
            <th class="text-center">{{ __('admin.slug') }}</th>

            <th></th>

          </tr>
        </thead>
        <tbody>

            @foreach ($Attach as $attach)

          <tr>
            <td class="text-center">{{ $attach->name }}</td>
            <td class="text-center">{{ $attach->slug }}</td>

            <td class="text-center">
                <a href="{{ route('edit.attachment',$attach->id ) }}" class="btn btn-success">{{ __('admin.ed') }}</a>
                <a href="{{ route('delete.attachment',$attach->id ) }}" class="btn btn-danger">{{ __('admin.de') }}</a>
            </td>

          </tr>
          @endforeach

</tbody>
</table>

<br>
    <hr>
    <h3 class="text-center tableheader">{{ __('admin.users') }}</h3>
    <table class="table">
        <thead>
          <tr>

            <th class="text-center">{{ __('admin.username') }}</th>
            <th class="text-center">{{ __('admin.email') }}</th>
            <th class="text-center">{{ __('admin.phone') }}</th>
            {{--  <th class="text-center">{{ __('admin.userreservations') }}</th>  --}}


            <th></th>

          </tr>
        </thead>
        <tbody>

            @foreach ($Users as $User)

          <tr>

            <td class="text-center">
                {{ $User->name }}
            </td>
            <td class="text-center">
                {{ $User->email }}
            </td>
            <td class="text-center">{{ $User->phone }}</td>


            <td class="text-center">
                <a href="{{ route('delete.user',$User->id) }}" class="btn btn-danger">{{ __('admin.de') }}</a>
            </td>

          </tr>
          @endforeach

</tbody>
</table>




</div>

@endsection
