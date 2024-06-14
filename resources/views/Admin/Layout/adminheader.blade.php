<header>
    <nav class="navbar navbar-expand-sm   navbar-light">
    <!-- Brand/logo -->
    <a class="navbar-brand websitetitle" href="{{ route('dashboard') }}"><h2>{{ __('admin.hot') }}</h2></a>

    <!-- Links -->
    <ul class="navbar-nav">


    <li class="nav-item">

        <div class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown">
                {{ __('admin.countries') }}
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ route('get.countries') }}">{{ __('admin.countries') }}</a>
              <hr>
              <a class="dropdown-item" href="{{ route('add.country') }}">{{ __('admin.add_country') }}</a>
            </div>
          </div>

</li>


<li class="nav-item">

    <div class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown">
            {{ __('admin.city') }}
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="{{ route('get.cities') }}">
            {{ __('admin.city') }}

          </a>
          <hr>
          <a class="dropdown-item" href="{{ route('add.city') }}">
            {{ __('admin.add_city') }}
          </a>
        </div>
      </div>

</li>



<li class="nav-item">

    <div class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown">
            {{ __('admin.hot') }}
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="{{ route('get.hotels') }}">{{ __('admin.hot') }}</a>
          <hr>
          <a class="dropdown-item" href="{{ route('add.hotel') }}">{{ __('admin.add_hot') }}</a>
        </div>
      </div>

</li>



<li class="nav-item">

    <div class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown">
            {{ __('admin.attach') }}
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="{{ route('get.attachments') }}">{{ __('admin.attach') }}
</a>
          <hr>
          <a class="dropdown-item" href="{{ route('add.attachments') }}">{{ __('admin.add_attach') }}
        </a>
        </div>
      </div>

</li>

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
        <a class="btn btn-danger logout" href="{{route('admin.logout')}}"><i class="fa fa-user-circle-o"></i> {{__('admin.logout')}}</a>
      </li>
    </ul>
  </nav>
</header>

