<?php

namespace App\Http\Controllers;

use App\Models\Page;
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
        $page = Page::where('name', 'about us')->first();
        // SEO Trait
        $this->dynamicPagesSeo($page);

        return view('about', compact('page'));
    }
}
