<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsletter;
use App\Http\Requests\StoreNewsletterRequest;
use App\Mail\NewsletterMail;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


class NewsletterController extends Controller
{
    /**
     * Display a listing of the newsletter.
     *
     * @return \Illuminate\Http\Response
     */
    public function perPage( $num=10 )
    {
        // Dynamic pagination
        $newsletters = Newsletter::orderBy('id','desc')->paginate( $num );
        return view("admin.newsletter.index",compact("newsletters"));
    }


    /**
     * Display a listing of the newsletter.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsletters = Newsletter::orderBy('id','desc')->paginate( 10 );
        return view("admin.newsletter.index",compact("newsletters"));
    }

    /**
     * Show the form for creating a new newsletter.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.newsletter.create");
    }

    /**
     * Store a newly created newsletter in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsletterRequest $request)
    {

        // save all request in one variable
        $requestData = $request->all();

        // Get All Subscribers
        $subscribers = Subscriber::pluck('email')->toArray();


        // Send Mail
        Mail::to($subscribers)->            // Our Email 'reciver'
        send( new NewsletterMail( $requestData ) );

        // Store in DB
        try {
            $newsletter = Newsletter::create( $requestData );
                return redirect() -> route("admin.newsletter.index")-> with( [ "success" => "Newsletter sent successfully"] ) ;
            if(!$newsletter)
            return redirect() -> route("admin.newsletter.index")-> with( [ "failed" => "Error at sent opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> route("admin.newsletter.index")-> with( [ "failed" => "Error at sent opration"] ) ;
        }

    }

    /**
     * Display the specified newsletter.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // find id in Db With Error 404
        $newsletter = Newsletter::findOrFail($id);
        return view("admin.newsletter.show" , compact("newsletter") ) ;
    }



    /**
     * Remove the specified newsletter from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find id in Db With Error 404
        $newsletter = Newsletter::findOrFail($id);

        // Delete Record from DB
        try {
            $delete = $newsletter->delete();
                return redirect() -> route("admin.newsletter.index")-> with( [ "success" => " Newsletter deleted successfully"] ) ;
            if(!$delete)
                return redirect() -> route("admin.newsletter.index")-> with( [ "failed" => "Error at delete opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> route("admin.newsletter.index")-> with( [ "failed" => "Error at delete opration"] ) ;
        }
    }



    /**
     * search in record.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // validate search and redirect back
        $this->validate($request, [
            'search'     =>  ['required', 'string', 'max:55'],
        ]);

        $newsletters = Newsletter::where('subject', 'like', "%{$request->search}%")->paginate( 10 );
        return view("admin.newsletter.index",compact("newsletters"));

    }



    public function multiAction(Request $request)
    {

        // Validator at action
        $validator = Validator::make($request->all(),[
            "action" => 'required | string',
        ]);

        // Check If request->id exist
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        // Check If request->id exist & add validation Msg
        if( !$request->has('id') ){
            $validator->getMessageBag()->add('action', 'Please select rows..');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // If Action is Delete
        if( $request->action == "delete" ){
            try {
                $delete = Newsletter::destroy( $request->id );
                    return redirect() -> route("admin.newsletter.index")-> with( [ "success" => " Newsletters deleted successfully"] ) ;
                if(!$delete)
                    return redirect() -> route("admin.newsletter.index")-> with( [ "failed" => "Error at delete opration"] ) ;
            } catch (\Exception $e) {
                return redirect() -> route("admin.newsletter.index")-> with( [ "failed" => "Error at delete opration"] ) ;
            }
        }

    }


}
