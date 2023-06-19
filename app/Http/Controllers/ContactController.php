<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use App\Traits\SEOTrait;

class ContactController extends Controller
{
    use SEOTrait;

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

        // SEO Trait
        $this->staticPagesSeo(
            'Contact Us',
            'For many years PRECISION ACCOUNTING has been helping individuals, families and small businesses in the community prepare their taxes',
            'tax services,Tax,cpa firms,LLC,LLP,CPA,IRS,NJ,new jersey,clifton,consulting firms,consulting services,payroll,taxes 2021,consulting services,business,cpa business,precision accounting'
        );

        return view('contact',compact('setting'));
    }


    public function send(ContactRequest $request)
    {
        $contactData = $request->all();
        $contactData += ['subject' => static::MAIL_SUBJECT ];
        Mail::to(static::RECIVER_MAIL)->            // Our Email 'reciver'
            send( new ContactMail( $contactData ) );

        return view('submission');
    }


}
