<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Page;

class DashboardController extends Controller
{
    public function index()
    {
        $formsCount = Form::count();
        $pagesCount = Page::count();

        return view('dashboard', compact('formsCount', 'pagesCount'));
    }
}
