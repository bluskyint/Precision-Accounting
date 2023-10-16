<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultingRequest;
use App\Mail\ConsultingMail;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Traits\SEOTrait;
use App\Traits\AirtableTrait;

class ConsultingController extends Controller
{
    use SEOTrait, AirtableTrait;

    CONST RECIVER_MAIL   = 'a.ismael@bluskyint.com' ;
    CONST MAIL_SUBJECT   = 'A new consulting submition at cpapai.com' ;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $page = Page::where('name', 'consulting')->first();

        // SEO Trait
        $this->dynamicPagesSeo($page);

        return view('consulting', compact('page'));
    }



    public function send(ConsultingRequest $request )
    {

        // Table ID To insert Data
        $tableId = 'tblBEvJHFw5lGoqT2';

        // Data Of Row to send to Airtable
        $data = [
            'fields' => [
                'First Name'       => $request->input('first_name'),
                'Last Name'        => $request->input('last_name'),
                'Phone Number'     => $request->input('phone'),
                'Email'            => $request->input('email'),
                'Address'          => $request->input('address'),
                'Business Service' => $request->input('business_service'),
                'Business Type'    => $request->input('business_type'),
                'State'            => $request->input('state'),
                'Meeting Type'     => $request->input('meeting'),
                'Message'          => $request->input('message'),
            ],
        ];

        return $this->insertNewRow($tableId, $data);

    }
}
