<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Member;
use App\Models\Page;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Traits\SEOTrait;
class HomeController extends Controller
{
    use SEOTrait;

    public function index()
    {
        $testimonials = Testimonial::where('visibility', '1')->get();
        $members      = Member::where('slider_show','1')->get();
        $articles     = Article::orderBy('id','desc')->limit(6)->get();
        $services     = Service::where('parent_id', Null)->limit(6)->get();
        $page = Page::where('name', 'home')->first();

        // SEO Trait
        $this->dynamicPagesSeo($page);

        return view('home' , compact('testimonials', 'members','articles','services', 'page'));
    }
}
