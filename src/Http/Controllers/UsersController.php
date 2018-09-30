<?php namespace Nemozar\LaravelPermissionGui\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Watson\Validating\ValidationException;

class UsersController extends ProxyController
{

    /**
     * Display a listing of the resource.
     * GET /roles
     *
     * @return Response
     */
    public function index()
    {
        $users = User::all();
        return $this->view(
            'laravel-permission-gui::users.index',
            compact(
                'users'
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     * GET /roles/{id}/edit
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $activeRoles = $user->roles;
        $roles = Role::all();

        return $this->view(
            'laravel-permission-gui::users.edit',
            compact(
                'user',
                'roles',
                'activeRoles'
            )
        );
  
    }

    /**
     * Update the specified resource in storage.
     * PUT /roles/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($request->get('roles')){
            $user->syncRoles($request->get('roles'));
        }
        if ($this->isApi()){
            return $user;
        }else {
            return redirect(route('laravel-permission-gui::users.index'))
                ->withSuccess(trans('laravel-permission-gui::users.updated'));
        }
    }

}
