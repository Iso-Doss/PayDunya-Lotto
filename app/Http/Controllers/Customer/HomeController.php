<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomeController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(): View
    {
        return view($this->profile . '.index');
    }

    public function dashboard(): RedirectResponse
    {
        return redirect()->route($this->profile . '.dashboard.index');
    }
}
