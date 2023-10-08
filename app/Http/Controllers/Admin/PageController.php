<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('admin.pages', compact('pages'));
    }

    public function update(Request $request, Page $page)
    {
        $page->update($request->all());
        return back()->with([ "success" => "Page updated successfully"] );
    }
}
