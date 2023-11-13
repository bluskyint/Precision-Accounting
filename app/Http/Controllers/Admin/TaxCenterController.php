<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\TaxCenters\MultiActionTaxCentersRequest;
use App\Http\Requests\TaxCenters\StoreTaxCenterContentRequest;
use App\Models\User;
use App\Traits\StoreContentTrait;
use Illuminate\Http\Request;
use App\Models\TaxCenter;
use App\Http\Requests\TaxCenters\StoreTaxCenterRequest;
use App\Http\Requests\TaxCenters\UpdateTaxCenterRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TaxCenterController extends Controller
{
    use StoreContentTrait;

    public function __construct()
    {
        $this->middleware('permission:Show TaxCenters')->only(['perPage', 'index', 'show', 'search']);
        $this->middleware('permission:Add TaxCenters')->only(['create', 'store']);
        $this->middleware('permission:Edit TaxCenters')->only(['edit', 'update']);
        $this->middleware('permission:Delete TaxCenters')->only(['destroy', 'multiAction']);
        $this->middleware('permission:Show TaxCenters Trash')->only(['getTrash']);
        $this->middleware('permission:Restore TaxCenters')->only(['restore']);
        $this->middleware('permission:ForceDelete TaxCenters')->only(['forceDelete']);
    }

    public function perPage($num = 10)
    {
        // Dynamic pagination
        $tax_centers = TaxCenter::orderBy('id', 'desc')->paginate($num);
        return view("admin.taxcenters.index", compact("tax_centers"));
    }

    public function index()
    {
        $tax_centers = TaxCenter::with('author')->latest()->paginate(10);
        return view("admin.taxcenters.index", compact("tax_centers"));
    }

    public function getTrash()
    {
        $tax_centers = TaxCenter::onlyTrashed()->with('author')->latest('deleted_at')->paginate(10);
        return view("admin.taxcenters.index", compact("tax_centers"));
    }

    public function create()
    {
        $authors = User::whereRelation('roles', 'name', 'Author')->select('id', 'name')->get();
        return view("admin.taxcenters.create", compact("authors"));
    }

    public function createContent(TaxCenter $taxcenter)
    {
        return view("admin.taxcenters.createContent",compact('taxcenter'));
    }

    public function store(StoreTaxCenterRequest $request)
    {
        try {
            $requestData = $request->validated();
            $folderName = $requestData['slug'];
            $requestData['img']['src'] = $this->storeImage($request->file('img'), 'tax-centers', $folderName);

            $taxcenters = TaxCenter::create($requestData);

            return to_route("admin.taxcenters.content.create", $taxcenters->slug)->with("success", "TaxCenter store successfully");

        } catch (\Exception $e) {
            return back()->with("failed", "Error at store operation");
        }
    }


    public function storeContent(StoreTaxCenterContentRequest $request, TaxCenter $taxcenter)
    {
        try {
            $taxcenter->update(['content' => $request->validated('content')]);

            return to_route("admin.taxcenters.index")->with("success", "Article store successfully");

        } catch (\Exception $e) {
            return to_route("admin.taxcenters.index")->with("failed", "Error at store operation");
        }
    }

    public function show(string $slug)
    {
        $taxcenter = TaxCenter::withTrashed()->with('author')->where('slug', $slug)->first();
        $isTaxTrashed = $taxcenter->trashed();
        return view("admin.taxcenters.show", compact("taxcenter", "isTaxTrashed"));
    }

    public function edit(TaxCenter $taxcenter)
    {
        $taxcenter->load('author');
        $authors = User::whereRelation('roles', 'name', 'Author')->select('id', 'name')->get();
        return view("admin.taxcenters.edit", compact("taxcenter", "authors"));
    }

    public function update(UpdateTaxCenterRequest $request, TaxCenter $taxcenter)
    {
        $requestData = $request->validated();
        $requestData['img']['src'] = $taxcenter->img['src'];

        try {
            $folderName = $requestData['slug'];

            if ($folderName !== $taxcenter->slug) {
                rename("storage/tax-centers/$taxcenter->slug", "storage/tax-centers/$folderName");
                $requestData['content'] = Str::replace("/$taxcenter->slug/", "/$folderName/", $requestData['content']);
            }

            if ($request->hasFile('img')) {
                $requestData['img']['src'] = $this->storeImage($request->file('img'), 'tax-centers', $folderName);
                Storage::disk('public')->delete("tax-centers/$folderName/" . $taxcenter->img['src']);
            }

            $taxcenter->update($requestData);

            return to_route("admin.taxcenters.index")->with("success", "TaxCenter updated successfully");

        } catch (\Exception $e) {
            return to_route("admin.taxcenters.index")->with("failed", "Error at update operation");
        }
    }

    public function delete(TaxCenter $taxcenter)
    {
        try {
            $taxcenter->delete();

            return to_route("admin.taxcenters.index")->with(["success" => "Tax Center deleted successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.taxcenters.index")->with("failed", "Error at delete operation");
        }
    }

    public function restore(string $id)
    {
        try {
            TaxCenter::withTrashed()->where('id', $id)->restore();

            return to_route("admin.taxcenters.index")->with(["success" => "TaxCenter restored successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.taxcenters.index")->with("failed", "Error at restore operation");
        }
    }

    public function forceDelete(string $id)
    {
        try {
            $taxcenter = TaxCenter::withTrashed()->where('id', $id)->first();
            Storage::disk('public')->deleteDirectory("tax-centers/" . $taxcenter['slug']);
            $taxcenter->forceDelete();

            return to_route("admin.taxcenters.index")->with(["success" => "TaxCenter destroyed successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.taxcenters.index")->with("failed", "Error at destroyed operation");
        }
    }

    public function search(Request $request)
    {
        // validate search and redirect back
        $this->validate($request, [
            'search' => ['required', 'string', 'max:55'],
        ]);

        $tax_centers = TaxCenter::where('title', 'like', "%{$request->search}%")->paginate(10);
        return view("admin.taxcenters.index", compact("tax_centers"));
    }

    public function multiAction(MultiActionTaxCentersRequest $request)
    {
        try {
            $taxcenters = TaxCenter::withTrashed()->findOrFail($request->id);

            if ($request->action === "delete") {
                foreach ($taxcenters as $taxcenter) {
                    $taxcenter->delete();
                }
            } elseif ($request->action === "restore") {
                if (auth()->user()->hasPermissionTo('Restore Articles')) {
                    foreach ($taxcenters as $taxcenter) {
                        $taxcenter->restore();
                    }
                } else {
                    abort('403', 'USER DOES NOT HAVE THE RIGHT PERMISSIONS.');
                }
            } elseif ($request->action === "forceDelete") {
                if (auth()->user()->hasPermissionTo('ForceDelete Articles')) {
                    foreach ($taxcenters as $taxcenter) {
                        Storage::disk('public')->deleteDirectory("tax-centers/$taxcenter->slug");
                        $taxcenter->forceDelete();
                    }
                } else {
                    abort('403', 'USER DOES NOT HAVE THE RIGHT PERMISSIONS.');
                }
            }

            return to_route("admin.taxcenters.index")->with(["success" => "Tax Center deleted successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.taxcenters.index")->with("failed", "Error at delete operation");
        }
    }

}
