<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\SEOTrait;

class AboutController extends Controller
{
    use SEOTrait;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // SEO Trait
        $this->staticPagesSeo(
            'About',
            'Precision Accounting Intl LLC provides professional services in the Tri-State Area and specialize in helping and guiding business owners',
            'tax services,Tax,cpa firms,LLC,LLP,CPA,IRS,NJ,new jersey,clifton,consulting firms,consulting services,payroll,taxes 2021,consulting services,business,cpa business,precision accounting'
        );

        return view('about');
    }
}
