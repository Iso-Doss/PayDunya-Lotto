<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected string $profile = 'customer';

    public function __construct(string $profile = 'customer')
    {
        $this->profile = $profile;
        View::share('profile', $this->profile);
    }
}
