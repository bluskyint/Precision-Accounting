<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pages\UpdatePageRequest;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('admin.pages', compact('pages'));
    }

    public function update(UpdatePageRequest $request, Page $page)
    {
        $page->update($request->validated());
        return back()->with([ "success" => "Page updated successfully"] );
    }
}
