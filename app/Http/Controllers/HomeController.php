<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * @param string|null $language
     *
     * @return RedirectResponse
     */
    public function changeLanguage(?string $language) : RedirectResponse
    {
        \Session::put('website_language', $language);

        return redirect()->back();
    }

    /**
     * @return View
     */
    public function index() : View
    {
        return view('home');
    }
}
