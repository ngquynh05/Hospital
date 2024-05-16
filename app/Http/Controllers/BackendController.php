<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Routing\Controller as BaseController;

class BackendController extends Controller
{
    public function __construct(){
        $route = Route::current();
        $name = Route::currentRouteName();
        $action = Route::currentRouteAction();
        $routeArray = app('request')->route()->getAction();
        $controllerAction = class_basename($routeArray['controller']);
        list($controller, $action) = explode('@', $controllerAction);
        View::share('controller', $controller);
        View::share('action', $action);
        View::share('routeCurrentName', $route);
        View::share('routeName', $name);
        View::share('actionName', $action);
    }
}
