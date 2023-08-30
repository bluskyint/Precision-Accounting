<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Articles\MultiActionArticlesRequest;
use App\Models\Author;
use App\Traits\StoreContentTrait;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\Articles\StoreArticleRequest;
use App\Http\Requests\Articles\UpdateArticleRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    use StoreContentTrait;

    public function perPage( $num=10 )
    {
        // Get Parent Rows Count
        $categoriesCount = Category::count();

        // Dynamic pagination
        $articles = Article::orderBy('id','desc')->paginate( $num );
        return view("admin.article.index",compact("articles","categoriesCount"));
    }

    public function index()
    {
        // Get Parent Rows Count
        $categoriesCount = Category::count();

        $articles = Article::with('author')->orderBy('id','desc')->paginate( 10 );
        return view("admin.article.index",compact("articles","categoriesCount"));
    }

    public function create()
    {
        $categories = Category::select('id','title')->get();
        $authors = Author::select('id', 'name')->get();
        return view("admin.article.create",compact('categories', 'authors'));
    }

    public function store(StoreArticleRequest $request)
    {
        try {
            $requestData = $request->validated();
            $folderName = Str::slug($requestData['title']);
            $requestData['img']['src'] = $this->storeImage($request->file('img'), 'articles', $folderName);
            $requestData['content'] = $this->moveContentImages($requestData['content'], "articles/$folderName");

            Article::create($requestData);

            return to_route("admin.article.index")->with("success", "Article store successfully");

        } catch (\Exception $e) {
            return to_route("admin.article.index")->with("failed", "Error at store operation");
        }
    }

    public function show($id)
    {
        // find id in Db With Error 404
        $article = Article::with('author')->findOrFail($id);
        return view("admin.article.show" , compact("article") ) ;
    }

    public function edit($id)
    {
        // find id in Db With Error 404
        $article = Article::with('author')->findOrFail($id);
        $categories = Category::select('id','title')->get();
        $authors = Author::select('id', 'name')->get();
        return view("admin.article.edit" , compact("article","categories", "authors") ) ;
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        $requestData = $request->validated();
        $requestData['img']['src'] = $article->img['src'];

        try {
            $folderName = Str::slug($requestData['title']);

            if ($request->hasFile('img')) {
                $requestData['img']['src'] = $this->storeImage($request->file('img'),'articles', $folderName);
                Storage::disk('public')->delete("articles/".$article->img['src']);
            }

            if (Str::contains($requestData['content'], '/tempContentImages/')) {
                $requestData['content'] = $this->moveContentImages($requestData['content'], "articles/$folderName");
            }

            $article->update($requestData);

            return to_route("admin.article.index")->with("success", "Article updated successfully");

        } catch (\Exception $e) {
            return to_route("admin.article.index")->with("failed", "Error at update operation");
        }
    }

    public function destroy(Article $article)
    {
        try {
            Storage::disk('public')->deleteDirectory("articles/".Str::slug($article->title));
            $article->delete();

            return to_route("admin.article.index")->with(["success" => "Article deleted successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.article.index")->with("failed","Error at delete operation");
        }
    }

    public function search(Request $request)
    {
        // validate search and redirect back
        $this->validate($request, [
            'search'     =>  ['required', 'string', 'max:55'],
        ]);

        $articles = Article::where('title', 'like', "%{$request->search}%")->paginate( 10 );
        return view("admin.article.index",compact("articles"));

    }



    public function multiAction(MultiActionArticlesRequest $request)
    {
        try {
            // If Action is Delete
            if ($request->action === "delete") {
                $articles = Article::findOrFail($request->id);
                Article::destroy($request->id);
                foreach ($articles as $article) {
                    Storage::disk('public')->deleteDirectory("articles/".Str::slug($article->title));
                }
            }

            return to_route("admin.article.index")->with(["success" => "Article deleted successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.article.index")->with("failed","Error at delete operation");
        }
    }


}
