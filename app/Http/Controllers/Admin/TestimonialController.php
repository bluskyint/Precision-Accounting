<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use App\Http\Requests\Testimonials\StoreTestimonialRequest;
use App\Http\Requests\Testimonials\UpdateTestimonialRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the testimonial.
     *
     * @return \Illuminate\Http\Response
     */
    public function perPage( $num=10 )
    {
        // Dynamic pagination
        $testimonials = Testimonial::orderBy('id','desc')->paginate( $num );
        return view("admin.testimonial.index",compact("testimonials"));
    }


    /**
     * Display a listing of the testimonial.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::orderBy('id','desc')->paginate( 10 );
        return view("admin.testimonial.index",compact("testimonials"));
    }

    /**
     * Show the form for creating a new testimonial.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.testimonial.create");
    }

    /**
     * Store a newly created testimonial in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTestimonialRequest $request)
    {

        // save all request in one variable
        $requestData = $request->all();


        //  Upload image & Create name img
        $file_extention = $request->img -> getClientOriginalExtension();
        $file_name = time() . "." . $file_extention;   // name => 3628.png
        $path = "images/testimonials" ;
        $request -> img -> move( $path , $file_name );
        // edit var img at $requestData Array
        $requestData['img'] = $file_name;

        // return $requestData;

        // Store in DB
        try {
            $testimonial = Testimonial::create( $requestData );
                return redirect() -> route("admin.testimonial.index")-> with( [ "success" => " Testimonial store successfully"] ) ;
            if(!$testimonial)
                return redirect() -> route("admin.testimonial.index")-> with( [ "failed" => "Error at store opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> route("admin.testimonial.index")-> with( [ "failed" => "Error at store opration"] ) ;
        }

    }

    /**
     * Display the specified testimonial.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // find id in Db With Error 404
        $testimonial = Testimonial::findOrFail($id);
        return view("admin.testimonial.show" , compact("testimonial") ) ;
    }

    /**
     * Show the form for editing the specified testimonial.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find id in Db With Error 404
        $testimonial = Testimonial::findOrFail($id);
        return view("admin.testimonial.edit" , compact("testimonial") ) ;
    }

    /**
     * Update the specified testimonial in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTestimonialRequest $request, $id)
    {
        // find id in Db With Error 404
        $testimonial = Testimonial::findOrFail($id);

        // save all request in one variable
        $requestData = $request->all();

        // Check If There img Uploaded
        if( $request-> hasFile("img") ){
            //  Upload image & Create name img
            $file_extention = $request->img -> getClientOriginalExtension();
            $file_name = time() . "." . $file_extention;   // name => 3628.png
            $path = "images/testimonials" ;
            $request->img -> move( $path , $file_name );
        }else{
            $file_name = $testimonial->img;
        }

        // Add img name to $requestData
        $requestData['img'] = $file_name;

        // return $requestData;

        // Update Record in DB
        try {
            $update = $testimonial-> update( $requestData );
                return redirect() -> route("admin.testimonial.index")-> with( [ "success" => " Testimonial updated successfully"] ) ;
            if(!$update)
                return redirect() -> route("admin.testimonial.index")-> with( [ "failed" => "Error at update opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> route("admin.testimonial.index")-> with( [ "failed" => "Error at update opration"] ) ;
        }

    }

    /**
     * Remove the specified testimonial from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find id in Db With Error 404
        $testimonial = Testimonial::findOrFail($id);

        // Delete Record from DB
        try {
            $delete = $testimonial->delete();
                return redirect() -> route("admin.testimonial.index")-> with( [ "success" => " Testimonial deleted successfully"] ) ;
            if(!$delete)
                return redirect() -> route("admin.testimonial.index")-> with( [ "failed" => "Error at delete opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> route("admin.testimonial.index")-> with( [ "failed" => "Error at delete opration"] ) ;
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

        $testimonials = Testimonial::where('name', 'like', "%{$request->search}%")->paginate( 10 );
        return view("admin.testimonial.index",compact("testimonials"));

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
                $delete = Testimonial::destroy( $request->id );
                    return redirect() -> route("admin.testimonial.index")-> with( [ "success" => " Testimonials deleted successfully"] ) ;
                if(!$delete)
                    return redirect() -> route("admin.testimonial.index")-> with( [ "failed" => "Error at delete opration"] ) ;
            } catch (\Exception $e) {
                return redirect() -> route("admin.testimonial.index")-> with( [ "failed" => "Error at delete opration"] ) ;
            }
        }

        // If Action is visible
        if( $request->action == "visible" ){
            try {
                $visible = Testimonial::whereIn('id', $request->id )->update([ 'visibility' => '1' ]);
                return redirect() -> route("admin.testimonial.index")-> with( [ "success" => " Testimonials deleted successfully"] ) ;
                if(!$visible)
                return redirect() -> route("admin.testimonial.index")-> with( [ "failed" => "Error at delete opration"] ) ;
            } catch (\Exception $e) {
                return redirect() -> route("admin.testimonial.index")-> with( [ "failed" => "Error at delete opration"] ) ;
            }
        }

        // If Action is invisible
        if( $request->action == "invisible" ){
            try {
                $invisible = Testimonial::whereIn('id', $request->id )->update([ 'visibility' => '0' ]);
                return redirect() -> route("admin.testimonial.index")-> with( [ "success" => " Testimonials deleted successfully"] ) ;
                if(!$invisible)
                return redirect() -> route("admin.testimonial.index")-> with( [ "failed" => "Error at delete opration"] ) ;
            } catch (\Exception $e) {
                return redirect() -> route("admin.testimonial.index")-> with( [ "failed" => "Error at delete opration"] ) ;
            }
        }

    }

}
