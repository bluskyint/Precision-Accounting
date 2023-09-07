<?php

namespace App\Http\Controllers;

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


    public function index(TaxCenter $taxCenter)
    {
        // SEO Trait
        $this->dynamicPagesSeo($taxCenter);

        return view('taxCenter',compact('taxCenter'));
    }


}
