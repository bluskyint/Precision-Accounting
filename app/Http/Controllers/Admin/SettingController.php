<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Http\Requests\UpdateSettingRequest;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{

    public function edit(Setting $setting)
    {
        // find id in Db With Error 404
        $setting = Setting::findOrFail(1);
        return view("admin.setting" , compact("setting") ) ;
    }

    /**
     * Update the specified setting in storage.
     *
     * @param  \App\Http\Requests\UpdateSettingRequest  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingRequest $request)
    {
        // find id in Db With Error 404
        $setting = Setting::findOrFail(1);

        // save all request in one variable
        $requestData = $request->all();

        // return $requestData;

        // Update Record in DB
        try {
            $update = $setting-> update( $requestData );
                return redirect() -> route("admin.setting.edit") -> with( [ "success" => "Setting updated successfully"] ) ;
            if(!$update)
                return redirect() -> route("admin.setting.edit") -> with( [ "failed" => "Error at update opration"] ) ;
        } catch (\Exception $e) {
            return redirect() -> route("admin.setting.edit") -> with( [ "failed" => "Error at update opration"] ) ;
        }


    }

}
