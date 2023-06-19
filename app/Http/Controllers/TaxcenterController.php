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


    public function index($slug)
    {
        $tax_center = TaxCenter::where('slug',$slug)->first();
        // if tax_center Not Found
        if( !$tax_center ){
            return redirect('/');
        }
        // SEO Trait
        $this->dynamicPagesSeo($tax_center);

        return view('tax_center',compact("tax_center"));
    }


}
