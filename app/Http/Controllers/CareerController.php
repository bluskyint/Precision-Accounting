<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use App\Traits\SEOTrait;

class CareerController extends Controller
{
    use SEOTrait;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $page = Page::where('name', 'career')->first();

        // SEO Trait
        $this->dynamicPagesSeo($page);

        return view('career', compact('page'));
    }



}
