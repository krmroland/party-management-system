<?php

namespace App\Http\Controllers;

use App\Summary;

class DashboardDataController extends Controller
{
    public function index()
    {
        return Summary::all();
    }
}
