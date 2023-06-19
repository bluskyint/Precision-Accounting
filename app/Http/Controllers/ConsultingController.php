<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultingRequest;
use App\Mail\ConsultingMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Traits\SEOTrait;

class ConsultingController extends Controller
{
    use SEOTrait;

    CONST RECIVER_MAIL   = 'a.ismael@bluskyint.com' ;
    CONST MAIL_SUBJECT   = 'A new consulting submition at cpapai.com' ;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // SEO Trait
        $this->staticPagesSeo(
            'Free Consulting',
            'For many years PRECISION ACCOUNTING has been helping individuals, families and small businesses in the community prepare their taxes',
            'tax services,Tax,cpa firms,LLC,LLP,CPA,IRS,NJ,new jersey,clifton,consulting firms,consulting services,payroll,taxes 2021,consulting services,business,cpa business,precision accounting'
        );

        return view('consulting');
    }



    public function send(ConsultingRequest $request )
    {
        $consultingData = $request->all();
        $consultingData += ['subject' => static::MAIL_SUBJECT ];
        Mail::to(static::RECIVER_MAIL)->            // Our Email 'reciver'
            send( new ConsultingMail( $consultingData ) );
            return view('submission');
    }






}
