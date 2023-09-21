<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AuthController extends Controller
{

    /**
     * Auth controller construct.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Sign up form controller.
     *
     * @return View Sign up form view.
     */
    public function signUpForm(): View
    {
        return view($this->profile . '.auth.sign-up');
    }

}
