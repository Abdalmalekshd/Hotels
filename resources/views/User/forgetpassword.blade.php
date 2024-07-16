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

    <title>Reset Password</title>
</head>
<body>
    <div class="card login-form">
        <div class="card-body">
            <h3 class="card-title text-danger text-center">Reset password</h3>

            <div class="card-text">
                <form action="{{ route('User.forgetpassword') }}" method="POST">

                    @csrf

                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter your email address and we will send you a link to reset your password.</label>
                        <input type="email" class="form-control form-control-sm" name='email'  placeholder="Enter your email address">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block resetpass">Send password reset email</button>

                    @include('Admin.Layout.successmesage')


                    @include('Admin.Layout.errormesage')


                </form>


            </div>
        </div>
    </div>

    <style>
        html,body { height: 100%; }

body{
	display: -ms-flexbox;
	display: -webkit-box;
	display: flex;
	-ms-flex-align: center;
	-ms-flex-pack: center;
	-webkit-box-align: center;
	align-items: center;
	-webkit-box-pack: center;
	justify-content: center;
	background-color: #f5f5f5;
}

form{
	padding-top: 10px;
	font-size: 14px;
	margin-top: 30px;
}

.card-title{ font-weight:300; }

.btn{
	font-size: 14px;
	margin-top:20px;
}

.login-form{
	width:320px;
	margin:20px;
}

.sign-up{
	text-align:center;
	padding:20px 0 0;
}

span{
	font-size:14px;
}

.resetpass{
    margin-left: 40px;
}
    </style>
</body>
</html>
