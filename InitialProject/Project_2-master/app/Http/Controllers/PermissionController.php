<?php

namespace App\Http\Controllers;

use App\Events\UserActionEvent;
use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:permission-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = Permission::all();
        return view('permissions.index', compact('data'));
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
        ]);

        $permission = Permission::create(['name' => $request->input('name')]);

        // Logging
        $logDetails = [
            'target' => 'permission',
            'permission_id' => $permission->id,
        ];

        $fieldLabels = [
            'name' => 'ชื่อสิทธิ์'
        ];

        $logDetails[$fieldLabels['name']] = $permission->name;

        event(new UserActionEvent(
            Auth::user(),
            'insert',
            $logDetails
        ));

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }

    public function show($id)
    {
        $permission = Permission::find($id);
        return view('permissions.show', compact('permission'));
    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $permission = Permission::find($id);

        // Capture before state
        $before = ['name' => $permission->name];

        $permission->name = $request->input('name');
        $permission->save();

        // Capture after state
        $after = ['name' => $permission->name];

        // Logging
        $logDetails = [
            'target' => 'permission',
            'permission_id' => $permission->id,
        ];

        $fieldLabels = [
            'name' => 'ชื่อสิทธิ์'
        ];

        // Compare fields
        $changes = [];
        if ($before['name'] != $after['name']) {
            $changes['before'][$fieldLabels['name']] = $before['name'];
            $changes['after'][$fieldLabels['name']] = $after['name'];
        }

        if (!empty($changes)) {
            $logDetails['changes'] = $changes;
            event(new UserActionEvent(
                Auth::user(),
                'update',
                $logDetails
            ));
        }

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);

        // Logging
        $logDetails = [
            'target' => 'permission',
            'permission_id' => $permission->id,
        ];

        $fieldLabels = [
            'name' => 'ชื่อสิทธิ์'
        ];

        $logDetails[$fieldLabels['name']] = $permission->name;

        $permission->delete();

        event(new UserActionEvent(
            Auth::user(),
            'delete',
            $logDetails
        ));

        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully');
    }
}