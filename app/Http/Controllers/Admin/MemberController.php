<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Members\MultiActionMembersRequest;
use App\Traits\StoreContentTrait;
use App\Traits\StoreFileTrait;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Http\Requests\Members\StoreMemberRequest;
use App\Http\Requests\Members\UpdateMemberRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    use StoreContentTrait;
    public function perPage($num = 10)
    {
        // Dynamic pagination
        $members = Member::orderBy('id', 'desc')->paginate($num);
        return view("admin.member.index", compact("members"));
    }

    public function index()
    {
        $members = Member::orderBy('id', 'desc')->paginate(10);
        return view("admin.member.index", compact("members"));
    }

    public function create()
    {
        return view("admin.member.create");
    }

    public function store(StoreMemberRequest $request)
    {
        try {
            $requestData = $request->validated();
            $requestData['img']['src'] = $this->storeImage($request->file('img'),'members');
            Member::create($requestData);

            return to_route("admin.member.index")->with("success", "Member store successfully");

        } catch (\Exception $e) {
            return to_route("admin.member.index")->with("failed", "Error at store operation");
        }
    }

    public function show(Member $member)
    {
        return view("admin.member.show", compact("member"));
    }

    public function edit(Member $member)
    {
        return view("admin.member.edit", compact("member"));
    }

    public function update(UpdateMemberRequest $request, Member $member)
    {
        $requestData = $request->validated();
        $requestData['img']['src'] = $member->img['src'];

        try {
            if ($request->hasFile('img')) {
                Storage::disk('public')->delete("members/".$member->img['src']);
                $requestData['img']['src'] = $this->storeImage($request->file('img'),'members');
            }

            $member->update($requestData);

            return to_route("admin.member.index")->with("success", "Member updated successfully");

        } catch (\Exception $e) {
            return to_route("admin.member.index")->with("failed", "Error at update operation");
        }
    }

    public function destroy(Member $member)
    {
        try {
            Storage::disk('public')->delete("members/".$member->img['src']);
            $member->delete();

            return to_route("admin.member.index")->with(["success" => " Member deleted successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.member.index")->with("failed","Error at delete operation");
        }
    }

    public function search(Request $request)
    {
        // validate search and redirect back
        $this->validate($request, [
            'search' => ['required', 'string', 'max:55'],
        ]);

        $members = Member::where('name', 'like', "%{$request->search}%")->paginate(10);
        return view("admin.member.index", compact("members"));

    }


    public function multiAction(MultiActionMembersRequest $request)
    {
        try {
            // If Action is Delete
            if ($request->action === "delete") {
                $members = Member::findOrFail($request->id);
                Member::destroy($request->id);
                foreach ($members as $member) {
                    Storage::disk('public')->delete("members/".$member->img['src']);
                }
            }

            return to_route("admin.member.index")->with(["success" => " Member deleted successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.member.index")->with("failed","Error at delete operation");
        }
    }

}
