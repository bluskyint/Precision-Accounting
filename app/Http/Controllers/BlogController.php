<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;
use App\Traits\SEOTrait;

class BlogController extends Controller
{
    use SEOTrait;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $articles        = Article::orderBy('id','desc')->get();
        $categories      = Category::all();
        $lasted_articles = Article::orderBy('id','desc')->limit(5)->get();
        $pinned_articles = Article::where('pinned','1')->orderBy('id','desc')->limit(4)->get();
        $page = Page::where('name', 'blog')->first();

        // SEO Trait
        $this->dynamicPagesSeo($page);


        return view('blog',compact('categories','lasted_articles','articles','pinned_articles', 'page'));
    }

    public function article(Article $article)
    {
        $categories = Category::all();

        // SEO Trait
        $this->dynamicPagesSeo($article);

        return view('article',compact('article','categories'));
    }

    public function search(Request $request)
    {
        // validate search and redirect back
        $this->validate($request, [
            'search'     =>  ['required', 'string', 'max:55'],
        ]);

        $articles = Article::where('title', 'like', "%{$request->search}%")->paginate( 20 );
        $categories      = Category::all();
        $lasted_articles = Article::orderBy('id','desc')->limit(5)->get();
        return view('blog',compact('categories','lasted_articles','articles'));

    }


}
