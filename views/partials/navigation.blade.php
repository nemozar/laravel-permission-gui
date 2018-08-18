<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link {{ (Request::is('*users*') ? 'active' : '') }}" href="{{ route('laravel-permission-gui::users.index') }}">{{ trans('laravel-permission-gui::navigation.users') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ (Request::is('*roles*') ? 'active' : '') }}" href="{{ route('laravel-permission-gui::roles.index') }}">{{ trans('laravel-permission-gui::navigation.roles') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ (Request::is('*permissions*') ? 'active' : '') }}" href="{{ route('laravel-permission-gui::permissions.index') }}">{{ trans('laravel-permission-gui::navigation.permissions') }}</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Separated link</a>
        </div>
    </li>
    <li class="nav-item ml-auto">
        @yield('tabsadd')
    </li>
</ul>
