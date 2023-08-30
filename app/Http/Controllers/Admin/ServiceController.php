<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Services\MultiActionServicesRequest;
use App\Models\Author;
use App\Traits\StoreContentTrait;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Http\Requests\Services\StoreServiceRequest;
use App\Http\Requests\Services\UpdateServiceRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    use StoreContentTrait;

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
            $folderName = Str::slug($requestData['title']);
            $requestData['img']['src'] = $this->storeImage($request->file('img'), 'services', $folderName);
            $requestData['icon']['src'] = $this->storeImage($request->file('icon'), 'services', $folderName);
            $requestData['content'] = $this->moveContentImages($requestData['content'], "services/$folderName");

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
        $requestData['img']['src'] = $service->img['src'];
        $requestData['icon']['src'] = $service->icon['src'];

        try {
            $folderName = Str::slug($requestData['title']);

            if ($request->hasFile('img')) {
                $requestData['img']['src'] = $this->storeImage($request->file('img'),'services', $folderName);
                Storage::disk('public')->delete("services/".$service->img['src']);
            }

            if ($request->hasFile('icon')) {
                $requestData['icon']['src'] = $this->storeImage($request->file('icon'), 'services', $folderName);
                Storage::disk('public')->delete("services/".$service->icon['src']);
            }

            if (Str::contains($requestData['content'], '/tempContentImages/')) {
                $requestData['content'] = $this->moveContentImages($requestData['content'], "services/$folderName");
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
            Storage::disk('public')->deleteDirectory("services/".Str::slug($service->title));
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
                    Storage::disk('public')->deleteDirectory("services/".Str::slug($service->title));
                }
            }

            return to_route("admin.service.index")->with(["success" => " Service deleted successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.service.index")->with("failed","Error at delete operation");
        }

    }

}
