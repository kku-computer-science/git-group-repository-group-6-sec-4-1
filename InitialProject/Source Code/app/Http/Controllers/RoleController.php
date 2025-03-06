<?php

namespace App\Http\Controllers;

use App\Events\UserActionEvent;
use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = Role::orderBy('id', 'DESC')->paginate(5);
        return view('roles.index', compact('data'));
    }

    public function create()
    {
        $permission = Permission::get();
        return view('roles.create', compact('permission'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $permissions = $request->input('permission');
        $role->syncPermissions($permissions);

        // Logging
        $logDetails = [
            'target' => 'role',
            'role_id' => $role->id,
        ];

        $fieldLabels = [
            'name' => 'ชื่อบทบาท',
            'permission' => 'สิทธิ์'
        ];

        $logDetails[$fieldLabels['name']] = $role->name;
        $logDetails[$fieldLabels['permission']] = implode(', ', Permission::whereIn('id', $permissions)->pluck('name')->all());

        event(new UserActionEvent(
            Auth::user(),
            'insert',
            $logDetails
        ));

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join('role_has_permissions', 'role_has_permissions.permission_id', 'permissions.id')
            ->where('role_has_permissions.role_id', $id)
            ->get();

        return view('roles.show', compact('role', 'rolePermissions'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('roles.edit', compact('role', 'permission', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);

        // Capture before state
        $before = [
            'name' => $role->name,
            'permission' => $role->permissions->pluck('name')->all()
        ];

        $role->name = $request->input('name');
        $role->save();
        $permissions = $request->input('permission');
        $role->syncPermissions($permissions);

        // Capture after state
        $after = [
            'name' => $role->name,
            'permission' => $role->permissions->pluck('name')->all()
        ];

        // Logging
        $logDetails = [
            'target' => 'role',
            'role_id' => $role->id,
        ];

        $fieldLabels = [
            'name' => 'ชื่อบทบาท',
            'permission' => 'สิทธิ์'
        ];

        // Compare fields
        $changes = [];
        if ($before['name'] != $after['name']) {
            $changes['before'][$fieldLabels['name']] = $before['name'];
            $changes['after'][$fieldLabels['name']] = $after['name'];
        }

        // Compare permissions
        if ($before['permission'] != $after['permission']) {
            $logDetails[$fieldLabels['permission']] = [
                'before' => implode(', ', $before['permission']),
                'after' => implode(', ', $after['permission'])
            ];
        }

        if (!empty($changes) || isset($logDetails[$fieldLabels['permission']])) {
            if (!empty($changes)) {
                $logDetails['changes'] = $changes;
            }
            event(new UserActionEvent(
                Auth::user(),
                'update',
                $logDetails
            ));
        }

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy($id)
    {
        $role = Role::find($id);

        // Logging
        $logDetails = [
            'target' => 'role',
            'role_id' => $role->id,
        ];

        $fieldLabels = [
            'name' => 'ชื่อบทบาท'
        ];

        $logDetails[$fieldLabels['name']] = $role->name;

        $role->delete();

        event(new UserActionEvent(
            Auth::user(),
            'delete',
            $logDetails
        ));

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }
}