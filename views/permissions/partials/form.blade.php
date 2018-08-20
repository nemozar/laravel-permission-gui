<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
    <label for="name">{{trans('laravel-permission-gui::db.name')}}</label>
    <input type="input" class="form-control" id="name" placeholder="Name" name="name" value="{{ (Session::has('errors')) ? old('name', '') : $model->name }}">
</div>
<div class="form-group">
    <label for="display_name">{{trans('laravel-permission-gui::db.display_name')}}</label>
    <input type="input" class="form-control" id="display_name" placeholder="Display Name" name="display_name" value="{{ (Session::has('errors')) ? old('display_name', '') : $model->display_name }}">
</div>
<div class="form-group">
    <label for="description">{{trans('laravel-permission-gui::db.description')}}</label>
    <input type="input" class="form-control" id="description" placeholder="Description" name="description" value="{{ (Session::has('errors')) ? old('description', '') : $model->description }}">
</div>
<div class="form-group">
    <label for="roles">{{trans('laravel-permission-gui::head.roles')}}</label>
    <select name="roles[]" multiple class="form-control">
        @foreach($roles as $index => $role)
            <option value="{{ $role->id }}" {{ ((in_array($role->id, old('roles', []))) || ( ! Session::has('errors') && $model->name && $role->hasPermissionTo($model->name))) ? 'selected' : '' }}>{{ $role->display_name }}</option>
        @endforeach
    </select>
</div>
