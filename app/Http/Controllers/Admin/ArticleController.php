<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Articles\MultiActionArticlesRequest;
use App\Models\User;
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

    public function __construct()
    {
        $this->middleware('permission:Show Articles')->only(['perPage', 'index', 'show', 'search']);
        $this->middleware('permission:Add Articles')->only(['create', 'store']);
        $this->middleware('permission:Edit Articles')->only(['edit', 'update']);
        $this->middleware('permission:Delete Articles')->only(['destroy', 'multiAction']);
        $this->middleware('permission:Show Articles Trash')->only(['getTrash']);
        $this->middleware('permission:Restore Articles')->only(['restore']);
        $this->middleware('permission:ForceDelete Articles')->only(['forceDelete']);
    }

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

        $articles = Article::with('author')->latest()->paginate(10);
        return view("admin.article.index", compact("articles","categoriesCount"));
    }

    public function getTrash()
    {
        $articles = Article::onlyTrashed()->with('author')->latest('deleted_at')->paginate(10);
        return view("admin.article.index", compact("articles"));
    }

    public function create()
    {
        $categories = Category::select('id','title')->get();
        $authors = User::whereRelation('roles', 'name', 'Author')->select('id', 'name')->get();
        return view("admin.article.create",compact('categories', 'authors'));
    }

    public function store(StoreArticleRequest $request)
    {
        try {
            $requestData = $request->validated();
            $folderName = $requestData['slug'];
            $requestData['img']['src'] = $this->storeImage($request->file('img'), 'articles', $folderName);
            $requestData['content'] = $this->moveContentImages($requestData['content'], "articles/$folderName");

            Article::create($requestData);

            return to_route("admin.article.index")->with("success", "Article store successfully");

        } catch (\Exception $e) {
            return to_route("admin.article.index")->with("failed", "Error at store operation");
        }
    }

    public function show(string $id)
    {
        $article = Article::withTrashed()->with('author')->where('id', $id)->first();
        $isArticleTrashed = $article->trashed();
        return view("admin.article.show", compact("article", "isArticleTrashed"));
    }

    public function edit(Article $article)
    {
        $article->load('author');
        $categories = Category::select('id','title')->get();
        $authors = User::whereRelation('roles', 'name', 'Author')->select('id', 'name')->get();
        return view("admin.article.edit", compact("article","categories", "authors"));
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        $requestData = $request->validated();
        $requestData['img']['src'] = $article->img['src'];

        try {
            $folderName = $requestData['slug'];

            if ($folderName !== $article->slug) {
                rename("storage/articles/$article->slug", "storage/articles/$folderName");
            }

            if ($request->hasFile('img')) {
                $requestData['img']['src'] = $this->storeImage($request->file('img'),'articles', $folderName);
                Storage::disk('public')->delete("articles/$folderName/".$article->img['src']);
            }

//            if (Str::contains($requestData['content'], '/tempContentImages/')) {
//                $requestData['content'] = $this->moveContentImages($requestData['content'], "articles/$folderName");
//            }

            $article->update($requestData);

            return to_route("admin.article.index")->with("success", "Article updated successfully");

        } catch (\Exception $e) {
            return to_route("admin.article.index")->with("failed", "Error at update operation");
        }
    }

    public function delete(Article $article)
    {
        try {
            $article->delete();

            return to_route("admin.article.index")->with(["success" => "Article deleted successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.article.index")->with("failed","Error at delete operation");
        }
    }

    public function restore(string $id)
    {
        try {
            Article::withTrashed()->where('id', $id)->restore();

            return to_route("admin.article.index")->with(["success" => "Article restored successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.article.index")->with("failed","Error at restore operation");
        }
    }

    public function forceDelete(string $id)
    {
        try {
            $article = Article::withTrashed()->where('id', $id)->first();
            Storage::disk('public')->deleteDirectory("articles/".$article['slug']);
            $article->forceDelete();

            return to_route("admin.article.index")->with(["success" => "Article destroyed successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.article.index")->with("failed","Error at destroyed operation");
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
            $articles = Article::withTrashed()->findOrFail($request->id);

            if ($request->action === "delete") {
                foreach ($articles as $article) {
                    $article->delete();
                }
            } elseif ($request->action === "restore") {
                if (auth()->user()->hasPermissionTo('Restore Articles')) {
                    foreach ($articles as $article) {
                        $article->restore();
                    }
                } else {
                    abort('403', 'USER DOES NOT HAVE THE RIGHT PERMISSIONS.');
                }
            } elseif ($request->action === "forceDelete") {
                if (auth()->user()->hasPermissionTo('ForceDelete Articles')) {
                    foreach ($articles as $article) {
                        Storage::disk('public')->deleteDirectory("articles/$article->slug/");
                        $article->forceDelete();
                    }
                } else {
                    abort('403', 'USER DOES NOT HAVE THE RIGHT PERMISSIONS.');
                }
            }

            return to_route("admin.article.index")->with(["success" => "Article deleted successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.article.index")->with("failed","Error at delete operation");
        }
    }
}
