<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Member;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;
use App\Traits\SEOTrait;

class MemberController extends Controller
{
    use SEOTrait;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function index()
    {
        $members   = Member::get();

        // SEO Trait
        $this->staticPagesSeo(
            'Precision Accounting Team',
            'For many years PRECISION ACCOUNTING has been helping individuals, families and small businesses in the community prepare their taxes',
            'Digital switching over, How tax planning matters,Payroll management,Qbooks,How COVID-19 affected the IRS,CPA from A to Z part two,CPA from A to Z'
        );


        return view('member',compact('members'));

    }


}
