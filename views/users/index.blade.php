@extends(Config::get('laravel-permission-gui.layout'))


@section('heading', trans('laravel-permission-gui::head.users'))

@section('content')
    @include('laravel-permission-gui::partials.navigation')

    <table class="table table-striped">
        <tr>
            <th>{{trans('laravel-permission-gui::db.name')}}</th>
            <th>{{trans('laravel-permission-gui::db.email')}}</th>
            <th>{{trans('laravel-permission-gui::db.actions')}}</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>
                {{ $user->name }}</th>
                <td>
                {{ $user->email }}</th>
                <td class="col-xs-3">
                    <form action="{{ route('laravel-permission-gui::users.destroy', $user->id) }}" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a class="btn btn-labeled btn-primary" href="{{ route('laravel-permission-gui::users.edit', $user->id) }}"><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ trans('laravel-permission-gui::button.edit') }}</a>
                        @if (config('laravel-permission-gui.users.deletable'))
                            <button type="submit" class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>{{ trans('laravel-permission-gui::button.delete') }}</button>
                        @endif
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
