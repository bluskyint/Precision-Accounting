<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authors\MultiActionAuthorsRequest;
use App\Http\Requests\Authors\StoreAuthorRequest;
use App\Http\Requests\Authors\UpdateAuthorRequest;
use App\Models\Author;
use App\Traits\StoreContentTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    use StoreContentTrait;
    public function perPage($num = 10)
    {
        // Dynamic pagination
        $authors = Author::orderBy('id', 'desc')->paginate($num);
        return view("admin.author.index", compact("authors"));
    }

    public function index()
    {
        $authors = Author::orderBy('id', 'desc')->paginate(10);
        return view("admin.author.index", compact("authors"));
    }

    public function create()
    {
        return view("admin.author.create");
    }

    public function store(StoreAuthorRequest $request)
    {
        try {
            $requestData = $request->validated();
            $requestData['img']['src'] = $this->storeImage($request->file('img'), 'authors');
            Author::create($requestData);

            return to_route("admin.author.index")->with("success", "Author store successfully");

        } catch (\Exception $e) {
            return to_route("admin.author.index")->with("failed", "Error at store operation");
        }
    }

    public function show($id)
    {
        // find id in Db With Error 404
        $author = Author::findOrFail($id);
        return view("admin.author.show", compact("author"));
    }

    public function edit(Author $author)
    {
        return view("admin.author.edit", compact("author"));
    }

    public function update(UpdateAuthorRequest $request, Author $author)
    {
        $requestData = $request->validated();
        $requestData['img']['src'] = $author->img['src'];

        try {
            if ($request->hasFile('img')) {
                Storage::disk('public')->delete("authors/".$author->img['src']);
                $requestData['img']['src'] = $this->storeImage($request->file('img'), 'authors');
            }

            $author->update($requestData);

            return to_route("admin.author.index")->with("success", "Author updated successfully");

        } catch (\Exception $e) {
            return to_route("admin.author.index")->with("failed", "Error at update operation");
        }
    }

    public function destroy(Author $author)
    {
        try {
            Storage::disk('public')->delete("authors/".$author->img['src']);
            $author->delete();

            return to_route("admin.author.index")->with(["success" => " Author deleted successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.author.index")->with("failed","Error at delete operation");
        }
    }

    public function search(Request $request)
    {
        // validate search and redirect back
        $this->validate($request, [
            'search' => ['required', 'string', 'max:55'],
        ]);

        $authors = Author::where('name', 'like', "%{$request->search}%")->paginate(10);
        return view("admin.author.index", compact("authors"));

    }


    public function multiAction(MultiActionAuthorsRequest $request)
    {
        try {
            // If Action is Delete
            if ($request->action === "delete") {
                $authors = Author::findOrFail($request->id);
                Author::destroy($request->id);
                foreach ($authors as $author) {
                    Storage::disk('public')->delete("authors/".$author->img['src']);
                }
            }

            return to_route("admin.author.index")->with("success", "Author deleted successfully");

        } catch (\Exception $e) {
            return to_route("admin.author.index")->with("failed", "Error at delete operation");
        }
    }
}
