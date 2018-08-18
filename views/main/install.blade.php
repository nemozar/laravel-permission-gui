@extends(Config::get('laravel-permission-gui.layout'))

@section('heading', trans('laravel-permission-gui::head.install'))

@section('content')
    <form action="{{ route('laravel-permission-gui::install') }}" method="post" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="roles">{{trans('laravel-permission-gui::users.name')}}</label>
            <select class="form-control" name="user">
                @foreach($users as $index => $name)
                    <option value="{{ $index }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" id="save" class="btn btn-labeled btn-primary"><span class="btn-label"><i class="fa fa-check"></i></span>{{ trans('laravel-permission-gui::button.save') }}</button>
    </form>
@endsection

