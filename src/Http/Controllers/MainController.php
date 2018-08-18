<?php namespace Nemozar\LaravelPermissionGui\Http\Controllers;

use Acoustep\EntrustGui\Gateways\PermissionGateway;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MainController extends Controller
{
    function install()
    {
        $users = User::role('admin')->get();
        if (count($users) > 0){
            throw new \Exception(trans("laravel-permission-gui::db.installed"));
        }else{
            $users = User::pluck("name" , 'id');
            return view('laravel-permission-gui::main.install',
                compact('users'));
        }
    }

    function setuser(Request $request)
    {
        $user = User::findOrFail($request->all()['user']);
        $user->assignRole('admin');
        return back();
    }
}
