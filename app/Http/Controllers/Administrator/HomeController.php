<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Paydunya\Setup;

class HomeController extends Controller
{

    /**
     * Home controller construct.
     */
    public function __construct()
    {
        parent::__construct('administrator');
    }

    /**
     * Dashboard controller.
     *
     * @return View|RedirectResponse The dashboard page view.
     */
    public function dashboard(): View|RedirectResponse
    {
        return redirect()->route($this->profile . '.lottery.index');
        //return view($this->profile . '.dashboard.index');

    }

}
