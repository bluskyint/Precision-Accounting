<?php

namespace App\Http\Controllers;

use App\Models\Page;
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


    public function index()
    {
        $services = Service::all();

        // SEO Trait
        $page = Page::where('name', 'services')->first();
        $this->dynamicPagesSeo($page);

        return view('services', compact('services', 'page'));
    }

    public function show(Service $service)
    {
        // SEO Trait
        $this->dynamicPagesSeo($service);

        return view('service',compact("service"));
    }


}
