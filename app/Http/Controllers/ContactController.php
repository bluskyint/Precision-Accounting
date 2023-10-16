<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use App\Traits\SEOTrait;
use App\Traits\AirtableTrait;

class ContactController extends Controller
{
    use SEOTrait, AirtableTrait;

    CONST RECIVER_MAIL   = 'a.ismael@bluskyint.com' ;
    CONST MAIL_SUBJECT   = 'A new contact submition at cpapai.com' ;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $setting      = Setting::find(1);
        $page = Page::where('name', 'contact us')->first();

        // SEO Trait
        $this->dynamicPagesSeo($page);

        return view('contact',compact('setting', 'page'));
    }


    public function send(ContactRequest $request)
    {
        // Table ID To insert Data
        $tableId = 'tblyUEwm5ogHw8uW1';

        // Data Of Row to send to Airtable
        $data = [
            'fields' => [
                'Name'         => $request->input('name'),
                'Phone Number' => $request->input('phone'),
                'Email'        => $request->input('email'),
                'Message'      => $request->input('message'),
            ],
        ];

        return $this->insertNewRow($tableId, $data);
    }


}
