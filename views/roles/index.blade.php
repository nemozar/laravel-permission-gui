@extends(Config::get('laravel-permission-gui.layout'))

@section('heading', 'Roles')

@section('content')
    @include('laravel-permission-gui::partials.navigation')
<div class="models--actions">
    <a class="btn btn-labeled btn-primary" href="{{ route('laravel-permission-gui::roles.create') }}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ trans('laravel-permission-gui::button.create-role') }}</a>
</div>
<table class="table table-striped">
    <tr>
        <th>Name</th>
        <th>Actions</th>
    </tr>
    @foreach($models as $model)
        <tr>
            <td>{{ $model->name }}</th>
            <td class="col-xs-3">
                <form action="{{ route('laravel-permission-gui::roles.destroy', $model->id) }}" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <a class="btn btn-labeled btn-default" href="{{ route('laravel-permission-gui::roles.edit', $model->id) }}"><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ trans('laravel-permission-gui::button.edit') }}</a>
                    <button type="submit" class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>{{ trans('laravel-permission-gui::button.delete') }}</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
@endsection
