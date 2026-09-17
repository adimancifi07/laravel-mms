<?php

namespace Modules\Backend\Http\Controllers;

use App\Http\Controllers\BaseController;
// use Illuminate\Http\Request;

class BackendController extends BaseController
{

    public function __construct()
    {
        parent::__construct();

        $this->__activeTheme = null;
        $this->__LayoutsDestination = 'backend.panel';
    }


} // End off Class.
