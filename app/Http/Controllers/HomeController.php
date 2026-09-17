<?php

namespace App\Http\Controllers;

use App\Support\SiteContent;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('pages.home', [
            'solutions' => SiteContent::solutions(),
            'services' => SiteContent::services(),
            'industries' => SiteContent::industries(),
            'insights' => collect(SiteContent::insights())->take(3),
        ]);
    }
}
