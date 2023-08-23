<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resources\DeleteMultiResourcesRequest;
use Illuminate\Http\Request;
use App\Models\Resource;
use App\Http\Requests\Resources\StoreResourceRequest;
use App\Http\Requests\Resources\UpdateResourceRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ResourceController extends Controller
{
    public function perPage( $num=10 )
    {
        // Dynamic pagination
        $resources = Resource::orderBy('id','desc')->paginate( $num );
        return view("admin.resource.index",compact("resources"));
    }

    public function index()
    {
        $resources = Resource::orderBy('id','desc')->paginate( 10 );
        return view("admin.resource.index",compact("resources"));
    }

    public function create()
    {
        return view("admin.resource.create");
    }

    public function store(StoreResourceRequest $request)
    {
        try {
            $requestData = $request->validated();
            $file = $request->file('img');
            $file_name = Str::slug($request->validated('title')) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('resources', $file_name, 'public');
            $requestData['img'] = $file_name;
            Resource::create($requestData);

            return to_route("admin.resource.index")->with("success", "Resource store successfully");

        } catch (\Exception $e) {
            return to_route("admin.resource.index")->with("failed", "Error at store operation");
        }
    }

    public function show($id)
    {
        // find id in Db With Error 404
        $resource = Resource::findOrFail($id);
        return view("admin.resource.show" , compact("resource") ) ;
    }

    public function edit($id)
    {
        // find id in Db With Error 404
        $resource = Resource::findOrFail($id);
        return view("admin.resource.edit" , compact("resource") ) ;
    }

    public function update(UpdateResourceRequest $request, Resource $resource)
    {
        $requestData = $request->validated();

        try {
            if ($request->hasFile('img')) {
                Storage::disk('public')->delete("resources/$resource->img");
                $file = $request->file('img');
                $file_name = Str::slug($request->validated('title')) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('resources', $file_name, 'public');
                $requestData['img'] = $file_name;
            }

            if ($resource->title !== $request->validated('name') && !$request->hasFile('img')) {
                $new_file_name = Str::slug($request->validated('title')) . '.' . Str::afterLast($resource->img, '.');
                rename("storage/resources/$resource->img", "storage/resources/$new_file_name");
                $requestData['img'] = $new_file_name;
            }

            $resource->update($requestData);

            return to_route("admin.resource.index")->with("success", "Resource updated successfully");

        } catch (\Exception $e) {
            return to_route("admin.resource.index")->with("failed", "Error at update operation");
        }
    }

    public function destroy(Resource $resource)
    {
        try {
            Storage::disk('public')->delete("resources/$resource->img");
            $resource->delete();

            return to_route("admin.resource.index")->with(["success" => " Resource deleted successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.resource.index")->with("failed","Error at delete operation");
        }
    }

    public function search(Request $request)
    {
        // validate search and redirect back
        $this->validate($request, [
            'search'     =>  ['required', 'string', 'max:55'],
        ]);

        $resources = Resource::where('title', 'like', "%{$request->search}%")->paginate( 10 );
        return view("admin.resource.index",compact("resources"));

    }



    public function multiAction(DeleteMultiResourcesRequest $request)
    {
        try {
            // If Action is Delete
            if ($request->action === "delete") {
                $members = Resource::findOrFail($request->id);
                Resource::destroy($request->id);
                foreach ($members as $member) {
                    Storage::disk('public')->delete("resources/$member->img");
                }
            }

            return to_route("admin.resource.index")->with(["success" => " Resource deleted successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.resource.index")->with("failed","Error at delete operation");
        }
    }


}
