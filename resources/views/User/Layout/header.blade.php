<header>
    <nav class="navbar navbar-expand-sm   navbar-light">
    <!-- Brand/logo -->
    <a class="navbar-brand websitetitle" href="#"><h2>{{ __('user.hot') }}</h2></a>

    <!-- Links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href={{ route('showfav') }}><i class="fa fa-heart-o"></i> {{ __('user.fav') }}</a>
      </li>
      <li class="dropdown dropdown-user nav-item">
        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
<span class="mr-1">
<span>
   USD
</span>

        </a>
        <div class="dropdown-menu dropdown-menu-right">

USD
        </div>
    </li>
      <li class="dropdown dropdown-user nav-item">
        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
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

        <div class="dropdown" style="background-color: white;
    color: black;">
    @auth
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ __('user.wel') }} {{auth()->user()->name }}
            </button>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="{{ route('My_Cart') }}">{{ __('user.cart') }}</a>
            <div class="dropdown-divider"></div>

              <a class="dropdown-item" href="{{ route('user.reservation') }}">{{ __('user.userreserv') }}</a>
              <div class="dropdown-divider"></div>


              <a class="dropdown-item" href="{{ route('User.logout') }}">{{ __('admin.logout') }}</a>

            @endauth



            </div>

            @if(!auth()->user())

            <a class="btn btn-primary" href="{{ route('user.login') }}">{{ __('user.login') }}</a>

            @endif
          </div>





      </li>
    </ul>
  </nav>
</header>
