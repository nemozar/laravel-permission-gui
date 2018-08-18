<?php namespace Nemozar\LaravelPermissionGui\Http\Controllers;

use Acoustep\EntrustGui\Gateways\PermissionGateway;
use Illuminate\Config\Repository as Config;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsController extends Controller
{
    protected $request;
    protected $relation;
    protected $config;
    protected $relation_name;

    public function __construct(Request $request, Config $config)
    {
        $this->config = $config;
        $this->request = $request;
        $this->relation = new Permission();
    }

    /**
     * Display a listing of the resource.
     * GET /model
     *
     * @return Response
     */
    public function index()
    {
        $models = Permission::all();

        return view('laravel-permission-gui::permissions.index', compact(
            "models"
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
        try {
            $permission = Permission::create($request->except('roles'));
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
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
