<?php

namespace App\Http\Controllers;

use App\Events\UserActionEvent;
use App\Models\Department;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:departments-list|departments-create|departments-edit|departments-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:departments-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:departments-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:departments-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = Department::latest()->paginate(5);
        return view('departments.index', compact('data'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'department_name_th' => 'required',
            'department_name_en' => 'required', // Corrected from duplicate 'department_name_th'
        ]);

        $input = $request->except(['_token']);
        $department = Department::create($input);

        // Logging
        $logDetails = [
            'target' => 'department',
            'department_id' => $department->id,
        ];

        $fieldLabels = [
            'department_name_th' => 'ชื่อภาควิชา (ไทย)',
            'department_name_en' => 'ชื่อภาควิชา (อังกฤษ)'
        ];

        foreach ($input as $key => $value) {
            if (array_key_exists($key, $fieldLabels)) {
                $logDetails[$fieldLabels[$key]] = $value;
            }
        }

        event(new UserActionEvent(
            Auth::user(),
            'insert',
            $logDetails
        ));

        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }

    public function edit(Department $department)
    {
        $department = Department::find($department->id);
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        // Capture before state
        $before = $department->only(['department_name_th', 'department_name_en']);

        $department->update($request->all());

        // Capture after state
        $after = $department->only(['department_name_th', 'department_name_en']);

        // Logging
        $logDetails = [
            'target' => 'department',
            'department_id' => $department->id,
        ];

        $fieldLabels = [
            'department_name_th' => 'ชื่อภาควิชา (ไทย)',
            'department_name_en' => 'ชื่อภาควิชา (อังกฤษ)'
        ];

        // Compare fields
        $changes = [];
        foreach ($before as $key => $value) {
            if (isset($after[$key]) && $value != $after[$key]) {
                $changes['before'][$fieldLabels[$key]] = $value;
                $changes['after'][$fieldLabels[$key]] = $after[$key];
            }
        }

        if (!empty($changes)) {
            $logDetails['changes'] = $changes;
            event(new UserActionEvent(
                Auth::user(),
                'update',
                $logDetails
            ));
        }

        return redirect()->route('departments.index')->with('success', 'Department updated successfully');
    }

    public function destroy(Department $department)
    {
        // Logging
        $logDetails = [
            'target' => 'department',
            'department_id' => $department->id,
        ];

        $fieldLabels = [
            'department_name_th' => 'ชื่อภาควิชา (ไทย)',
            'department_name_en' => 'ชื่อภาควิชา (อังกฤษ)'
        ];

        $logDetails[$fieldLabels['department_name_th']] = $department->department_name_th;
        $logDetails[$fieldLabels['department_name_en']] = $department->department_name_en;

        $department->delete();

        event(new UserActionEvent(
            Auth::user(),
            'delete',
            $logDetails
        ));

        return redirect()->route('departments.index')->with('success', 'Department deleted successfully');
    }
}