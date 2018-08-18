<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
    <label for="name">Name</label>
    <input type="input" class="form-control" id="name" placeholder="Name" name="name" value="{{ (Session::has('errors')) ? old('name', '') : $model->name }}">
</div>
<div class="form-group">
    <label for="display_name">Display Name</label>
    <input type="input" class="form-control" id="display_name" placeholder="Display Name" name="display_name" value="{{ (Session::has('errors')) ? old('display_name', '') : $model->display_name }}">
</div>
<div class="form-group">
    <label for="description">Description</label>
    <input type="input" class="form-control" id="description" placeholder="Description" name="description" value="{{ (Session::has('errors')) ? old('description', '') : $model->description }}">
</div>
<div class="form-group">
    <label for="roles">Roles</label>
    <select name="roles[]" multiple class="form-control">
        @foreach($roles as $index => $role)
            <option value="{{ $role->id }}" {{ ((in_array($role->id, old('roles', []))) || ( ! Session::has('errors') && $role->hasPermissionTo($model->name))) ? 'selected' : '' }}>{{ $role->display_name }}</option>
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
