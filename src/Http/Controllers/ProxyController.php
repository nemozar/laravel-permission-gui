<?php
namespace Nemozar\LaravelPermissionGui\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as Controller;

class ProxyController extends Controller{

    /**
     * @var \Illuminate\Http\Request
     */
    var $request;

    function view($view = null, $data = [])
    {
        if ($this->isApi()){
            return $data;
        }else{
            return view($view, $data);
        }
    }

    function isApi()
    {
        if (strpos($this->request->getRequestUri(),'/api/') === 0){
            return true;
        }else{
            return false;
        }
    }

    function __construct(Request $request)
    {
        $this->request = $request;
    }
}
