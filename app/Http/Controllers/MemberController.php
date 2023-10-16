<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Member;
use App\Models\Page;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;
use App\Traits\SEOTrait;

class MemberController extends Controller
{
    use SEOTrait;

    public function index()
    {
        $members   = Member::get();
        $page = Page::where('name', 'members')->first();

        // SEO Trait
        $this->dynamicPagesSeo($page);

        return view('team',compact('members', 'page'));

    }


    public function show(Member $team_member)
    {
        // SEO Trait
        $this->dynamicPagesSeo($team_member);

        return view('team_member',compact('team_member'));
    }

}
