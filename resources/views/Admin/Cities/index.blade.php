@extends('admin.layout.adminMaster')

@section('content')
<div class="container">


    <table class="table">
        <thead>
          <tr>
            <th class="text-center">{{ __('admin.cityname') }}</th>
            <th class="text-center">{{ __('admin.city-country') }}</th>

            <th></th>

          </tr>
        </thead>
        <tbody>
    @foreach ($cities as $city)

          <tr>
            <td class="text-center">{{ $city->name }}</td>
            <td class="text-center">{{ $city->country->name }}</td>

            <td class="text-center">
                <a href="{{ route('edit.city',$city->id) }}" class="btn btn-success">{{ __('admin.ed') }}</a>
                <a href="{{ route('delete.city',$city->id) }}" class="btn btn-danger">{{ __('admin.de') }}</a>
            </td>

          </tr>

    @endforeach
</tbody>
</table>
</div>
@endsection
