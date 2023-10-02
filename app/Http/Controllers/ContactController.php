<?php

namespace App\Http\Controllers;

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
