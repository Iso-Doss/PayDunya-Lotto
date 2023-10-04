<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Lottery;
use App\Models\Status;
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
        $lotteries = Lottery::where('status_id', '=', Status::whereCode('WAITING_DRAW')->first()?->id)->whereNotNull('activated_at')
            ->orderBy('id', 'desc')
            ->paginate(3);
        return view($this->profile . '.index', ['lotteries' => $lotteries]);
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
