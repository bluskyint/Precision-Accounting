<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\TaxCenters\MultiActionTaxCentersRequest;
use App\Models\Author;
use App\Traits\StoreFileTrait;
use Illuminate\Http\Request;
use App\Models\TaxCenter;
use App\Http\Requests\TaxCenters\StoreTaxCenterRequest;
use App\Http\Requests\TaxCenters\UpdateTaxCenterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class TaxCenterController extends Controller
{
    use StoreFileTrait;

    public function perPage( $num=10 )
    {
        // Dynamic pagination
        $tax_centers = TaxCenter::orderBy('id','desc')->paginate( $num );
        return view("admin.tax_center.index",compact("tax_centers"));
    }

    public function index()
    {
        $tax_centers = TaxCenter::with('author')->orderBy('id','desc')->paginate( 10 );
        return view("admin.tax_center.index",compact("tax_centers"));
    }

    public function create()
    {
        $authors = Author::select('id', 'name')->get();
        return view("admin.tax_center.create", compact("authors"));
    }

    public function store(StoreTaxCenterRequest $request)
    {
        try {
            $requestData = $request->validated();
            $requestData['img'] = $this->storeFile('taxCenters', $request->title, $request->file('img'));
            TaxCenter::create($requestData);

            return to_route("admin.tax_center.index")->with("success", "TaxCenter store successfully");

        } catch (\Exception $e) {
            return to_route("admin.tax_center.index")->with("failed", "Error at store operation");
        }

    }

    public function show($id)
    {
        // find id in Db With Error 404
        $tax_center = TaxCenter::with('author')->findOrFail($id);
        return view("admin.tax_center.show" , compact("tax_center") ) ;
    }

    public function edit($id)
    {
        // find id in Db With Error 404
        $tax_center = TaxCenter::findOrFail($id);
        $authors = Author::select('id', 'name')->get();
        return view("admin.tax_center.edit" , compact("tax_center", "authors") ) ;
    }

    public function update(UpdateTaxCenterRequest $request, TaxCenter $taxCenter)
    {
        $requestData = $request->validated();

        try {
            if ($request->hasFile('img')) {
                Storage::disk('public')->delete("taxCenters/$taxCenter->img");
                $requestData['img'] = $this->storeFile('taxCenters', $request->title, $request->file('img'));
            }

            if ($taxCenter->title !== $request->validated('title') && !$request->hasFile('img')) {
                $new_file_name = Str::slug($request->validated('title')) . '.' . Str::afterLast($taxCenter->img, '.');
                rename("storage/taxCenters/$taxCenter->img", "storage/taxCenters/$new_file_name");
                $requestData['img'] = $new_file_name;
            }

            $taxCenter->update($requestData);

            return to_route("admin.tax_center.index")->with("success", "Resource updated successfully");

        } catch (\Exception $e) {
            return to_route("admin.tax_center.index")->with("failed", "Error at update operation");
        }
    }

    public function destroy(TaxCenter $taxCenter)
    {
        try {
            Storage::disk('public')->delete("taxCenters/$taxCenter->img");
            $taxCenter->delete();

            return to_route("admin.tax_center.index")->with(["success" => "Tax Center deleted successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.tax_center.index")->with("failed","Error at delete operation");
        }
    }

    public function search(Request $request)
    {
        // validate search and redirect back
        $this->validate($request, [
            'search'     =>  ['required', 'string', 'max:55'],
        ]);

        $tax_centers = TaxCenter::where('title', 'like', "%{$request->search}%")->paginate( 10 );
        return view("admin.tax_center.index",compact("tax_centers"));
    }

    public function multiAction(MultiActionTaxCentersRequest $request)
    {
        try {
            // If Action is Delete
            if ($request->action === "delete") {
                $taxCenters = TaxCenter::findOrFail($request->id);
                TaxCenter::destroy($request->id);
                foreach ($taxCenters as $taxCenter) {
                    Storage::disk('public')->delete("taxCenters/$taxCenter->img");
                }
            }

            return to_route("admin.tax_center.index")->with(["success" => "Tax Center deleted successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.tax_center.index")->with("failed","Error at delete operation");
        }
    }

}
