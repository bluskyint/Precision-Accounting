<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Http\Requests\Services\StoreServiceRequest;
use App\Http\Requests\Services\UpdateServiceRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of the service.
     *
     * @return \Illuminate\Http\Response
     */
    public function perPage( $num=10 )
    {
        // Dynamic pagination
        $services = Service::orderBy('id','desc')->paginate( $num );
        return view("admin.service.index",compact("services"));
    }


    /**
     * Display a listing of the service.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::orderBy('id','desc')->paginate( 10 );
        return view("admin.service.index",compact("services"));
    }

    /**
     * Show the form for creating a new service.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::select('id','title')->get();
        return view("admin.service.create",compact("services"));
    }

    /**
     * Store a newly created service in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceRequest $request)
    {

        // save all request in one variable
        $requestData = $request->all();

        // Create img name
        $img_extention = $request -> img -> getClientOriginalExtension();
        $img_name = rand(1000000,10000000) . "." . $img_extention;   // name => 32632.png

        // Create icon name
        $icon_extention = $request -> icon -> getClientOriginalExtension();
        $icon_name = rand(1000000,10000000) . "." . $icon_extention;   // name => 3623628.png

        // Path
        $path = "images/services" ;

        // Upload
        $request -> img -> move( $path , $img_name );
        $request -> icon  -> move( $path , $icon_name );


        // Add images names in request array
        $requestData['img']  = $img_name;
        $requestData['icon'] = $icon_name;


        // add slug in $requestData Array
        $requestData += [ 'slug' => Str::slug( $request->title , '-') ];


        // return $requestData;

        // Store in DB
        try {
            $service = Service::create( $requestData );
                return redirect() -> route("admin.service.index")-> with( [ "success" => " Service store successfully"] ) ;
            if(!$service)
                return redirect() -> route("admin.service.index")-> with( [ "failed" => "Error at store opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> route("admin.service.index")-> with( [ "failed" => "Error at store opration"] ) ;
        }

    }

    /**
     * Display the specified service.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // find id in Db With Error 404
        $service = Service::findOrFail($id);
        return view("admin.service.show" , compact("service") ) ;
    }

    /**
     * Show the form for editing the specified service.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find id in Db With Error 404
        $service = Service::findOrFail($id);

        $services = Service::select('id','title')->get();
        return view("admin.service.edit" , compact("service","services") ) ;

    }

    /**
     * Update the specified service in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceRequest $request, $id)
    {
        // find id in Db With Error 404
        $service = Service::findOrFail($id);

        // save all request in one variable
        $requestData = $request->all();
        // return $requestData;

        // Check If There Images Uploaded
        $path = "images/services" ;

        if( $request -> hasFile("icon") ){
            //  Upload image & Create name icon
            $icon_extention = $request -> icon -> getClientOriginalExtension();
            $icon_name = rand(1000000,10000000) . "." . $icon_extention;   // name => 3628.png
            $request -> icon -> move( $path , $icon_name );
        }else{
            $icon_name = $service->icon;
        }

        if( $request -> hasFile("img") ){
            //  Upload image & Create name img
            $img_extention = $request -> img -> getClientOriginalExtension();
            $img_name = rand(1000000,10000000) . "." . $img_extention;   // name => 3628.png
            $request -> img -> move( $path , $img_name );
        }else{
            $img_name = $service->img;
        }

        // Add images names in request array
        $requestData['img']  = $img_name;
        $requestData['icon'] = $icon_name;


        // add slug in $requestData Array
        $requestData += [ 'slug' => Str::slug( $request->title , '-') ];


        // return $requestData;

        // Update Record in DB
        try {
            $update = $service-> update( $requestData );
                return redirect() -> route("admin.service.index")-> with( [ "success" => " Service updated successfully"] ) ;
            if(!$update)
                return redirect() -> route("admin.service.index")-> with( [ "failed" => "Error at update opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> route("admin.service.index")-> with( [ "failed" => "Error at update opration"] ) ;
        }

    }

    /**
     * Remove the specified service from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find id in Db With Error 404
        $service = Service::findOrFail($id);

        // Delete Record from DB
        try {
            $delete = $service->delete();
                return redirect() -> route("admin.service.index")-> with( [ "success" => " Service deleted successfully"] ) ;
            if(!$delete)
                return redirect() -> route("admin.service.index")-> with( [ "failed" => "Error at delete opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> route("admin.service.index")-> with( [ "failed" => "Error at delete opration"] ) ;
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

        $services = Service::where('title', 'like', "%{$request->search}%")->paginate( 10 );
        return view("admin.service.index",compact("services"));

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
                $delete = Service::destroy( $request->id );
                    return redirect() -> route("admin.service.index")-> with( [ "success" => " Services deleted successfully"] ) ;
                if(!$delete)
                    return redirect() -> route("admin.service.index")-> with( [ "failed" => "Error at delete opration"] ) ;
            } catch (\Exception $e) {
                return redirect() -> route("admin.service.index")-> with( [ "failed" => "Error at delete opration"] ) ;
            }
        }

    }


}
