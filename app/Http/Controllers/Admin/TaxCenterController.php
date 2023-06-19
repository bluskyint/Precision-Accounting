<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaxCenter;
use App\Http\Requests\TaxCenters\StoreTaxCenterRequest;
use App\Http\Requests\TaxCenters\UpdateTaxCenterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class TaxCenterController extends Controller
{

/**
     * Display a listing of the tax_center.
     *
     * @return \Illuminate\Http\Response
     */
    public function perPage( $num=10 )
    {
        // Dynamic pagination
        $tax_centers = TaxCenter::orderBy('id','desc')->paginate( $num );
        return view("admin.tax_center.index",compact("tax_centers"));
    }


    /**
     * Display a listing of the tax_center.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tax_centers = TaxCenter::orderBy('id','desc')->paginate( 10 );
        return view("admin.tax_center.index",compact("tax_centers"));
    }

    /**
     * Show the form for creating a new tax_center.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.tax_center.create");
    }

    /**
     * Store a newly created tax_center in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaxCenterRequest $request)
    {

        // save all request in one variable
        $requestData = $request->all();

        //  Upload image & Create name img
        $file_extention = $request->img -> getClientOriginalExtension();
        $file_name = time() . "." . $file_extention;   // name => 3628.png
        $path = "images/tax_center" ;
        $request -> img -> move( $path , $file_name );
        // edit var img at $requestData Array
        $requestData['img'] = $file_name;


        // add slug in $requestData Array
        $requestData += [ 'slug' => Str::slug( $request->title , '-') ];


        // return $requestData;

        // Store in DB
        try {
            $tax_center = TaxCenter::create( $requestData );
                return redirect() -> route("admin.tax_center.index")-> with( [ "success" => " Tax Center store successfully"] ) ;
            if(!$tax_center)
                return redirect() -> route("admin.tax_center.index")-> with( [ "failed" => "Error at store opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> route("admin.tax_center.index")-> with( [ "failed" => "Error at store opration"] ) ;
        }

    }

    /**
     * Display the specified tax_center.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // find id in Db With Error 404
        $tax_center = TaxCenter::findOrFail($id);
        return view("admin.tax_center.show" , compact("tax_center") ) ;
    }

    /**
     * Show the form for editing the specified tax_center.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find id in Db With Error 404
        $tax_center = TaxCenter::findOrFail($id);
        return view("admin.tax_center.edit" , compact("tax_center") ) ;
    }

    /**
     * Update the specified tax_center in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaxCenterRequest $request, $id)
    {
        // find id in Db With Error 404
        $tax_center = TaxCenter::findOrFail($id);

        // save all request in one variable
        $requestData = $request->all();

        // Check If There img Uploaded
        if( $request-> hasFile("img") ){
            //  Upload image & Create name img
            $file_extention = $request->img -> getClientOriginalExtension();
            $file_name = time() . "." . $file_extention;   // name => 3628.png
            $path = "images/tax_center" ;
            $request->img -> move( $path , $file_name );
        }else{
            $file_name = $tax_center->img;
        }

        // Add img name to $requestData
        $requestData['img'] = $file_name;

        // add slug in $requestData Array
        $requestData += [ 'slug' => Str::slug( $request->title , '-') ];

        // return $requestData;

        // Update Record in DB
        try {
            $update = $tax_center-> update( $requestData );
                return redirect() -> route("admin.tax_center.index")-> with( [ "success" => " Tax Center updated successfully"] ) ;
            if(!$update)
                return redirect() -> route("admin.tax_center.index")-> with( [ "failed" => "Error at update opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> route("admin.tax_center.index")-> with( [ "failed" => "Error at update opration"] ) ;
        }

    }

    /**
     * Remove the specified tax_center from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find id in Db With Error 404
        $tax_center = TaxCenter::findOrFail($id);

        // Delete Record from DB
        try {
            $delete = $tax_center->delete();
                return redirect() -> route("admin.tax_center.index")-> with( [ "success" => " Tax Center deleted successfully"] ) ;
            if(!$delete)
                return redirect() -> route("admin.tax_center.index")-> with( [ "failed" => "Error at delete opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> route("admin.tax_center.index")-> with( [ "failed" => "Error at delete opration"] ) ;
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

        $tax_centers = TaxCenter::where('title', 'like', "%{$request->search}%")->paginate( 10 );
        return view("admin.tax_center.index",compact("tax_centers"));

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
                $delete = TaxCenter::destroy( $request->id );
                    return redirect() -> route("admin.tax_center.index")-> with( [ "success" => " Tax Center deleted successfully"] ) ;
                if(!$delete)
                    return redirect() -> route("admin.tax_center.index")-> with( [ "failed" => "Error at delete opration"] ) ;
            } catch (\Exception $e) {
                return redirect() -> route("admin.tax_center.index")-> with( [ "failed" => "Error at delete opration"] ) ;
            }
        }

    }

}
