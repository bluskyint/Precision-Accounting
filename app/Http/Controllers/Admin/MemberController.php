<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Http\Requests\Members\StoreMemberRequest;
use App\Http\Requests\Members\UpdateMemberRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    /**
     * Display a listing of the member.
     *
     * @return \Illuminate\Http\Response
     */
    public function perPage( $num=10 )
    {
        // Dynamic pagination
        $members = Member::orderBy('id','desc')->paginate( $num );
        return view("admin.member.index",compact("members"));
    }


    /**
     * Display a listing of the member.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::orderBy('id','desc')->paginate( 10 );
        return view("admin.member.index",compact("members"));
    }

    /**
     * Show the form for creating a new member.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.member.create");
    }

    /**
     * Store a newly created member in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMemberRequest $request)
    {

        // save all request in one variable
        $requestData = $request->all();


        //  Upload image & Create name img
        $file_extention = $request->img -> getClientOriginalExtension();
        $file_name = time() . "." . $file_extention;   // name => 3628.png
        $path = "images/members" ;
        $request -> img -> move( $path , $file_name );
        // edit var img at $requestData Array
        $requestData['img'] = $file_name;

        // return $requestData;

        // Store in DB
        try {
            $member = Member::create( $requestData );
                return  redirect() -> route("admin.member.index")->  with( [ "success" => " Member store successfully"] ) ;
            if(!$member)
                return  redirect() -> route("admin.member.index")->  with( [ "failed" => "Error at store opration"] ) ;
        } catch (\Exception $e) {
            return  redirect() -> route("admin.member.index")->  with( [ "failed" => "Error at store opration"] ) ;
        }

    }

    /**
     * Display the specified member.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // find id in Db With Error 404
        $member = Member::findOrFail($id);
        return view("admin.member.show" , compact("member") ) ;
    }

    /**
     * Show the form for editing the specified member.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find id in Db With Error 404
        $member = Member::findOrFail($id);
        return view("admin.member.edit" , compact("member") ) ;
    }

    /**
     * Update the specified member in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMemberRequest $request, $id)
    {
        // find id in Db With Error 404
        $member = Member::findOrFail($id);

        // save all request in one variable
        $requestData = $request->all();

        // Check If There img Uploaded
        if( $request-> hasFile("img") ){
            //  Upload image & Create name img
            $file_extention = $request->img -> getClientOriginalExtension();
            $file_name = time() . "." . $file_extention;   // name => 3628.png
            $path = "images/members" ;
            $request->img -> move( $path , $file_name );
        }else{
            $file_name = $member->img;
        }

        // Add img name to $requestData
        $requestData['img'] = $file_name;

        // return $requestData;

        // Update Record in DB
        try {
            $update = $member-> update( $requestData );
                return redirect() -> route("admin.member.index")-> with( [ "success" => " Member updated successfully"] ) ;
            if(!$update)
                return redirect() -> route("admin.member.index")-> with( [ "failed" => "Error at update opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> route("admin.member.index")-> with( [ "failed" => "Error at update opration"] ) ;
        }

    }

    /**
     * Remove the specified member from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find id in Db With Error 404
        $member = Member::findOrFail($id);

        // Delete Record from DB
        try {
            $delete = $member->delete();
                return redirect() -> route("admin.member.index")-> with( [ "success" => " Member deleted successfully"] ) ;
            if(!$delete)
                return redirect() -> route("admin.member.index")-> with( [ "failed" => "Error at delete opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> route("admin.member.index")-> with( [ "failed" => "Error at delete opration"] ) ;
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

        $members = Member::where('name', 'like', "%{$request->search}%")->paginate( 10 );
        return view("admin.member.index",compact("members"));

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
                $delete = Member::destroy( $request->id );
                    return redirect() -> route("admin.member.index")-> with( [ "success" => " Members deleted successfully"] ) ;
                if(!$delete)
                    return redirect() -> route("admin.member.index")-> with( [ "failed" => "Error at delete opration"] ) ;
            } catch (\Exception $e) {
                return redirect() -> route("admin.member.index")-> with( [ "failed" => "Error at delete opration"] ) ;
            }
        }

    }


}
