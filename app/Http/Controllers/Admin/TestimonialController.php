<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Testimonials\MultiActionTestimonialsRequest;
use App\Models\Testimonial;
use App\Http\Requests\Testimonials\StoreTestimonialRequest;
use App\Http\Requests\Testimonials\UpdateTestimonialRequest;
use App\Http\Controllers\Controller;
use App\Traits\StoreFileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    use StoreFileTrait;

    public function perPage( $num=10 )
    {
        // Dynamic pagination
        $testimonials = Testimonial::orderBy('id','desc')->paginate( $num );
        return view("admin.testimonial.index",compact("testimonials"));
    }

    public function index()
    {
        $testimonials = Testimonial::orderBy('id','desc')->paginate( 10 );
        return view("admin.testimonial.index",compact("testimonials"));
    }

    public function create()
    {
        return view("admin.testimonial.create");
    }

    public function store(StoreTestimonialRequest $request)
    {
        try {
            $requestData = $request->validated();
            $requestData['img'] = $this->storeImage('testimonials', $request->name, $request->file('img'));
            Testimonial::create($requestData);

            return to_route("admin.testimonial.index")->with("success", "Testimonial store successfully");

        } catch (\Exception $e) {
            return to_route("admin.testimonial.index")->with("failed", "Error at store operation");
        }
    }

    public function show($id)
    {
        // find id in Db With Error 404
        $testimonial = Testimonial::findOrFail($id);
        return view("admin.testimonial.show" , compact("testimonial") ) ;
    }

    public function edit($id)
    {
        // find id in Db With Error 404
        $testimonial = Testimonial::findOrFail($id);
        return view("admin.testimonial.edit" , compact("testimonial") ) ;
    }

    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial)
    {
        $requestData = $request->validated();

        try {
            if ($request->hasFile('img')) {
                Storage::disk('public')->delete("testimonials/$testimonial->img");
                $requestData['img'] = $this->storeImage('testimonials', $request->name, $request->file('img'));
            }

            if ($testimonial->name !== $request->validated('name') && !$request->hasFile('img')) {
                $new_file_name = Str::slug($request->validated('name')) . '.' . Str::afterLast($testimonial->img, '.');
                rename("storage/testimonials/$testimonial->img", "storage/testimonials/$new_file_name");
                $requestData['img'] = $new_file_name;
            }

            $testimonial->update($requestData);

            return to_route("admin.testimonial.index")->with("success", "Testimonial updated successfully");

        } catch (\Exception $e) {
            return to_route("admin.testimonial.index")->with("failed", "Error at update operation");
        }
    }

    public function destroy(Testimonial $testimonial)
    {
        try {
            Storage::disk('public')->delete("testimonials/$testimonial->img");
            $testimonial->delete();

            return to_route("admin.testimonial.index")->with(["success" => "Testimonial deleted successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.testimonial.index")->with("failed","Error at delete operation");
        }
    }

    public function search(Request $request)
    {
        // validate search and redirect back
        $this->validate($request, [
            'search'     =>  ['required', 'string', 'max:55'],
        ]);

        $testimonials = Testimonial::where('name', 'like', "%{$request->search}%")->paginate( 10 );
        return view("admin.testimonial.index",compact("testimonials"));

    }

    public function multiAction(MultiActionTestimonialsRequest $request)
    {
        try {
            // If Action is Delete
            if ($request->action === "delete") {
                $testimonials = Testimonial::findOrFail($request->id);
                Testimonial::destroy($request->id);
                foreach ($testimonials as $testimonial) {
                    Storage::disk('public')->delete("testimonials/$testimonial->img");
                }
            }

            return to_route("admin.testimonial.index")->with(["success" => "Testimonial deleted successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.testimonial.index")->with("failed","Error at delete operation");
        }

    }

}
