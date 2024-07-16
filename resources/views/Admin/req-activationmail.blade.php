<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<h3 class="text-center">Activation Request From User <span><b>{{$email}}</b></span></h3>

 <a href="{{ route('activate.hotel',$id) }}" class="btn btn-success">Activate Now</a>

 <style>
    a {
        margin-left: 400px;
    }
 </style>
