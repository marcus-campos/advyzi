<?php

namespace SgcAdmin\Http\Controllers;

use Illuminate\Http\Request;

use SgcAdmin\Http\Requests;

class DashboardController extends Controller
{
    private $breadcrumbs;

    public function __construct()
    {
        $this->breadcrumbs = [
            'title' => 'Dashboard',
            'page' => 'Início',
            'fa' => 'fa-dashboard'
        ];
    }

    public function index()
    {
        return view(
            'admin.dashboard.index',
            $this->breadcrumbs
        );
    }
}
