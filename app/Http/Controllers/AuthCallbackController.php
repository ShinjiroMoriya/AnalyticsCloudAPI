<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Forrest;

class AuthCallbackController extends Controller
{
    /**
     *
     * @return Forrest
     */
    public function callback()
    {
        Forrest::callback();
        return redirect('/uploader');
    }
}
