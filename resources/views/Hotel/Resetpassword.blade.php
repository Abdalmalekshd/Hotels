<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css1/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css1/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css1/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css1/bootstrap.min.css.map') }}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <title>Change Password</title>
</head>
<body style="background-color: #d0cbcb">


<div class="container">



    <div class="create" style="margin-top: 100px;">

        <form class="form-group" method="POST" action="{{ route('Hotel.Resetpass') }}" enctype="multipart/form-data">
            @csrf


            <input type="hidden" class="form-control" name="email" value="{{ $hotel->email }}"  placeholder="{{ __('hotel.newpass') }}">


    <div class="row">
        <div class="col-md-12">
    <input type="password" class="form-control" name="pass"  placeholder="{{ __('hotel.newpass') }}">
    @error('pass')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
</div>

<input type="submit" value="{{ __('admin.sub') }}" class="btn btn-success">


        </form>

    </div>



<br>

@include('Admin.Layout.successmesage')


@include('Admin.Layout.errormesage')



</body>
</html>
