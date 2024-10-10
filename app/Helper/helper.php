<?php

if (!function_exists('groupActive')) {
    function groupActive($route)
    {
        return call_user_func_array('Route::is', (array) $route) ? 'active' : '';
    }
}

if (!function_exists('routeActive')) {
    function routeActive($route)
    {
        return request()->routeIs($route) ? 'active' : '';
    }
}





?>