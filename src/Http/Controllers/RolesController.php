<?php namespace Nemozar\LaravelPermissionGui\Http\Controllers;

use Acoustep\EntrustGui\Gateways\RoleGateway;
use Illuminate\Config\Repository as Config;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{

    protected $request;
    protected $relation;
    protected $config;
    protected $relation_name;


    public function __construct(Request $request, Config $config)
    {
        $this->config = $config;
        $this->request = $request;
        $this->relation = new Role();
    }

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
        $model_class = $this->config->get('entrust.'.str_singular($this->resource));
        $model = new $model_class;
        $relations = $this->relation->lists('name', 'id');

        return view('laravel-permission-gui::'.$this->resource.'.create', compact(
            'model',
            'relations'
        ));
    }

    /**
     * Store a newly created resource in storage.
     * POST /model
     *
     * @return Response
     */
    public function store()
    {
        try {
            $this->gateway->create($this->request);
        } catch (ValidationException $e) {
            return back()->withErrors($e->getErrors())->withInput();
        }
        return redirect(
            route(
                'laravel-permission-gui::'.$this->resource.'.index'
            )
        )->withSuccess(
            trans(
                'laravel-permission-gui::'.$this->resource.'.created'
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
        $model = $this->gateway->find($id);
        $relations = $this->relation->lists('name', 'id');

        return view('laravel-permission-gui::'.$this->resource.'.edit', compact(
            'model',
            'relations'
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
    public function update($id)
    {
        try {
            $role = $this->gateway->update($this->request, $id);
        } catch (ValidationException $e) {
            return back()->withErrors($e->getErrors())->withInput();
        }
        return redirect(
            route(
                'laravel-permission-gui::'.$this->resource.'.index'
            )
        )->withSuccess(
            trans(
                'laravel-permission-gui::'.$this->resource.'.updated'
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
        $this->gateway->delete($id);
        return redirect(
            route(
                'laravel-permission-gui::'.$this->resource.'.index'
            )
        )->withSuccess(
            trans(
                'laravel-permission-gui::'.$this->resource.'.destroyed'
            )
        );
    }
}
