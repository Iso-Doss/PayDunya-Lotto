<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomeController extends Controller
{

    /**
     * Home controller construct.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Home page controller.
     *
     * @return View The home page view.
     */
    public function index(): View
    {
        return view($this->profile . '.index');
    }

    /**
     * Dashboard page controller.
     *
     * @return RedirectResponse The redirect response.
     */
    public function dashboard(): RedirectResponse
    {
        return redirect()->route($this->profile . '.lottery.index');
    }
}
