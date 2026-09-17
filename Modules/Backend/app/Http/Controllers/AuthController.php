<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends BackendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        return $this->_view('backend.login');
    }


} // End of class.
