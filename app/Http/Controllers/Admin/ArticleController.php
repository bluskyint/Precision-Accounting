<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Articles\MultiActionArticlesRequest;
use App\Models\Author;
use App\Traits\StoreFileTrait;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\Articles\StoreArticleRequest;
use App\Http\Requests\Articles\UpdateArticleRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    use StoreFileTrait;

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
            $requestData['img'] = $this->storeFile('articles', $request->title, $request->file('img'));
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

        try {
            if ($request->hasFile('img')) {
                Storage::disk('public')->delete("articles/$article->img");
                $requestData['img'] = $this->storeFile('articles', $request->title, $request->file('img'));
            }

            if ($article->title !== $request->validated('title') && !$request->hasFile('img')) {
                $new_file_name = Str::slug($request->validated('title')) . '.' . Str::afterLast($article->img, '.');
                rename("storage/articles/$article->img", "storage/articles/$new_file_name");
                $requestData['img'] = $new_file_name;
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
            Storage::disk('public')->delete("articles/$article->img");
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
                    Storage::disk('public')->delete("articles/$article->img");
                }
            }

            return to_route("admin.article.index")->with(["success" => "Article deleted successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.article.index")->with("failed","Error at delete operation");
        }
    }


}
