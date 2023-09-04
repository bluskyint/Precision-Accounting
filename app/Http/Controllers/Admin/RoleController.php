<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Show Roles')->only(['index', 'show']);
        $this->middleware('permission:Add Roles')->only(['create','store']);
        $this->middleware('permission:Edit Roles')->only(['edit','update']);
        $this->middleware('permission:Delete Roles')->only(['destroy']);
    }

    public function index()
    {
        $roles = Role::oldest()->get();
        return view('admin.roles.index',compact('roles'));
    }

    public function create()
    {
        $permissionsGroups = Permission::get()->groupBy('group_name');
        return view('admin.roles.create',compact('permissionsGroups'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles',
            'permissions' => 'required',
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return to_route('admin.roles.index')->with('success','Role created successfully');
    }

    public function show(Role $role)
    {
        $permissionsGroups = Permission::get()->groupBy('group_name');
        $rolePermissionsIds = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $role->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('admin.roles.show',compact('role', 'permissionsGroups','rolePermissionsIds'));
    }

    public function edit(Role $role)
    {
        $permissionsGroups = Permission::get()->groupBy('group_name');
        $rolePermissionsIds = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $role->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('admin.roles.edit',compact('role','permissionsGroups','rolePermissionsIds'));
    }

    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => 'required',
            'permissions' => 'required',
        ]);

        $role->update(['name' => $request->name]);

        $role->syncPermissions($request->permissions);

        return to_route('admin.roles.index')
            ->with('success','Role updated successfully');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return to_route('admin.roles.index')->with('success','Role deleted successfully');
    }
}
