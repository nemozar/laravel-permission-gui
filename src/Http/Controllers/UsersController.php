<?php namespace Nemozar\LaravelPermissionGui\Http\Controllers;

use App\User;
use Illuminate\Routing\Controller as Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Watson\Validating\ValidationException;
use Illuminate\Config\Repository as Config;

/**
 * This file is part of Entrust GUI,
 * A Laravel 5 GUI for Entrust.
 *
 * @license MIT
 * @package Acoustep\EntrustGui
 */
class UsersController extends Controller
{

    protected $request;
    protected $role;
    protected $config;

    /**
     * Create a new UsersController instance.
     *
     * @param Request $request
     * @param Config $config
     *
     * @return void
     */
    public function __construct(Request $request, Config $config)
    {
        $this->config = $config;
        $this->request = $request;
        $this->role = new Role();
    }

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
     * Store a newly created resource in storage.
     * POST /roles
     *
     * @return Response
     */
    public function store()
    {
        try {
            $user = $this->gateway->create($this->request);
        } catch (ValidationException $e) {
            return redirect(route('laravel-permission-gui::users.create'))
                ->withErrors($e->getErrors())
                ->withInput();
        }
        return redirect(route('laravel-permission-gui::users.index'))
            ->withSuccess(trans('laravel-permission-gui::users.created'));
  
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
    public function update($id)
    {
        try {
            $this->gateway->update($this->request, $id);
        } catch (ValidationException $e) {
            return back()->withErrors($e->getErrors())->withInput();
        }
        return redirect(route('laravel-permission-gui::users.index'))
            ->withSuccess(trans('laravel-permission-gui::users.updated'));
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /roles/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        if (!config('laravel-permission-gui.users.deletable')) {
            abort(404);
        }
        $this->gateway->delete($id);
        return redirect(route('laravel-permission-gui::users.index'))
            ->withSuccess(trans('laravel-permission-gui::users.destroyed'));
    }
}
