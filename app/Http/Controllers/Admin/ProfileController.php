<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{

    public function edit(User $user)
    {
        $user = Auth::user();
        return view("admin.profile" , compact("user") ) ;
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \App\Http\Requests\UpdateProfileRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request, User $user)
    {

        // find id in Db With Error 404
        $user = User::findOrFail( Auth::user()->id );

        // save all request in one variable
        $requestData = $request->all();


        // Hash Password
        if( $requestData['password'] == '' ){
            $requestData['password'] = $user->password;
        }else{
            $requestData['password'] = Hash::make($request->password);
        }

        // return $requestData;

        // Update Record in DB
        try {
            $update = $user-> update( $requestData );
                return redirect() -> route("admin.profile.edit") -> with( [ "success" => "Profile updated successfully"] ) ;
            if(!$update)
                return redirect() -> route("admin.profile.edit") -> with( [ "failed" => "Error at update opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> route("admin.profile.edit") -> with( [ "failed" => "Error at update opration"] ) ;
        }


    }

}
