<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Traits\SEOTrait;

class AuthorController extends Controller
{
    use SEOTrait;

    public function index()
    {
        $authors   = Author::all();

        // SEO Trait
        $this->staticPagesSeo(
            'Precision Accounting Authors',
            'For many years PRECISION ACCOUNTING has been helping individuals, families and small businesses in the community prepare their taxes',
            'Digital switching over, How tax planning matters,Payroll management,Qbooks,How COVID-19 affected the IRS,CPA from A to Z part two,CPA from A to Z'
        );

        return view('authors',compact('authors'));

    }


    public function show(Author $author)
    {
        return view('author',compact('author'));
    }

}