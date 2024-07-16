<head>

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('user.css') }}">
    <link rel="stylesheet" href="{{ asset('css1/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css1/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css1/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css1/bootstrap.min.css.map') }}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.12.0/css/OverlayScrollbars.min.css" rel="stylesheet"/>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script src="https://cdn.maptiler.com/maptiler-geocoding-control/v1.2.0/leaflet.umd.js"></script>
<link href="https://cdn.maptiler.com/maptiler-geocoding-control/v1.2.0/style.css" rel="stylesheet">

<title>@yield('Title', 'Hotels')</title>


</head>


<body style="background-color:  rgb(216, 214, 214);@if (LaravelLocalization::getCurrentLocale() == 'ar')

   direction: rtl;
@else
        direction: ltr;

@endif">

    @include('user/layout/header')



    @yield('content')




    @yield('script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.12.0/js/OverlayScrollbars.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/f304de03af.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    function searchProducts() {
        // Retrieve the search query
        var searchQuery = document.getElementById('searchBar').value.toUpperCase();

        // Get the product list container
        var productList = document.getElementById('productList');
        var products = productList.getElementsByClassName('product');

        // Loop through the products and hide those that don't match the search query
        for (var i = 0; i < products.length; i++) {
          var title = products[i].getElementsByClassName('Title')[0];
          if (title.innerHTML.toUpperCase().indexOf(searchQuery) > -1) {
            products[i].style.display = '';
            $('.slider').fadeOut();
          } else {
            products[i].style.display = 'none';

          }
        }
      }



    // Listen for clicks on elements with the class 'btn-area'
    document.querySelectorAll('.btn-area').forEach(function(button) {
      button.addEventListener('click', function() {
          // Remove the 'displayed-item' class from all divs with the class 'col-md-12'
          document.querySelectorAll('div.col-md-12').forEach(function(div) {
              div.classList.remove('displayed-item');
          });

          // Remove the closest ancestor 'row' element of the clicked button
          var closestRow = this.closest('.row');
          if (closestRow) {
              closestRow.remove();
          }
      });
    });


    function showForm() {
        // إظهار الفورم
        document.getElementById("myForm").style.display = "block";
      }



</script>
</body>
