<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Member;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Traits\SEOTrait;
class HomeController extends Controller
{
    use SEOTrait;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $testimonials = Testimonial::where('visibility', '1')->get();
        $members      = Member::where('slider_show','1')->get();
        $articles     = Article::orderBy('id','desc')->limit(6)->get();
        $services     = Service::where('parent_id', Null)->limit(6)->get();

        // SEO Trait
        $this->staticPagesSeo(
            'Home',
            'Precision Accounting Intl LLC provides professional services in the Tri-State Area and specialize in helping and guiding business owners',
            'tax services,Tax,cpa firms,LLC,LLP,CPA,IRS,NJ,new jersey,clifton,consulting firms,consulting services,payroll,taxes 2021,consulting services,business,cpa business,precision accounting'
        );

        return view('home' , compact('testimonials', 'members','articles','services'));
    }
}
