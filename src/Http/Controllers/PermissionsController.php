<?php namespace Nemozar\LaravelPermissionGui\Http\Controllers;

use Acoustep\EntrustGui\Gateways\PermissionGateway;
use Illuminate\Config\Repository as Config;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsController extends ProxyController
{

    /**
     * Display a listing of the resource.
     * GET /model
     *
     * @return Response
     */
    public function index()
    {
        $permissions = Permission::all();

        return $this->view('laravel-permission-gui::permissions.index', compact(
            "permissions"
        ));
    }

    /**
     * Show the form for creating a new resource.
     * GET /model/create
     *
     * @return Response
     */
    public function create()
    {
        $model = new Permission();
        $roles = Role::all();

        return view('laravel-permission-gui::permissions.create', compact(
            'model',
            'roles'
        ));
    }

    /**
     * Store a newly created resource in storage.
     * POST /model
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name|max:255',
            'display_name' => 'required|max:255',
        ]);
        try {
            $permission = Permission::create($request->except('roles'));
            if (count($request->get('roles')) >0){
                $permission->syncRoles($request->get('roles'));
            }
        } catch (\Exception $e) {
            //TODO:catch with native validate by request
            if ($this->isApi()){
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'name' => [$e->getMessage()]
                ]);
                throw $error;
            }else {
                return back()->withErrors($e->getMessage())->withInput();
            }
        }
        if ($this->isApi()){
            return $permission;
        }else {
            return redirect(
                route(
                    'laravel-permission-gui::permissions.index'
                )
            )->withSuccess(
                trans(
                    'laravel-permission-gui::permissions.created'
                )
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     * GET /model/{id}/edit
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $model = Permission::findById($id);
        $roles = Role::all();

        return view('laravel-permission-gui::permissions.edit', compact(
            'model',
            'roles'
        ));
    }

    /**
     * Update the specified resource in storage.
     * PUT /model/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $permission = Permission::findById($id);
        $request->validate([
            'name' => 'required|unique:permissions,name,'.$id.'|max:255',
            'display_name' => 'required|max:255',
        ]);
        $permission->fill($request->except('roles'));
        $permission->save();
        if (count($request->get('roles')) >0){
            $permission->syncRoles($request->get('roles'));
        }
        if ($this->isApi()){
            return ['status' => 'success'];
        }else {
            return redirect(
                route(
                    'laravel-permission-gui::permissions.index'
                )
            )->withSuccess(
                trans(
                    'laravel-permission-gui::permissions.updated'
                )
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /model/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $permission = Permission::findById($id);
        $permission->delete();
        if ($this->isApi()){
            return ['status' => 'success'];
        }else{
            return redirect(
                route(
                    'laravel-permission-gui::permissions.index'
                )
            )->withSuccess(
                trans(
                    'laravel-permission-gui::permissions.destroyed'
                )
            );
        }
    }
}
