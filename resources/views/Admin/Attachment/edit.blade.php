@extends('admin.layout.adminMaster')


@section('content')

<div class="container">

    <div class="col-md-12">
        <h1 class="text-center">{{ __('admin.edit_attach') }}</h1>
    </div>

    <div class="create">
        <form class="form-group" method="POST" action="{{ route('update.attachment',$attach->id) }}">
            @csrf

        <input type="hidden" class="form-control" name="attach_id" value="{{ $attach->id }}"  id="">


<div class="row">
    <div class="col-md-6">

    <input type="text" class="form-control" value="{{ $attach->name_en }}" name="name_en" placeholder="{{ __('admin.attachnameen') }}" id="">

        @error('name_en')
        <div class="text-danger">{{ $message }}</div>
        @enderror
</div>


    <div class="col-md-6">
    <input type="text" class="form-control" value="{{ $attach->name_ar }}" name="name_ar" placeholder="{{ __('admin.attachnamear') }}" id="">

    @error('name_ar')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    </div>
<div class="row">
    <div class="col-md-6">
        <input type="text" class="form-control" name="slug" placeholder="{{ __('admin.slug') }}" value="{{ $attach->slug }}" id="">

        @error('slug')
                <div class="text-danger">{{ $message }}</div>
                @enderror
    </div>

    <div class="col-md-6">
        <select name="attachment_level" class="form-control" id="">
         <optgroup label="{{ __('admin.level') }}">
             <option value="0" @if($attach->attachment_level == 0) selected @endif>{{ __('admin.hot')}}</option>
             <option value="1" @if($attach->attachment_level == 1) selected @endif>{{ __('admin.rooms')}}</option>

         </optgroup>
        </select>

         @error('attachment_level')
                 <div class="text-danger">{{ $message }}</div>
                 @enderror
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
