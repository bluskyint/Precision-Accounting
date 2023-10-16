<?php

namespace App\Http\Controllers;

use App\Models\Page;
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
        $page = Page::where('name', 'resources')->first();

        // SEO Trait
        $this->dynamicPagesSeo($page);


        return view('resources',compact('resources', 'page'));
    }


}
