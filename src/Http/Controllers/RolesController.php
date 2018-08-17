<?php namespace Nemozar\LaravelPermissionGui\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{

    protected $rules = [
        'name' => 'required|unique:roles|max:255',
        'full_name' => 'required|max:255',
    ];

    /**
     * Display a listing of the resource.
     * GET /model
     *
     * @return Response
     */
    public function index()
    {
        $models = Role::all();



        return view('laravel-permission-gui::roles.index', compact(
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
        try{
            $role = Role::create($request->except('permissions'));
        }catch (\Exception $e){
            return  redirect()->back()->withErrors( $e->getMessage())->withInput();
        }
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

        $role->fill($request->except('permissions'));
        $v = Validator::make($role->getAttributes(), $this->rules);
        if ($v->fails())
        {
            return back()->withErrors($v->errors())->withInput();
        }
        $role->save();

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
