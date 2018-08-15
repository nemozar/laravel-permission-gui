    <!-- Collect the nav links, forms, and other content for toggling -->
      <ul class="nav navbar-nav">
        <li class="{{ (Request::is('*users*') ? 'active' : '') }}"><a href="{{ route('laravel-permission-gui::users.index') }}">{{ trans('laravel-permission-gui::navigation.users') }}</a></li>
        <li class="{{ (Request::is('*roles*') ? 'active' : '') }}"><a href="{{ route('laravel-permission-gui::roles.index') }}">{{ trans('laravel-permission-gui::navigation.roles') }}</a></li>
        <li class="{{ (Request::is('*permissions*') ? 'active' : '') }}"><a href="{{ route('laravel-permission-gui::permissions.index') }}">{{ trans('laravel-permission-gui::navigation.permissions') }}</a></li>
      </ul>
