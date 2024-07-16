@extends('Hotel.layout.hotelMaster')


@section('content')


<div class="container">

    <div class="row">

        @foreach ($rooms as $room)
        <div class="col-md-3">

        <div class="card">

            @forelse($room->rooms as $img)
    <img class="card-img roomimg" style="height:150px;max-height: 150px" src="{{ url('storage/rooms/'.$img->img) }}" alt="{{ $room->room_id }}">


    @empty

    <img class="card-img roomimg" style="max-height: 150px" src="https://t3.ftcdn.net/jpg/02/48/42/64/360_F_248426448_NVKLywWqArG2ADUxDq6QprtIzsF82dMF.jpg" alt="{{ $room->room_id }}">
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

            <p class="card-text"><label for="">{{ __('hotel.cost') }}:</label>$ {{ $room->cost}}</p>

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

<div class="paginatelink">
    {{ $rooms->links() }}
</div>
<style>
    .card a{
        text-decoration: none;
        color: initial;
    }


    .paginatelink nav{
        margin-left: 300px;
        padding: 10px;
    }

    .paginatelink nav a{
        width: 100px;
    margin-left: 100px;
    text-decoration: none;
    padding: 5px;

    }


    .paginatelink .hidden{
        display: none;
    }

</style>
@endsection
