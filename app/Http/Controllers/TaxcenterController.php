<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\TaxCenter;
use App\Traits\SEOTrait;

class TaxcenterController extends Controller
{
    use SEOTrait;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */

    public function index()
    {
        $taxCenters = TaxCenter::all();

        // SEO Trait
        $page = Page::where('name', 'tax centers')->first();
        $this->dynamicPagesSeo($page);

        return view('taxCenters', compact('taxCenters', 'page'));
    }

    public function show(TaxCenter $taxCenter)
    {
        // SEO Trait
        $this->dynamicPagesSeo($taxCenter);

        return view('taxCenter',compact('taxCenter'));
    }


}
