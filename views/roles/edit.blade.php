@extends(Config::get('laravel-permission-gui.layout'))

@section('heading', trans('laravel-permission-gui::head.edit_role'))

@section('content')
<form action="{{ route('laravel-permission-gui::roles.update', $model->id) }}" method="post" role="form">
<input type="hidden" name="_method" value="put">
  @include('laravel-permission-gui::roles.partials.form')
  <button type="submit" class="btn btn-labeled btn-primary"><span class="btn-label"><i class="fa fa-check"></i></span>{{ trans('laravel-permission-gui::button.save') }}</button>
  <a class="btn btn-labeled btn-primary" href="{{ route('laravel-permission-gui::roles.index') }}"><span class="btn-label"><i class="fa fa-chevron-left"></i></span>{{ trans('laravel-permission-gui::button.cancel') }}</a>
</form>
@endsection
