<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
    <label for="name">{{trans('laravel-permission-gui::db.name')}}</label>
    <input type="input" class="form-control" id="name" placeholder="{{trans('laravel-permission-gui::db.name')}}" name="name" value="{{ (Session::has('errors')) ? old('name', '') : $model->name }}">
</div>
<div class="form-group">
    <label for="display_name">{{trans('laravel-permission-gui::db.full_name')}}</label>
    <input type="input" class="form-control" id="full_name" placeholder="{{trans('laravel-permission-gui::db.full_name')}}" name="full_name" value="{{ (Session::has('errors')) ? old('full_name', '') : $model->full_name }}">
</div>
<div class="form-group">
    <label for="description">{{trans('laravel-permission-gui::db.description')}}</label>
    <input type="input" class="form-control" id="description" placeholder="{{trans('laravel-permission-gui::db.description')}}" name="description" value="{{ (Session::has('errors')) ? old('description', '') : $model->description }}">
</div>
<div class="form-group">
    <label for="permissions">{{trans('laravel-permission-gui::db.permissions')}}</label>
    <select name="permissions[]" multiple class="form-control">
      @foreach($permissions as $index => $permission)
        <option value="{{ $index }}" {{ ((in_array($index, old('permissions', []))) || ( ! Session::has('errors') && $model->hasPermissionTo($permission->name))) ? 'selected' : '' }}>{{ $permission->full_name }}</option>
      @endforeach
    </select>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
