<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resource;
use App\Http\Requests\Resources\StoreResourceRequest;
use App\Http\Requests\Resources\UpdateResourceRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function perPage( $num=10 )
    {
        // Dynamic pagination
        $resources = Resource::orderBy('id','desc')->paginate( $num );
        return view("admin.resource.index",compact("resources"));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resources = Resource::orderBy('id','desc')->paginate( 10 );
        return view("admin.resource.index",compact("resources"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.resource.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResourceRequest $request)
    {

        // save all request in one variable
        $requestData = $request->all();


        //  Upload image & Create name img
        $file_extention = $request->img -> getClientOriginalExtension();
        $file_name = time() . "." . $file_extention;   // name => 3628.png
        $path = "images/resources" ;
        $request -> img -> move( $path , $file_name );
        // edit var img at $requestData Array
        $requestData['img'] = $file_name;

        // return $requestData;

        // Store in DB
        try {
            $resource = Resource::create( $requestData );
                return redirect() -> route("admin.resource.index")-> with( [ "success" => " Resource store successfully"] ) ;
            if(!$resource)
                return redirect() -> route("admin.resource.index")-> with( [ "failed" => "Error at store opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> route("admin.resource.index")-> with( [ "failed" => "Error at store opration"] ) ;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // find id in Db With Error 404
        $resource = Resource::findOrFail($id);
        return view("admin.resource.show" , compact("resource") ) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find id in Db With Error 404
        $resource = Resource::findOrFail($id);
        return view("admin.resource.edit" , compact("resource") ) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResourceRequest $request, $id)
    {
        // find id in Db With Error 404
        $resource = Resource::findOrFail($id);

        // save all request in one variable
        $requestData = $request->all();

        // Check If There img Uploaded
        if( $request-> hasFile("img") ){
            //  Upload image & Create name img
            $file_extention = $request->img -> getClientOriginalExtension();
            $file_name = time() . "." . $file_extention;   // name => 3628.png
            $path = "images/resources" ;
            $request->img -> move( $path , $file_name );
        }else{
            $file_name = $resource->img;
        }

        // Add img name to $requestData
        $requestData['img'] = $file_name;

        // return $requestData;

        // Update Record in DB
        try {
            $update = $resource-> update( $requestData );
                return redirect() -> route("admin.resource.index")-> with( [ "success" => " Resource updated successfully"] ) ;
            if(!$update)
                return redirect() -> route("admin.resource.index")-> with( [ "failed" => "Error at update opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> route("admin.resource.index")-> with( [ "failed" => "Error at update opration"] ) ;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find id in Db With Error 404
        $resource = Resource::findOrFail($id);

        // Delete Record from DB
        try {
            $delete = $resource->delete();
                return redirect() -> route("admin.resource.index")-> with( [ "success" => " Resource deleted successfully"] ) ;
            if(!$delete)
                return redirect() -> route("admin.resource.index")-> with( [ "failed" => "Error at delete opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> route("admin.resource.index")-> with( [ "failed" => "Error at delete opration"] ) ;
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

        $resources = Resource::where('title', 'like', "%{$request->search}%")->paginate( 10 );
        return view("admin.resource.index",compact("resources"));

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
                $delete = Resource::destroy( $request->id );
                    return redirect() -> route("admin.resource.index")-> with( [ "success" => " Resources deleted successfully"] ) ;
                if(!$delete)
                    return redirect() -> route("admin.resource.index")-> with( [ "failed" => "Error at delete opration"] ) ;
            } catch (\Exception $e) {
                return redirect() -> route("admin.resource.index")-> with( [ "failed" => "Error at delete opration"] ) ;
            }
        }

    }


}
