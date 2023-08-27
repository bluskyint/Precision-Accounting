<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Services\MultiActionServicesRequest;
use App\Models\Author;
use App\Traits\StoreFileTrait;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Http\Requests\Services\StoreServiceRequest;
use App\Http\Requests\Services\UpdateServiceRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    use StoreFileTrait;

    public function perPage( $num=10 )
    {
        // Dynamic pagination
        $services = Service::orderBy('id','desc')->paginate( $num );
        return view("admin.service.index",compact("services"));
    }

    public function index()
    {
        $services = Service::with('author')->orderBy('id','desc')->paginate( 10 );
        return view("admin.service.index",compact("services"));
    }

    public function create()
    {
        $services = Service::select('id','title')->get();
        $authors = Author::select('id', 'name')->get();
        return view("admin.service.create",compact("services", "authors"));
    }

    public function store(StoreServiceRequest $request)
    {
        try {
            $requestData = $request->validated();
            $requestData['img'] = $this->storeFile('services/images', $request->title, $request->file('img'));
            $requestData['icon'] = $this->storeFile('services/icons', $request->title, $request->file('icon'));
            Service::create($requestData);

            return to_route("admin.service.index")->with("success", "Service store successfully");

        } catch (\Exception $e) {
            return to_route("admin.service.index")->with("failed", "Error at store operation");
        }
    }

    public function show($id)
    {
        // find id in Db With Error 404
        $service = Service::with('author')->findOrFail($id);
        return view("admin.service.show" , compact("service") ) ;
    }

    public function edit($id)
    {
        // find id in Db With Error 404
        $service = Service::findOrFail($id);
        $services = Service::select('id','title')->get();
        $authors = Author::select('id', 'name')->get();
        return view("admin.service.edit" , compact("service","services", "authors") ) ;

    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        $requestData = $request->validated();

        try {
            if ($request->hasFile('img')) {
                Storage::disk('public')->delete("services/images/$service->img");
                $requestData['img'] = $this->storeFile('services/images', $request->title, $request->file('img'));
            }

            if ($request->hasFile('icon')) {
                Storage::disk('public')->delete("services/icons/$service->icon");
                $requestData['icon'] = $this->storeFile('services/icons', $request->title, $request->file('icon'));
            }

            if ($service->name !== $request->validated('title')) {
                if (!$request->hasFile('img')) {
                    $new_img_name = Str::slug($request->validated('title')) . '.' . Str::afterLast($service->img, '.');
                    rename("storage/services/images/$service->img", "storage/services/images/$new_img_name");
                    $requestData['img'] = $new_img_name;
                }

                if (!$request->hasFile('icon')) {
                    $new_icon_name = Str::slug($request->validated('title')) . '.' . Str::afterLast($service->icon, '.');
                    rename("storage/services/icons/$service->icon", "storage/services/icons/$new_icon_name");
                    $requestData['icon'] = $new_icon_name;
                }
            }

            $service->update($requestData);
            return to_route("admin.service.index")->with("success", "Service updated successfully");

        } catch (\Exception $e) {
            return to_route("admin.service.index")->with("failed", "Error at update operation");
        }
    }

    public function destroy(Service $service)
    {
        try {
            Storage::disk('public')->delete(["services/images/$service->img", "services/icons/$service->icon"]);
            $service->delete();

            return to_route("admin.service.index")->with(["success" => " Service deleted successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.service.index")->with("failed","Error at delete operation");
        }
    }

    public function search(Request $request)
    {
        // validate search and redirect back
        $this->validate($request, [
            'search'     =>  ['required', 'string', 'max:55'],
        ]);

        $services = Service::where('title', 'like', "%{$request->search}%")->paginate( 10 );
        return view("admin.service.index",compact("services"));

    }



    public function multiAction(MultiActionServicesRequest $request)
    {
        try {
            // If Action is Delete
            if ($request->action === "delete") {
                $services = Service::findOrFail($request->id);
                Service::destroy($request->id);
                foreach ($services as $service) {
                    Storage::disk('public')->delete(["services/images/$service->img", "services/icons/$service->icon"]);
                }
            }

            return to_route("admin.service.index")->with(["success" => " Service deleted successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.service.index")->with("failed","Error at delete operation");
        }

    }

}
