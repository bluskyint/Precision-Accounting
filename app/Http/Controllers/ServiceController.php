<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Traits\SEOTrait;

class ServiceController extends Controller
{
    use SEOTrait;


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */


    public function index(Service $service)
    {
        // SEO Trait
        $this->dynamicPagesSeo($service);

        return view('service',compact("service"));
    }


}
