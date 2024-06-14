@extends('admin.layout.adminMaster')

@section('content')
<div class="container">


    <table class="table">
        <thead>
          <tr>
            <th class="text-center">{{ __('admin.attachnameen') }}</th>
            <th class="text-center">{{ __('admin.attachnamear') }}</th>

            <th class="text-center">{{ __('admin.slug') }}</th>

            <th class="text-center">{{ __('admin.level') }}</th>


            <th></th>

          </tr>
        </thead>
        <tbody>
    @foreach ($attachments as $attachment)

          <tr>
            <td class="text-center">{{ $attachment->name_en }}</td>
            <td class="text-center">{{ $attachment->name_ar }}</td>
            <td class="text-center">{{ $attachment->slug }}</td>
            <td class="text-center">{{ $attachment->getAttachLevel() }}</td>

            <td class="text-center">
                <a href="{{ route('edit.attachment',$attachment->id) }}" class="btn btn-success">{{ __('admin.ed') }}</a>
                <a href="{{ route('delete.attachment',$attachment->id) }}" class="btn btn-danger">{{ __('admin.de') }}</a>
            </td>

          </tr>

    @endforeach
</tbody>
</table>
</div>
@endsection
