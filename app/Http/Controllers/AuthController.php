<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Forrest;

class AuthController extends Controller
{
    /**
     *
     * @return Forrest
     */
    public function authenticate()
    {
        return Forrest::authenticate();
    }
}
