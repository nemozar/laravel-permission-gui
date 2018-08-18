@extends(Config::get('laravel-permission-gui.layout'))

@section('heading', 'Edit User')

@section('content')
<form action="{{ route('laravel-permission-gui::users.update', $user->id) }}" method="post" role="form">
    <input type="hidden" name="_method" value="put">

    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="roles">Roles</label>
        <select name="roles[]" id="roles" multiple class="form-control">
            @foreach($roles as $index => $role)
                <option value="{{ $index }}" {{ ((in_array($index, old('roles', []))) || ( ! Session::has('errors') && $user->roles->contains('id', $index))) ? 'selected' : '' }}>{{ $role }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" id="save" class="btn btn-labeled btn-primary"><span class="btn-label"><i class="fa fa-check"></i></span>{{ trans('laravel-permission-gui::button.save') }}</button>
    <a class="btn btn-labeled btn-primary" href="{{ route('laravel-permission-gui::users.index') }}"><span class="btn-label"><i class="fa fa-chevron-left"></i></span>{{ trans('laravel-permission-gui::button.cancel') }}</a>
</form>
@endsection

