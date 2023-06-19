<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Article;
use App\Models\Member;
use App\Models\Service;
use App\Models\Resource;
use App\Models\TaxCenter;
use App\Models\Testimonial;
use App\Models\Subscriber;
use App\Models\Newsletter;

class DashboardController extends Controller
{

    public function index()
    {

        $articles = Article::count();
        $members = Member::count();
        $services = Service::count();
        $resources = Resource::count();
        $tax_centers = TaxCenter::count();
        $testimonials = Testimonial::count();
        $subscribers = Subscriber::count();
        $newsletter = Newsletter::count();

        return view('admin.dashboard',
            compact('articles', 'members', 'services',
            'resources', 'tax_centers', 'testimonials', 'subscribers', 'newsletter'));

    }

}
