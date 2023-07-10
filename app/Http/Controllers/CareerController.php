<?php

namespace App\Http\Controllers;

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
        // SEO Trait
        $this->staticPagesSeo(
            'Career',
            'For many years PRECISION ACCOUNTING has been helping individuals, families and small businesses in the community prepare their taxes',
            'tax services,Tax,cpa firms,LLC,LLP,CPA,IRS,NJ,new jersey,clifton,consulting firms,consulting services,payroll,taxes 2021,consulting services,business,cpa business,precision accounting'
        );

        return view('career');
    }



}
