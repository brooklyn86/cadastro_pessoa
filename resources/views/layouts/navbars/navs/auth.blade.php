<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('home') }}">{{ __('Dashboard') }}</a>
        <!-- Form -->

        <!-- User -->
        <li class="navbar-nav align-items-center d-none d-md-flex" >
            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" style="color:white">
                <i class="ni ni-user-run"></i>
                <span>{{ __('Sair') }}</span>
            </a>
        </li>       
    </div>
</nav>