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
        $taxcenters = TaxCenter::all();

        // SEO Trait
        $page = Page::where('name', 'tax centers')->first();
        $this->dynamicPagesSeo($page);

        return view('taxcenters', compact('taxcenters', 'page'));
    }

    public function show(TaxCenter $taxcenter)
    {
        // SEO Trait
        $this->dynamicPagesSeo($taxcenter);

        return view('taxcenter',compact('taxcenter'));
    }


}
