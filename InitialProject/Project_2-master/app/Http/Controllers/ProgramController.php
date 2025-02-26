<?php

namespace App\Http\Controllers;

use App\Events\UserActionEvent;
use App\Models\Degree;
use App\Models\Department;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:programs-list|programs-create|programs-edit|programs-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:programs-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:programs-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:programs-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $programs = Program::all();
        $degree = Degree::all();
        $department = Department::all();
        return view('programs.index', compact('programs', 'degree', 'department'));
    }

    public function create()
    {
        return view('programs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'program_name_th' => 'required',
            'program_name_en' => 'required',
            'degree' => 'required',
            'department' => 'required',
        ]);

        $proId = $request->pro_id;
        $degree = Degree::find($request->degree);
        $department = Department::find($request->department);

        if (empty($proId)) {
            // Create new program
            $pro = new Program;
            $pro->program_name_en = $request->program_name_en;
            $pro->program_name_th = $request->program_name_th;
            $pro->degree()->associate($degree);
            $pro->department()->associate($department);
            $pro->save();
            $msg = 'Program entry created successfully.';
        } else {
            // Update existing program
            $pro = Program::find($proId);

            // Capture before state for logging
            $before = $pro->only(['program_name_th', 'program_name_en']);
            $beforeDegree = $pro->degree ? $pro->degree->degree_name_EN : null;
            $beforeDepartment = $pro->department ? $pro->department->department_name_en : null;

            $pro->program_name_en = $request->program_name_en;
            $pro->program_name_th = $request->program_name_th;
            $pro->degree()->associate($degree);
            $pro->department()->associate($department);
            $pro->save();
            $msg = 'Program data is updated successfully';
        }

        // Logging
        $logDetails = [
            'target' => 'program',
            'program_id' => $pro->id,
        ];

        $fieldLabels = [
            'program_name_th' => 'ชื่อหลักสูตร (ไทย)',
            'program_name_en' => 'ชื่อหลักสูตร (อังกฤษ)',
            'degree' => 'ระดับปริญญา',
            'department' => 'ภาควิชา'
        ];

        if (empty($proId)) {
            // Insert action
            $logDetails[$fieldLabels['program_name_th']] = $pro->program_name_th;
            $logDetails[$fieldLabels['program_name_en']] = $pro->program_name_en;
            $logDetails[$fieldLabels['degree']] = $degree->degree_name_EN;
            $logDetails[$fieldLabels['department']] = $department->department_name_en;

            event(new UserActionEvent(
                Auth::user(),
                'insert',
                $logDetails
            ));
        } else {
            // Update action
            $after = $pro->only(['program_name_th', 'program_name_en']);
            $afterDegree = $pro->degree ? $pro->degree->degree_name_EN : null;
            $afterDepartment = $pro->department ? $pro->department->department_name_en : null;

            $changes = [];
            foreach ($before as $key => $value) {
                if (isset($after[$key]) && $value != $after[$key]) {
                    $changes['before'][$fieldLabels[$key]] = $value;
                    $changes['after'][$fieldLabels[$key]] = $after[$key];
                }
            }

            if ($beforeDegree != $afterDegree) {
                $logDetails[$fieldLabels['degree']] = [
                    'before' => $beforeDegree,
                    'after' => $afterDegree
                ];
            }

            if ($beforeDepartment != $afterDepartment) {
                $logDetails[$fieldLabels['department']] = [
                    'before' => $beforeDepartment,
                    'after' => $afterDepartment
                ];
            }

            if (!empty($changes) || isset($logDetails[$fieldLabels['degree']]) || isset($logDetails[$fieldLabels['department']])) {
                if (!empty($changes)) {
                    $logDetails['changes'] = $changes;
                }
                event(new UserActionEvent(
                    Auth::user(),
                    'update',
                    $logDetails
                ));
            }
        }

        return redirect()->route('programs.index')->with('success', $msg);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $pro = Program::where($where)->first();
        return response()->json($pro);
    }

    public function update(Request $request, $id)
    {
        // Placeholder for update logic if implemented later
        $pro = Program::find($id);
        if (!$pro) {
            return response()->json(['error' => 'Program not found'], 404);
        }

        // Capture before state
        $before = $pro->only(['program_name_th', 'program_name_en']);
        $beforeDegree = $pro->degree ? $pro->degree->degree_name_EN : null;
        $beforeDepartment = $pro->department ? $pro->department->department_name_en : null;

        // Update logic (example, adjust as needed)
        $pro->update($request->all());
        if ($request->degree) {
            $degree = Degree::find($request->degree);
            $pro->degree()->associate($degree);
        }
        if ($request->department) {
            $department = Department::find($request->department);
            $pro->department()->associate($department);
        }
        $pro->save();

        // Capture after state
        $after = $pro->only(['program_name_th', 'program_name_en']);
        $afterDegree = $pro->degree ? $pro->degree->degree_name_EN : null;
        $afterDepartment = $pro->department ? $pro->department->department_name_en : null;

        // Logging
        $logDetails = [
            'target' => 'program',
            'program_id' => $pro->id,
        ];

        $fieldLabels = [
            'program_name_th' => 'ชื่อหลักสูตร (ไทย)',
            'program_name_en' => 'ชื่อหลักสูตร (อังกฤษ)',
            'degree' => 'ระดับปริญญา',
            'department' => 'ภาควิชา'
        ];

        $changes = [];
        foreach ($before as $key => $value) {
            if (isset($after[$key]) && $value != $after[$key]) {
                $changes['before'][$fieldLabels[$key]] = $value;
                $changes['after'][$fieldLabels[$key]] = $after[$key];
            }
        }

        if ($beforeDegree != $afterDegree) {
            $logDetails[$fieldLabels['degree']] = [
                'before' => $beforeDegree,
                'after' => $afterDegree
            ];
        }

        if ($beforeDepartment != $afterDepartment) {
            $logDetails[$fieldLabels['department']] = [
                'before' => $beforeDepartment,
                'after' => $afterDepartment
            ];
        }

        if (!empty($changes) || isset($logDetails[$fieldLabels['degree']]) || isset($logDetails[$fieldLabels['department']])) {
            if (!empty($changes)) {
                $logDetails['changes'] = $changes;
            }
            event(new UserActionEvent(
                Auth::user(),
                'update',
                $logDetails
            ));
        }

        return response()->json(['success' => 'Program updated successfully']);
    }

    public function destroy($id)
    {
        $pro = Program::find($id);

        // Logging
        $logDetails = [
            'target' => 'program',
            'program_id' => $pro->id,
        ];

        $fieldLabels = [
            'program_name_th' => 'ชื่อหลักสูตร (ไทย)',
            'program_name_en' => 'ชื่อหลักสูตร (อังกฤษ)'
        ];

        $logDetails[$fieldLabels['program_name_th']] = $pro->program_name_th;
        $logDetails[$fieldLabels['program_name_en']] = $pro->program_name_en;

        $pro->delete();

        event(new UserActionEvent(
            Auth::user(),
            'delete',
            $logDetails
        ));

        return response()->json(['success' => 'Program deleted successfully']);
    }
}