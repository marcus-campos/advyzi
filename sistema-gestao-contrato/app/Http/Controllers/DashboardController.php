<?php

namespace SgcAdmin\Http\Controllers;

use Illuminate\Http\Request;

use SgcAdmin\Http\Requests;

class DashboardController extends Controller
{
    public function index()
    {
        return view('template');
    }
}
