@extends('Hotel.layout.hotelMaster')


@section('content')




<div class="col-md-12">
    <h1 class="text-center">{{ __('hotel.edit_room') }}</h1>
</div>

<div class="create">
    <form class="form-group" method="POST" action="{{ route('update.room') }}" enctype="multipart/form-data">
        @csrf

        <input class="form-control" type="hidden" name="Room_id"  value="{{ $room->room_id }}" required>

        @error('Room_id')
        <div class="text-danger">{{ $message }}</div>
        @enderror

        <input class="form-control" type="hidden" name="id"  value="{{ $room->id }}" required>
            @error('id')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <input class="form-control" type="hidden" name="hotel_id" readonly  value="{{ $room->hotel_id }}" required>
            @error('hotel_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror

        <div class="row">

        <div class="col-md-6">
            <input class="form-control" type="number" name="cost"  value="{{ $room->cost }}" required placeholder="{{ __('hotel.cost') }}">
            @error('cost')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <input class="form-control" type="number" name="people_number" value="{{ $room->people_number }}" required placeholder="{{ __('hotel.peoplenum') }}">
            @error('people_number')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
      </div>

      <input class="form-control" type="hidden" name="room_floor" value="{{ $room->room_floor }}" required readonly placeholder="{{ __('hotel.peoplenum') }}">
      @error('room_floor')
      <div class="text-danger">{{ $message }}</div>
      @enderror


      <div class="row">

        <div class="col-md-6">
            <select name="attach[]" id="" multiple class="form-control" required>
                <optgroup label="{{ __('hotel.roomattachments') }}">
                    @foreach ($attachments as $attachment)

                    <option value="{{ $attachment->name_en }}"
                        @if($room->attachments)
                        @foreach (json_decode($room->attachments->attachemnts) as $attach)
                         @if ($attach == $attachment->name_en)
                        selected
                         @endif
                    @endforeach
                    @endif
                    >{{ $attachment->Name }} </option>

                    @endforeach
                </optgroup>
            </select>
        </div>


        <div class="col-md-6" style="margin-left:480px">
        @include('admin.Layout.uploadimage')
    </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            @forelse($room->rooms as $img)
            <img class="card-img" src="{{ url('storage/rooms/'.$img->img) }}" alt="{{ $room->room_id }}" required style="width: 400px">
            @empty
            @endforelse

        </div>
    </div>

      <input class="btn btn-primary submit" type="submit" value="{{ __('admin.sub') }}">
    </form>


</div>



</div>
<br>

@include('Admin.Layout.successmesage')


@include('Admin.Layout.errormesage')




@endsection
