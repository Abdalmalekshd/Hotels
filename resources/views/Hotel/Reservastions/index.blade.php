@extends('Hotel.layout.hotelMaster')


@section('content')

<div class="container">


    <table class="table">
        <thead>
          <tr>

            <th class="text-center">{{ __('hotel.roomid') }}</th>
            <th class="text-center">{{ __('hotel.name') }}</th>
            <th class="text-center">{{ __('hotel.email') }}</th>
            <th class="text-center">{{ __('hotel.gender') }}</th>
            <th class="text-center">{{ __('hotel.usernumber') }}</th>
            <th "text-center">{{ __('hotel.cost') }}</th>

            <th "text-center">{{ __('hotel.starttime') }}</th>
            <th "text-center">{{ __('hotel.endtime') }}</th>


          </tr>
        </thead>
        <tbody>
    @foreach ($reservations as $reservation)
          <tr>

            <td class="text-center">{{ $reservation->room->room_id }}</td>

            <td class="text-center">{{ $reservation->user->name }}</td>

            <td class="text-center">{{ $reservation->user->email }}</td>

            <td class="text-center">{{ $reservation->user->getgender() }}</td>

            <td class="text-center">{{ $reservation->user->email }}</td>

            <td class="text-center">${{ $reservation->room->cost }}</td>

            <td class="text-center">{{ $reservation->reservations_start_date}}</td>

            <td class="text-center">{{ $reservation->reservations_end_date}}</td>




          </tr>

    @endforeach
</tbody>
</table>
</div>


@endsection
