<?php

namespace App\Http\Middleware;

use App\Http\Middleware\Authenticate as Middleware;

class CanAuthenticate extends Middleware
{
    protected function authenticate($request, array $guards)
    {
    }
}
