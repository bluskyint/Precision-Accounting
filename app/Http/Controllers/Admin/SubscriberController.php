<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Http\Requests\Subscribers\StoreResourceRequest;
use App\Http\Requests\Subscribers\UpdateResourceRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the subscriber.
     *
     * @return \Illuminate\Http\Response
     */
    public function perPage( $num=10 )
    {
        // Dynamic pagination
        $subscribers = Subscriber::orderBy('id','desc')->paginate( $num );
        return view("admin.subscriber.index",compact("subscribers"));
    }


    /**
     * Display a listing of the subscriber.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscribers = Subscriber::orderBy('id','desc')->paginate( 10 );
        return view("admin.subscriber.index",compact("subscribers"));
    }


    public function destroy($id)
    {
        // find id in Db With Error 404
        $subscriber = Subscriber::findOrFail($id);

        // Delete Record from DB
        try {
            $delete = $subscriber->delete();
                return redirect() -> route("admin.subscriber.index")-> with( [ "success" => " Subscriber deleted successfully"] ) ;
            if(!$delete)
                return redirect() -> route("admin.subscriber.index")-> with( [ "failed" => "Error at delete opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> route("admin.subscriber.index")-> with( [ "failed" => "Error at delete opration"] ) ;
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

        $subscribers = Subscriber::where('email', 'like', "%{$request->search}%")->paginate( 10 );
        return view("admin.subscriber.index",compact("subscribers"));

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
                $delete = Subscriber::destroy( $request->id );
                    return redirect() -> route("admin.subscriber.index")-> with( [ "success" => " Subscribers deleted successfully"] ) ;
                if(!$delete)
                    return redirect() -> route("admin.subscriber.index")-> with( [ "failed" => "Error at delete opration"] ) ;
            } catch (\Exception $e) {
                return redirect() -> route("admin.subscriber.index")-> with( [ "failed" => "Error at delete opration"] ) ;
            }
        }

    }


}
