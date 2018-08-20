<?php namespace Nemozar\LaravelPermissionGui\Http\Controllers;

use App\User;
use Illuminate\Routing\Controller as Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Watson\Validating\ValidationException;
use Illuminate\Config\Repository as Config;

class UsersController extends Controller
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
        return view(
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
        $roles = Role::pluck('name', 'id')->all();

        return view(
            'laravel-permission-gui::users.edit',
            compact(
                'user',
                'roles'
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
        if ($request->get('roles')){
            $user = User::find($id);
            $user->syncRoles($request->get('roles'));
        }
        return redirect(route('laravel-permission-gui::users.index'))
            ->withSuccess(trans('laravel-permission-gui::users.updated'));
    }

}
