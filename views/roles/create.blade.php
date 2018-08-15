@extends(Config::get('laravel-permission-gui.layout'))

@section('heading', 'Create Role')

@section('content')
<form action="{{ route('laravel-permission-gui::roles.store') }}" method="post" role="form">
    @include('laravel-permission-gui::roles.partials.form')
    <button type="submit" class="btn btn-labeled btn-primary"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ trans('laravel-permission-gui::button.create') }}</button>
    <a class="btn btn-labeled btn-default" href="{{ route('laravel-permission-gui::roles.index') }}"><span class="btn-label"><i class="fa fa-chevron-left"></i></span>{{ trans('laravel-permission-gui::button.cancel') }}</a>
</form>
@endsection
