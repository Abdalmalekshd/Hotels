@extends('admin.layout.adminMaster')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('search.hotel') }}" method="GET">
            <input type="search" class="form-control" placeholder="Search..." aria-label="Search"  id='search' name="search">
        </form>
        @error('search')
            <div class="text-center text-danger">{{ $message }}</div>
        @enderror
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
    @include('Admin.Layout.successmesage')


    @include('Admin.Layout.errormesage')
</div>
</div>
    <div class="row">

        @if(!$search)
        @foreach ($hotels as $hotel)
        <div class="col-md-4">

        <div class="card">


<img class="card-img" src="{{ url('storage/hotels/'.$hotel->photo) }}" alt="{{ $hotel->name }}">

    <div class="buttons">
        <a href="{{ route('admin.edit.hotel',$hotel->id) }}" class="btn btn-primary">{{ __('admin.ed') }}</a>
        <a href="{{ route('delete.hotel',$hotel->id) }}" class="btn btn-danger">{{ __('admin.de') }}</a>
        @if ($hotel->active ==0)
        <a href="{{ route('activate.hotel',$hotel->id) }}" class="btn btn-success">{{ __('admin.app') }}</a>
        @endif

    </div>
    {{--  <a href="{{ route('get.single.hotel',$hotel->id) }}">  --}}

    <div class="card-body">

        @if($hotel->name)
          <h5 class="card-title text-center">{{ $hotel->name }}</h5>
          @else
          <h5 class="card-title text-center">{{ __('admin.langinthisname') }}</h5>
          @endif
          <div class="hotel-data">
            <p class="card-text"><label for="">{{ __('admin.email') }}:</label> {{ $hotel->email }}</p>
          <p class="card-text"><label for="">{{ __('admin.phone') }}:</label> {{ $hotel->phone }}</p>

          <p class="card-text"><label for="">{{ __('admin.location') }}:</label>{{ $hotel->city->name }}/{{ $hotel->city->country->name }}</p>


        </div>
        <p class="card-text">
        @if ($hotel->attachments)
        <label for="">{{ __('admin.hotattach') }}:</label>
            @foreach (json_decode($hotel->attachments->attachemnts) as $attachment)
           {{ LaravelLocalization::getCurrentLocale() == 'en' ? $attach=\App\Models\Attachment::where('name_en',$attachment)->first()->name_en .',': $attach=\App\Models\Attachment::where('name_en',$attachment)->first()->name_ar .','}}
        @endforeach
    </p>

        @endif



        </div>
    </a>


    </div>

</div>

@endforeach

</div>

</div>

<div class="paginatelink">
    {{ $hotels->links() }}
</div>
@else
@foreach ($search as $ser)
        <div class="col-md-4">

        <div class="card">


    <img class="card-img" src="{{ url('storage/hotels/'.$ser->photo) }}" alt="{{ $ser->name }}">
    <div class="buttons">
        <a href="{{ route('admin.edit.hotel',$ser->id) }}" class="btn btn-primary">{{ __('admin.ed') }}</a>
        <a href="{{ route('delete.hotel',$ser->id) }}" class="btn btn-danger">{{ __('admin.de') }}</a>
        @if ($ser->active ==0)
        <a href="{{ route('activate.hotel',$ser->id) }}" class="btn btn-success">{{ __('admin.app') }}</a>
        @endif

    </div>
    {{--  <a href="{{ route('get.single.hotel',$ser->id) }}">  --}}

    <div class="card-body">

        @if($ser->name)
          <h5 class="card-title text-center">{{ $ser->name }}</h5>
          @else
          <h5 class="card-title text-center">{{ __('admin.langinthisname') }}</h5>
          @endif
          <div class="hotel-data">
            <p class="card-text"><label for="">{{ __('admin.email') }}:</label> {{ $ser->email }}</p>
          <p class="card-text"><label for="">{{ __('admin.phone') }}:</label> {{ $ser->phone }}</p>

          <p class="card-text"><label for="">{{ __('admin.location') }}:</label>{{ $ser->city->name }}/{{ $ser->city->country->name }}</p>


        </div>
        <p class="card-text">
        @if ($ser->attachments)
        <label for="">{{ __('admin.hotattach') }}:</label>
            @foreach (json_decode($ser->attachments->attachemnts) as $attachment)
           {{ LaravelLocalization::getCurrentLocale() == 'en' ? $attach=\App\Models\Attachment::where('name_en',$attachment)->first()->name_en .',': $attach=\App\Models\Attachment::where('name_en',$attachment)->first()->name_ar .','}}
        @endforeach
    </p>

        @endif



        </div>
    </a>


    </div>

</div>

@endforeach

</div>

</div>

<div class="paginatelink">
    {{ $search->links() }}
</div>
@endif
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
{{--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>  --}}

{{--  <script>
    $(document).ready(function() {
        $("#search").keyup(function() {
            var filter = $(this).val(),
                count = 0;
            $(".container  .card").each(function() {
                if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                    $(this).fadeOut();
                    $(".slider").fadeOut();
                } else {
                    $(this).show();
                    $(".slider").show();
                    count++;
                }
            });

            var numberItems = count;
            $("#result-count").text("Number of Results = " + count);
        });
    });
</script>  --}}
@endsection
