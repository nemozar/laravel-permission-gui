@extends(Config::get('laravel-permission-gui.layout'))

@section('heading', trans('laravel-permission-gui::head.permissions'))

@section('tabsadd')
    <a class="btn btn-labeled btn-primary" href="{{ route('laravel-permission-gui::permissions.create') }}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ trans('laravel-permission-gui::button.create-permission') }}</a>
@endsection
@section('content')
    @include('laravel-permission-gui::partials.notifications')
    @include('laravel-permission-gui::partials.navigation')
    <table class="table table-striped">
        <tr>
            <th>{{trans('laravel-permission-gui::db.name')}}</th>
            <th>{{trans('laravel-permission-gui::db.display_name')}}</th>
            <th>{{trans('laravel-permission-gui::db.actions')}}</th>
        </tr>
        @foreach($permissions as $permission)
            <tr>
                <td>{{ $permission->name }}</th>
                <td>{{ $permission->display_name }}</th>
                <td class="col-xs-3">
                    <form action="{{ route('laravel-permission-gui::permissions.destroy', $permission->id) }}" onsubmit="return confirm('{{trans("laravel-permission-gui::db.confirm_delete")}}')" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a class="btn btn-labeled btn-primary" href="{{ route('laravel-permission-gui::permissions.edit', $permission->id) }}"><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ trans('laravel-permission-gui::button.edit') }}</a>
                        <button type="submit" class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>{{ trans('laravel-permission-gui::button.delete') }}</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
