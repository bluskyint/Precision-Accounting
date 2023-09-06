<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Services\MultiActionServicesRequest;
use App\Http\Requests\Services\StoreServiceContentRequest;
use App\Models\User;
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

    public function __construct()
    {
        $this->middleware('permission:Show Services')->only(['perPage', 'index', 'show', 'search']);
        $this->middleware('permission:Add Services')->only(['create', 'store']);
        $this->middleware('permission:Edit Services')->only(['edit', 'update']);
        $this->middleware('permission:Delete Services')->only(['destroy', 'multiAction']);
        $this->middleware('permission:Show Services Trash')->only(['getTrash']);
        $this->middleware('permission:Restore Services')->only(['restore']);
        $this->middleware('permission:ForceDelete Services')->only(['forceDelete']);
    }

    public function perPage($num = 10)
    {
        // Dynamic pagination
        $services = Service::orderBy('id', 'desc')->paginate($num);
        return view("admin.services.index", compact("services"));
    }

    public function index()
    {
        $services = Service::with('author')->latest()->paginate(10);
        return view("admin.services.index", compact("services"));
    }

    public function getTrash()
    {
        $services = Service::onlyTrashed()->with('author')->latest('deleted_at')->paginate(10);
        return view("admin.services.index", compact("services"));
    }

    public function create()
    {
        $services = Service::select('id', 'title')->get();
        $authors = User::whereRelation('roles', 'name', 'Author')->select('id', 'name')->get();
        return view("admin.services.create", compact("services", "authors"));
    }

    public function createContent(Service $service)
    {
        return view("admin.services.createContent", compact('service'));
    }

    public function store(StoreServiceRequest $request)
    {
        try {
            $requestData = $request->validated();
            $folderName = $requestData['slug'];
            $requestData['img']['src'] = $this->storeImage($request->file('img'), 'services', $folderName);
            $requestData['icon']['src'] = $this->storeImage($request->file('icon'), 'services', $folderName);

            $service = Service::create($requestData);

            return to_route("admin.services.content.create", $service->slug)->with("success", "Service store successfully");

        } catch (\Exception $e) {
            return back()->with("failed", "Error at store operation");
        }
    }

    public function storeContent(StoreServiceContentRequest $request, Service $service)
    {
        try {
            $service->update(['content' => $request->validated('content')]);

            return to_route("admin.services.index")->with("success", "Service store successfully");

        } catch (\Exception $e) {
            return to_route("admin.services.index")->with("failed", "Error at store operation");
        }
    }

    public function show(string $slug)
    {
        $service = Service::withTrashed()->with('author')->where('slug', $slug)->first();
        $isServiceTrashed = $service->trashed();
        return view("admin.services.show", compact("service", "isServiceTrashed"));
    }

    public function edit(Service $service)
    {
        $service->load('author');
        $services = Service::select('id', 'title')->get();
        $authors = User::whereRelation('roles', 'name', 'Author')->select('id', 'name')->get();
        return view("admin.services.edit", compact("service", "services", "authors"));

    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        $requestData = $request->validated();
        $requestData['img']['src'] = $service->img['src'];
        $requestData['icon']['src'] = $service->icon['src'];

        try {
            $folderName = $requestData['slug'];

            if ($folderName !== $service->slug) {
                rename("storage/services/$service->slug", "storage/services/$folderName");
                $requestData['content'] = Str::replace("/$service->slug/", "/$folderName/", $requestData['content']);
            }

            if ($request->hasFile('img')) {
                $requestData['img']['src'] = $this->storeImage($request->file('img'), 'services', $folderName);
                Storage::disk('public')->delete("services/$folderName/" . $service->img['src']);
            }

            if ($request->hasFile('icon')) {
                $requestData['icon']['src'] = $this->storeImage($request->file('icon'), 'services', $folderName);
                Storage::disk('public')->delete("services/$folderName/" . $service->icon['src']);
            }

            $service->update($requestData);

            return to_route("admin.services.index")->with("success", "Service updated successfully");

        } catch (\Exception $e) {
            return to_route("admin.services.index")->with("failed", "Error at update operation");
        }
    }

    public function delete(Service $service)
    {
        try {
            $service->delete();

            return to_route("admin.services.index")->with(["success" => "Service deleted successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.services.index")->with("failed", "Error at delete operation");
        }
    }

    public function restore(string $id)
    {
        try {
            Service::withTrashed()->where('id', $id)->restore();

            return to_route("admin.services.index")->with(["success" => "Service restored successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.services.index")->with("failed", "Error at restore operation");
        }
    }

    public function forceDelete(string $id)
    {
        try {
            $service = Service::withTrashed()->where('id', $id)->first();
            Storage::disk('public')->deleteDirectory("services/".$service['slug']);
            $service->forceDelete();

            return to_route("admin.services.index")->with(["success" => "Service destroyed successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.services.index")->with("failed", "Error at destroyed operation");
        }
    }

    public function search(Request $request)
    {
        // validate search and redirect back
        $this->validate($request, [
            'search' => ['required', 'string', 'max:55'],
        ]);

        $services = Service::where('title', 'like', "%{$request->search}%")->paginate(10);
        return view("admin.services.index", compact("services"));

    }


    public function multiAction(MultiActionServicesRequest $request)
    {
        try {
            $services = Service::withTrashed()->findOrFail($request->id);

            if ($request->action === "delete") {
                foreach ($services as $service) {
                    $service->delete();
                }
            } elseif ($request->action === "restore") {
                if (auth()->user()->hasPermissionTo('Restore Services')) {
                    foreach ($services as $service) {
                        $service->restore();
                    }
                } else {
                    abort('403', 'USER DOES NOT HAVE THE RIGHT PERMISSIONS.');
                }
            } elseif ($request->action === "forceDelete") {
                if (auth()->user()->hasPermissionTo('ForceDelete Services')) {
                    foreach ($services as $service) {
                        Storage::disk('public')->deleteDirectory("services/$service->slug");
                        $service->forceDelete();
                    }
                } else {
                    abort('403', 'USER DOES NOT HAVE THE RIGHT PERMISSIONS.');
                }
            }

            return to_route("admin.services.index")->with(["success" => " Service deleted successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.services.index")->with("failed", "Error at delete operation");
        }

    }

}
