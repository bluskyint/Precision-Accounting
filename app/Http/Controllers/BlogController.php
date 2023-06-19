<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
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
        $articles        = Article::orderBy('id','desc')->paginate(8);
        $categories      = Category::all();
        $lasted_articles = Article::orderBy('id','desc')->limit(5)->get();
        $pinned_articles = Article::where('pinned','1')->orderBy('id','desc')->limit(4)->get();
        // return $articles;

        // SEO Trait
        $this->staticPagesSeo(
            'Blog',
            'For many years PRECISION ACCOUNTING has been helping individuals, families and small businesses in the community prepare their taxes',
            'Digital switching over, How tax planning matters,Payroll management,Qbooks,How COVID-19 affected the IRS,CPA from A to Z part two,CPA from A to Z'
        );


        return view('blog',compact('categories','lasted_articles','articles','pinned_articles'));
    }

    public function article($slug)
    {
        $categories      = Category::all();
        $article = Article::where('slug',$slug)->first();
        // if article Not Found
        if( !$article ){
            return redirect('/');
        }

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
