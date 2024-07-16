<header>
    <nav class="navbar navbar-expand-sm   navbar-light">
    <!-- Brand/logo -->
    <a class="navbar-brand websitetitle" href=""><h2>{{ __('admin.hot') }}</h2></a>

    <!-- Links -->
    <ul class="navbar-nav">



        <a  href="{{ route('hotel.profile') }}"> <li class="nav-item">
{{ __('hotel.hot') }}

</li></a>


<li class="nav-item">

    <div class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown">
            {{ __('hotel.rooms') }}

        </a>
        <div class="dropdown-menu">
           <a class="dropdown-item" href="{{ route('get.rooms') }}">{{ __('hotel.rooms') }}
        </a>
          <hr>
          <a class="dropdown-item" href="{{ route('add.room') }}">{{ __('hotel.add_room') }}
</a>
        </div>
      </div>

</li>



<a class="" href="{{ route('get.reservation') }}"><li class="nav-item">
{{ __('hotel.reservation') }}

</li>
</a>




      <li class="dropdown dropdown-user nav-item">
        <a class="dropdown-toggle nav-link dropdown-user-link " href="#" data-toggle="dropdown">
<span class="mr-1">
<span
    class="user-name text-bold-700">{{ LaravelLocalization::getCurrentLocaleName()  }}</span>
</span>

        </a>
        <div class="dropdown-menu dropdown-menu-right">

        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

            <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                {{ $properties['native'] }}
            </a>

            <div class="dropdown-divider"></div>
            @endforeach
        </div>
    </li>

      <li class="nav-item">
        <a class="btn btn-danger logout" href= '{{ route('logout') }}' > <i class="fa fa-user-circle-o"></i> {{__('admin.logout')}}</a>
      </li>
    </ul>
  </nav>
</header>

<style>
    a{
        color: inherit;
        text-decoration: none;
    }

    a li{
        margin-top: 5px
    }
</style>
