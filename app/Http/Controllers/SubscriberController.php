<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Http\Requests\StoreSubscriberRequest;
use App\Http\Requests\UpdateSubscriberRequest;

class SubscriberController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubscriberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubscriberRequest $request)
    {

        // save all request in one variable
        $requestData = $request->all();


        // Store in DB
        try {
            $resource = Subscriber::create( $requestData );
                return view("submission");
            if(!$resource)
                return Subscriber::back()-> with( [ "failed" => "Error at store opration"] ) ;
        } catch (\Exception $e) {
            return Subscriber::back()-> with( [ "failed" => "Error at store opration"] ) ;
        }
    }

}
