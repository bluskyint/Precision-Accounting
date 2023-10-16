<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\User;
use App\Traits\SEOTrait;

class AuthorController extends Controller
{
    use SEOTrait;

    public function index()
    {
        $authors   = User::whereRelation('roles', 'name', 'Author')->get();

        $page = Page::where('name', 'authors')->first();
        // SEO Trait
        $this->dynamicPagesSeo($page);

        return view('authors',compact('authors', 'page'));

    }


    public function show(User $author)
    {
        $author->load('articles');

        // SEO Trait
        $this->dynamicPagesSeo($author);

        return view('author',compact('author'));
    }

}
