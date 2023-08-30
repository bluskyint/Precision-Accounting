<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\TaxCenters\MultiActionTaxCentersRequest;
use App\Models\Author;
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

            $requestData['img']['src'] = $this->storeImage('taxCenters', $requestData['title'], $request->file('img'));
            $requestData['content'] = $this->moveContentImages($requestData['content'], 'taxCenters/'.Str::slug($requestData['title']));

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
        $requestData['img']['src'] = $taxCenter->img['src'];

        try {
            if ($request->hasFile('img')) {
                $requestData['img']['src'] = $this->storeImage('taxCenters', $taxCenter->title, $request->file('img'));
                Storage::disk('public')->delete("taxCenters/".$taxCenter->img['src']);
            }

            if (Str::contains($requestData['content'], '/tempContentImages/')) {
                $requestData['content'] = $this->moveContentImages($requestData['content'], "taxCenters/".Str::slug($requestData['title']));
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
            Storage::disk('public')->deleteDirectory("taxCenters/".Str::slug($taxCenter->title));
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
                    Storage::disk('public')->deleteDirectory("taxCenters/".Str::slug($taxCenter->title));
                }
            }

            return to_route("admin.tax_center.index")->with(["success" => "Tax Center deleted successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.tax_center.index")->with("failed","Error at delete operation");
        }
    }

}
