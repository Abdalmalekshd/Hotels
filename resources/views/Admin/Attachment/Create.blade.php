@extends('admin.layout.adminMaster')


@section('content')

<div class="container">

    <div class="col-md-12">
        <h1 class="text-center">{{ __('admin.add_attach') }}</h1>
    </div>

    <div class="create">
        <form class="form-group" method="POST" action="{{ route('create.attachments') }}">
            @csrf

<div class="row">
    <div class="col-md-6">
        <input type="text" class="form-control" name="name_en" placeholder="{{ __('admin.attachnameen') }}" id="" @if(LaravelLocalization::getCurrentLocale() == 'ar') style="direction:ltr;"
        @endif>

        @error('name_en')
                <div class="text-danger">{{ $message }}</div>
                @enderror
    </div>


    <div class="col-md-6">
        <input type="text" class="form-control" name="name_ar" placeholder="{{ __('admin.attachnamear') }}" id="" @if(LaravelLocalization::getCurrentLocale() == 'en') style="direction:rtl;"
        @endif>

        @error('name_ar')
                <div class="text-danger">{{ $message }}</div>
                @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <input type="text" class="form-control" name="slug" placeholder="{{ __('admin.slug') }}" id="">

        @error('slug')
                <div class="text-danger">{{ $message }}</div>
                @enderror
    </div>

    <div class="col-md-6">
       <select name="attachment_level" class="form-control" id="">
        <optgroup label="{{ __('admin.level') }}">
            <option value="0">{{ __('admin.hot')}}</option>
            <option value="1">{{ __('admin.rooms')}}</option>

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
