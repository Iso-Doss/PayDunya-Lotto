<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class LocalizationController extends Controller
{
    /**
     * Get language.
     *
     * @return string
     */
    public function getLang(): string
    {
        return \App::getLocale();
    }

    /**
     * Set language.
     *
     * @param string $lang The language.
     * @return RedirectResponse The redirect response.
     */
    public function setLang($lang): RedirectResponse
    {
        \Session::put('lang', $lang);
        return redirect()->back();
    }
}
