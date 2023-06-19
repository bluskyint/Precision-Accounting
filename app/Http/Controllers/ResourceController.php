<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resource;
use App\Traits\SEOTrait;

class ResourceController extends Controller
{
    use SEOTrait;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */


    public function index()
    {
        $resources = Resource::get();


        // SEO Trait
        $this->staticPagesSeo(
            'Resources',
            'resources of precision accounting Intl LLC site',
            'State of New Jersey Department of Treasury,The New York State Department of Taxation and Finance,IRS Small Business Resources,Social Security Resources,Tax Calculator,Track Your Tax Refunds'
        );


        return view('resources',compact('resources'));
    }


}
