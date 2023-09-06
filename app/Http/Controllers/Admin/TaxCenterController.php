<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\TaxCenters\MultiActionTaxCentersRequest;
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
        return view("admin.tax_center.index", compact("tax_centers"));
    }

    public function index()
    {
        $tax_centers = TaxCenter::with('author')->latest()->paginate(10);
        return view("admin.tax_center.index", compact("tax_centers"));
    }

    public function getTrash()
    {
        $tax_centers = TaxCenter::onlyTrashed()->with('author')->latest('deleted_at')->paginate(10);
        return view("admin.tax_center.index", compact("tax_centers"));
    }

    public function create()
    {
        $authors = User::whereRelation('roles', 'name', 'Author')->select('id', 'name')->get();
        return view("admin.tax_center.create", compact("authors"));
    }

    public function store(StoreTaxCenterRequest $request)
    {
        try {
            $requestData = $request->validated();
            $folderName = $requestData['slug'];
            $requestData['img']['src'] = $this->storeImage($request->file('img'), 'taxCenters', $folderName);
            $requestData['content'] = $this->moveContentImages($requestData['content'], "taxCenters/$folderName");

            TaxCenter::create($requestData);

            return to_route("admin.tax_center.index")->with("success", "TaxCenter store successfully");

        } catch (\Exception $e) {
            return to_route("admin.tax_center.index")->with("failed", "Error at store operation");
        }
    }

    public function show(string $id)
    {
        $tax_center = TaxCenter::withTrashed()->with('author')->where('id', $id)->first();
        $isTaxTrashed = $tax_center->trashed();
        return view("admin.tax_center.show", compact("tax_center", "isTaxTrashed"));
    }

    public function edit(TaxCenter $tax_center)
    {
        $tax_center->load('author');
        $authors = User::whereRelation('roles', 'name', 'Author')->select('id', 'name')->get();
        return view("admin.tax_center.edit", compact("tax_center", "authors"));
    }

    public function update(UpdateTaxCenterRequest $request, TaxCenter $taxCenter)
    {
        $requestData = $request->validated();
        $requestData['img']['src'] = $taxCenter->img['src'];

        try {
            $folderName = $requestData['slug'];

            if ($folderName !== $taxCenter->slug) {
                rename("storage/taxCenters/$taxCenter->slug", "storage/taxCenters/$folderName");
            }

            if ($request->hasFile('img')) {
                $requestData['img']['src'] = $this->storeImage($request->file('img'), 'taxCenters', $folderName);
                Storage::disk('public')->delete("taxCenters/$folderName/" . $taxCenter->img['src']);
            }

            if (Str::contains($requestData['content'], '/tempContentImages/')) {
                $requestData['content'] = $this->moveContentImages($requestData['content'], "taxCenters/$folderName");
            }

            $taxCenter->update($requestData);

            return to_route("admin.tax_center.index")->with("success", "TaxCenter updated successfully");

        } catch (\Exception $e) {
            return to_route("admin.tax_center.index")->with("failed", "Error at update operation");
        }
    }

    public function delete(TaxCenter $taxCenter)
    {
        try {
            $taxCenter->delete();

            return to_route("admin.tax_center.index")->with(["success" => "Tax Center deleted successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.tax_center.index")->with("failed", "Error at delete operation");
        }
    }

    public function restore(string $id)
    {
        try {
            TaxCenter::withTrashed()->where('id', $id)->restore();

            return to_route("admin.tax_center.index")->with(["success" => "TaxCenter restored successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.tax_center.index")->with("failed", "Error at restore operation");
        }
    }

    public function forceDelete(string $id)
    {
        try {
            $taxCenter = TaxCenter::withTrashed()->where('id', $id)->first();
            Storage::disk('public')->deleteDirectory("taxCenters/" . $taxCenter['slug']);
            $taxCenter->forceDelete();

            return to_route("admin.tax_center.index")->with(["success" => "TaxCenter destroyed successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.tax_center.index")->with("failed", "Error at destroyed operation");
        }
    }

    public function search(Request $request)
    {
        // validate search and redirect back
        $this->validate($request, [
            'search' => ['required', 'string', 'max:55'],
        ]);

        $tax_centers = TaxCenter::where('title', 'like', "%{$request->search}%")->paginate(10);
        return view("admin.tax_center.index", compact("tax_centers"));
    }

    public function multiAction(MultiActionTaxCentersRequest $request)
    {
        try {
            $taxCenters = TaxCenter::withTrashed()->findOrFail($request->id);

            if ($request->action === "delete") {
                foreach ($taxCenters as $taxCenter) {
                    $taxCenter->delete();
                }
            } elseif ($request->action === "restore") {
                if (auth()->user()->hasPermissionTo('Restore Articles')) {
                    foreach ($taxCenters as $taxCenter) {
                        $taxCenter->restore();
                    }
                } else {
                    abort('403', 'USER DOES NOT HAVE THE RIGHT PERMISSIONS.');
                }
            } elseif ($request->action === "forceDelete") {
                if (auth()->user()->hasPermissionTo('ForceDelete Articles')) {
                    foreach ($taxCenters as $taxCenter) {
                        Storage::disk('public')->deleteDirectory("taxCenters/$taxCenter->slug");
                        $taxCenter->forceDelete();
                    }
                } else {
                    abort('403', 'USER DOES NOT HAVE THE RIGHT PERMISSIONS.');
                }
            }

            return to_route("admin.tax_center.index")->with(["success" => "Tax Center deleted successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.tax_center.index")->with("failed", "Error at delete operation");
        }
    }

}
