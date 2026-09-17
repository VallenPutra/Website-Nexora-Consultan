<?php

namespace App\Http\Controllers;

use App\Support\SiteContent;
use Illuminate\View\View;

class CompanyController extends Controller
{
    public function about(): View
    {
        return view('pages.company.about');
    }

    public function approach(): View
    {
        return view('pages.company.approach');
    }

    public function team(): View
    {
        return view('pages.company.team', [
            'team' => SiteContent::team(),
        ]);
    }

    public function careers(): View
    {
        return view('pages.company.careers', [
            'positions' => SiteContent::careers(),
        ]);
    }

    public function partners(): View
    {
        return view('pages.company.partners', [
            'partnerGroups' => SiteContent::partners(),
        ]);
    }
}
