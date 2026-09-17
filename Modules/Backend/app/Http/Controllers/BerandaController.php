<?php

namespace Modules\Backend\Http\Controllers;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Override;

class BerandaController extends BackendController
{

    public function __construct()
    {
        parent::__construct();




        meta()->set('title', 'Beranda');
    }



    public function index()
    {
        return $this->_view('backend::beranda.index');
    }


} // End Class.
