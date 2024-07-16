@extends('admin.layout.adminMaster')

@section('content')
<div class="container">


    <table class="table">
        <thead>
          <tr>
            <th class="text-center">{{ __('admin.country') }}</th>
            <th></th>

          </tr>
        </thead>
        <tbody>
    @foreach ($countries as $country)

          <tr>

            @if($country->name)
            <td class="text-center">{{ $country->name }}</td>

            @else
            <td class="text-center">{{ __('admin.langinthisname') }}</td>

            @endif
            <td class="text-center">
                <a href="{{ route('edit.country',$country->id) }}" class="btn btn-success">{{ __('admin.ed') }}</a>
                <a href="{{ route('delete.country',$country->id) }}" class="btn btn-danger">{{ __('admin.de') }}</a>
            </td>

          </tr>

    @endforeach
</tbody>
</table>
</div>
@endsection
