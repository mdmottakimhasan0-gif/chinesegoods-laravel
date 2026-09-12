<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        return view('pages.about');
    }

    public function terms(): View
    {
        return view('pages.terms');
    }

    public function payment(): View
    {
        return view('pages.payment');
    }

    public function tracking(): View
    {
        return view('pages.tracking');
    }
}
