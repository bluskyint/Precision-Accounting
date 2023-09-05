<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\MultiActionUsersRequest;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\User;
use App\Traits\StoreContentTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use StoreContentTrait;

    public function __construct()
    {
        $this->middleware('permission:Show Users')->only(['perPage', 'index', 'show', 'search']);
        $this->middleware('permission:Add Users')->only(['create', 'store']);
        $this->middleware('permission:Edit Users')->only(['edit', 'update']);
        $this->middleware('permission:Delete Users')->only(['destroy', 'multiAction']);
    }

    public function perPage($num = 10)
    {
        // Dynamic pagination
        $users = User::orderBy('id', 'desc')->paginate($num);
        return view("admin.users.index", compact("users"));
    }

    public function index()
    {
        $users = User::latest()->with('roles')->paginate(10);
        return view("admin.users.index", compact("users"));
    }

    public function create()
    {
        $roles = Role::oldest()->get();
        return view("admin.users.create", compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $requestData = $request->except('role_id');
            $requestData['img']['src'] = $this->storeImage($request->file('img'), 'users');
            $requestData['password'] = Hash::make($requestData['password']);
            $user = User::create($requestData);
            $user->assignRole([$request->validated('role_id')]);

            return to_route("admin.users.index")->with("success", "User store successfully");

        } catch (\Exception $e) {
            return to_route("admin.users.index")->with("failed", "Error at store operation");
        }
    }

    public function show(User $user)
    {
        $user->load('roles');
        return view("admin.users.show", compact("user"));
    }

    public function edit(User $user)
    {
        $user->load('roles');
        $roles = Role::oldest()->get();
        return view("admin.users.edit", compact("user", "roles"));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $requestData = $request->except('role_id', 'password');
        $requestData['img']['src'] = $user->img['src'];

        try {
            if ($request->hasFile('img')) {
                Storage::disk('public')->delete("users/".$user->img['src']);
                $requestData['img']['src'] = $this->storeImage($request->file('img'), 'users');
            }

            if($request->filled('password')) {
                $requestData['password'] = Hash::make($request['password']);
            }

            $user->update($requestData);
            $user->syncRoles([$request->validated('role_id')]);

            return to_route("admin.users.index")->with("success", "User updated successfully");

        } catch (\Exception $e) {
            return to_route("admin.users.index")->with("failed", "Error at update operation");
        }
    }

    public function destroy(User $user)
    {
        try {
            Storage::disk('public')->delete("users/".$user->img['src']);
            $user->removeRole($user->roles[0]->name);
            $user->delete();

            return to_route("admin.users.index")->with(["success" => " User deleted successfully"]);

        } catch (\Exception $e) {
            return to_route("admin.users.index")->with("failed","Error at delete operation");
        }
    }

    public function search(Request $request)
    {
        // validate search and redirect back
        $this->validate($request, [
            'search' => ['required', 'string', 'max:55'],
        ]);

        $users = User::where('name', 'like', "%{$request->search}%")->paginate(10);
        return view("admin.users.index", compact("users"));

    }


    public function multiAction(MultiActionUsersRequest $request)
    {
        try {
            // If Action is Delete
            if ($request->action === "delete") {
                $users = User::findOrFail($request->id);
                User::destroy($request->id);
                foreach ($users as $user) {
                    Storage::disk('public')->delete("users/".$user->img['src']);
                    $user->removeRole($user->roles[0]->name);
                }
            }

            return to_route("admin.users.index")->with("success", "User deleted successfully");

        } catch (\Exception $e) {
            return to_route("admin.users.index")->with("failed", "Error at delete operation");
        }
    }
}
