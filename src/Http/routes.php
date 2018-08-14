<?php
Route::group(
    [
        'prefix' => Config::get("laravel-permission-gui.route-prefix"),
        'middleware' => Config::get("laravel-permission-gui.middleware")
    ],
    function () {
        Route::get('users', ['uses' => 'UsersController@index', 'as' => 'laravel-permission-gui::users.index']);
        Route::get('users/create', ['uses' => 'UsersController@create', 'as' => 'laravel-permission-gui::users.create']);
        Route::post('users', ['uses' => 'UsersController@store', 'as' => 'laravel-permission-gui::users.store']);
        Route::get('users/{id}/edit', ['uses' => 'UsersController@edit', 'as' => 'laravel-permission-gui::users.edit']);
        Route::put('users/{id}', ['uses' => 'UsersController@update', 'as' => 'laravel-permission-gui::users.update']);
        Route::delete('users/{id}', ['uses' => 'UsersController@destroy', 'as' => 'laravel-permission-gui::users.destroy']);
        Route::get('roles', ['uses' => 'RolesController@index', 'as' => 'laravel-permission-gui::roles.index']);
        Route::get('roles/create', ['uses' => 'RolesController@create', 'as' => 'laravel-permission-gui::roles.create']);
        Route::post('roles', ['uses' => 'RolesController@store', 'as' => 'laravel-permission-gui::roles.store']);
        Route::get('roles/{id}/edit', ['uses' => 'RolesController@edit', 'as' => 'laravel-permission-gui::roles.edit']);
        Route::put('roles/{id}', ['uses' => 'RolesController@update', 'as' => 'laravel-permission-gui::roles.update']);
        Route::delete('roles/{id}', ['uses' => 'RolesController@destroy', 'as' => 'laravel-permission-gui::roles.destroy']);
        Route::get('permissions', ['uses' => 'PermissionsController@index', 'as' => 'laravel-permission-gui::permissions.index']);
        Route::get(
            'permissions/create',
            [
                'uses' => 'PermissionsController@create',
                'as' => 'laravel-permission-gui::permissions.create'
            ]
        );
        Route::post('permissions', ['uses' => 'PermissionsController@store', 'as' => 'laravel-permission-gui::permissions.store']);
        Route::get(
            'permissions/{id}/edit',
            [
                'uses' => 'PermissionsController@edit',
                'as' => 'laravel-permission-gui::permissions.edit'
            ]
        );
        Route::put(
            'permissions/{id}',
            [
                'uses' => 'PermissionsController@update',
                'as' => 'laravel-permission-gui::permissions.update'
            ]
        );
        Route::delete(
            'permissions/{id}',
            [
                'uses' => 'PermissionsController@destroy',
                'as' => 'laravel-permission-gui::permissions.destroy'
            ]
        );
    }
);
