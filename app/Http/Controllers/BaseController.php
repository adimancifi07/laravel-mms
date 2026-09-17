<?php

namespace App\Http\Controllers;


class BaseController extends Controller
{
    public $sitename = 'CiFireCMS';

    /* View data
     *
     * $this->__viewData['foo'] = ['bar','bas']
     */
    public array $__viewData = [];

    /* Module penunjuk inisial
     * var untuk menentukan inisial dari module atau componen
     * $this->__mod = 'foo';
     */
    public string $__mod;

    /*
     * Bahasa yang sedang digunakan.
     * $thisn->__currentLang = 'id';
     */
    public string $__currentLang;

    public string $__lang;


    public string $__model;

    public string $__viewPath;

    public array $__loginData = [];

    public string|null $__activeTheme = null;
    public string $__themeLayouts = '';
    public string $__LayoutsDestination = '';

    public function __construct()
    {
        $this->__viewData['__CI'] = $this;

        $this->__themeLayouts = 'index'; // masih hardcode.
        $this->__activeTheme = 'default'; // masih hardcode.

        // theme.default.layouts.index_login
        $this->__LayoutsDestination = 'theme.' . $this->__activeTheme . '.layouts.'.$this->__themeLayouts; // masih hardcode.
    }


    protected function _view(string|null $view = null, array $data = [])
    {
        $viewStr = $view;

        if (!empty($this->__activeTheme)) {
            $viewStr = 'theme.' . $this->__activeTheme . '.' . $view;
        }

        return view($viewStr, array_merge($this->__viewData, $data));
    }

} // End of class.
