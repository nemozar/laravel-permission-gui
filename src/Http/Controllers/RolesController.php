<?php namespace Nemozar\LaravelPermissionGui\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends ProxyController
{


    /**
     * Display a listing of the resource.
     * GET /model
     *
     * @return Response
     */
    public function index()
    {
        $roles = Role::all();
        return $this->view('laravel-permission-gui::roles.index', compact(
            "roles"
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
        $model = new Role();
        $permissions = Permission::all();
        return view('laravel-permission-gui::roles.create', compact(
            'model',
            'permissions'
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
            'name' => 'required|unique:roles,name|max:255',
            'display_name' => 'required|max:255',
        ]);
        try{
            $role = Role::create($request->except('permissions'));
            if (count($request->get('permissions')) > 0){
                $role->syncPermissions($request->get('permissions'));
            }
        }catch (\Exception $e){
            if ($this->isApi()){
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'name' => [$e->getMessage()]
                ]);
                throw $error;
            }else {
                return redirect()->back()->withErrors($e->getMessage())->withInput();
            }
        }
        if ($this->isApi()){
            return $role;
        }else {
            return redirect(
                route(
                    'laravel-permission-gui::roles.index'
                )
            )->withSuccess(
                trans(
                    'laravel-permission-gui::roles.created'
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
        $model = Role::findById($id);
        $permissions = Permission::all();

        return view('laravel-permission-gui::roles.edit', compact(
            'model',
            'permissions'
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
        $role = Role::findById($id);
        $request->validate([
            'name' => 'required|unique:roles,name,'.$id.'|max:255',
            'display_name' => 'required|max:255',
        ]);
        $role->fill($request->except('permissions'));
        $role->save();
        if (count($request->get('permissions')) > 0){
            $role->syncPermissions($request->get('permissions'));
        }
        if ($this->isApi()){
            return $role;
        }else {
            return redirect(
                route(
                    'laravel-permission-gui::roles.index'
                )
            )->withSuccess(
                trans(
                    'laravel-permission-gui::roles.updated'
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
        Role::findById($id)->delete();
        if ($this->isApi()){
            return ['status' => 'success'];
        }else {
            return redirect(
                route(
                    'laravel-permission-gui::roles.index'
                )
            )->withSuccess(
                trans(
                    'laravel-permission-gui::roles.destroyed'
                )
            );
        }
    }
}
