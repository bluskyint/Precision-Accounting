<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function perPage( $num=10 )
    {
        // Dynamic pagination
        $categories = Category::orderBy('id','desc')->paginate( $num );
        return view("admin.category.index",compact("categories"));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id','desc')->paginate( 10 );
        return view("admin.category.index",compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.category.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {

        // save all request in one variable
        $requestData = $request->all();


        // add slug in $requestData Array
        $requestData += [ 'slug' => Str::slug( $request->title , '-') ];


        // return $requestData;
        // Store in DB
        try {
            $category = Category::create( $requestData );
                return  redirect() -> route("admin.category.index")-> with( [ "success" => " Category store successfully"] ) ;
            if(!$category)
                return  redirect() -> route("admin.category.index")-> with( [ "failed" => "Error at store opration"] ) ;
        } catch (\Exception $e) {
            return  redirect() -> route("admin.category.index")-> with( [ "failed" => "Error at store opration"] ) ;
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
        $category = Category::findOrFail($id);
        return view("admin.category.show" , compact("category") ) ;
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
        $category = Category::findOrFail($id);
        return view("admin.category.edit" , compact("category") ) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        // find id in Db With Error 404
        $category = Category::findOrFail($id);

        // save all request in one variable
        $requestData = $request->all();

        // add slug in $requestData Array
        $requestData += [ 'slug' => Str::slug( $request->title , '-') ];

        // return $requestData;

        // Update Record in DB
        try {
            $update = $category-> update( $requestData );
                return redirect() -> route("admin.category.index")-> with( [ "success" => " Category updated successfully"] ) ;
            if(!$update)
                return redirect() -> route("admin.category.index")-> with( [ "failed" => "Error at update opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> route("admin.category.index")-> with( [ "failed" => "Error at update opration"] ) ;
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
        $category = Category::findOrFail($id);

        // Delete Record from DB
        try {
            $delete = $category->delete();
                return redirect() -> route("admin.category.index")-> with( [ "success" => " Category deleted successfully"] ) ;
            if(!$delete)
                return redirect() -> route("admin.category.index")-> with( [ "failed" => "Error at delete opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> route("admin.category.index")-> with( [ "failed" => "Error at delete opration"] ) ;
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

        $categories = Category::where('title', 'like', "%{$request->search}%")->paginate( 10 );
        return view("admin.category.index",compact("categories"));

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
                $delete = Category::destroy( $request->id );
                    return redirect() -> route("admin.category.index")-> with( [ "success" => " Categories deleted successfully"] ) ;
                if(!$delete)
                    return redirect() -> route("admin.category.index")-> with( [ "failed" => "Error at delete opration"] ) ;
            } catch (\Exception $e) {
                return redirect() -> route("admin.category.index")-> with( [ "failed" => "Error at delete opration"] ) ;
            }
        }

    }


}
