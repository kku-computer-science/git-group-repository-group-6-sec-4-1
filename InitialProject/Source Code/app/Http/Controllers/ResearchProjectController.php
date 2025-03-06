<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\ResearchProject;
use App\Models\User;
use App\Events\UserActionEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Fund;
use App\Models\Outsider;

class ResearchProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
        if (Auth::user()->hasRole('admin')) {
            $researchProjects = ResearchProject::with('User')->get();
        } elseif (Auth::user()->hasRole('headproject')) {
            $researchProjects = ResearchProject::with('User')->get();
        } elseif (Auth::user()->hasRole('staff')) {
            $researchProjects = ResearchProject::with('User')->get();
        } else {
            $researchProjects = User::find($id)->researchProject()->get();
        }

        return view('research_projects.index', compact('researchProjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::role(['teacher', 'student'])->get();
        $funds = Fund::get();
        $deps = Department::get();
        return view('research_projects.create', compact('users', 'funds', 'deps'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'project_name' => 'required',
                'budget' => 'required|numeric',
                'project_year' => 'required',
                'fund' => 'required',
                'head' => 'required'
            ],
            [
                'project_name.required' => 'ต้องใส่ข้อมูล ชื่อโครงการวิจัย',
                'budget.required' => 'ต้องใส่ข้อมูล งบประมาณ',
                'project_year.required' => 'ต้องใส่ข้อมูล ปีที่ยื่นขอ',
                'fund.required' => 'ต้องใส่ข้อมูล ทุนวิจัย',
                'head.required' => 'ต้องใส่ข้อมูล ผู้รับผิดชอบโครงการ',
            ]
        );

        $user = Auth::user();
        $fund = Fund::find($request->fund);
        $headUser = User::find($request->head);
        $req = $request->all();

        $researchProject = $fund->researchProject()->create($req);

        $head = $request->head;
        $researchProject->user()->attach($head, ['role' => 1]);

        if (isset($request->moreFields)) {
            foreach ($request->moreFields as $value) {
                if ($value['userid'] != null) {
                    $researchProject->user()->attach($value, ['role' => 2]);
                }
            }
        }

        $input = $request->except(['_token']);
        if (isset($input['fname'][0]) && !empty($input['fname'][0])) {
            foreach ($request->input('fname') as $key => $value) {
                // Decode Unicode if necessary and ensure plain text
                $titleName = $this->decodeUnicode($request->input('title_name')[$key] ?? '');
                $firstName = $this->decodeUnicode($request->input('fname')[$key] ?? '');
                $lastName = $this->decodeUnicode($request->input('lname')[$key] ?? '');

                $data = [
                    'fname' => $firstName,
                    'lname' => $lastName,
                    'title_name' => $titleName,
                ];

                $outsider = Outsider::where([['fname', '=', $firstName], ['lname', '=', $lastName]])->first();
                if (!$outsider) {
                    $outsider = new Outsider;
                    $outsider->fname = $firstName;
                    $outsider->lname = $lastName;
                    $outsider->title_name = $titleName;
                    $outsider->save();
                }
                $researchProject->outsider()->attach($outsider->id, ['role' => 2]);
            }
        }

        // Log all validated input data for the research project
        $logDetails = [
            'target' => 'research_project',
            'research_project_id' => $researchProject->id,
        ];

        // Add all validated request data (except _token and any sensitive fields)
        $validatedData = $request->except(['_token', 'moreFields']); // Exclude dynamic fields and token
        foreach ($validatedData as $key => $value) {
            if (is_array($value)) {
                // Handle arrays like title_name, fname, and lname by taking the first element or decoding if needed
                if (in_array($key, ['title_name', 'fname', 'lname'])) {
                    $logDetails[$key] = $this->decodeUnicode($value[0] ?? '');
                } else {
                    $logDetails[$key] = json_encode($value); // Keep other arrays as JSON if needed
                }
            } else {
                $logDetails[$key] = $value;
            }
        }

        // Add fund name and head name
        $logDetails['fund_name'] = $fund->fund_name;
        $logDetails['head_name'] = trim($headUser->fname_en . ' ' . $headUser->lname_en);

        event(new UserActionEvent(
            $user,
            'insert',
            $logDetails
        ));

        return redirect()->route('researchProjects.index')->with('success', 'Research project created successfully.');
    }

    /**
     * Helper method to decode Unicode escape sequences to readable text.
     */
    private function decodeUnicode($str)
    {
        if (is_string($str) && preg_match('/^\\\\u[0-9A-Fa-f]{4,5}$/', $str)) {
            return json_decode('"' . $str . '"');
        }
        return $str; // Return as-is if not a Unicode escape sequence
    }

    /**
     * Display the specified resource.
     */
    public function show(ResearchProject $researchProject)
    {
        return view('research_projects.show', compact('researchProject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ResearchProject $researchProject)
    {
        $this->authorize('update', $researchProject);
        $researchProject = ResearchProject::with(['user'])->where('id', $researchProject->id)->first();
        $users = User::role(['teacher', 'student'])->get();
        $funds = Fund::get();
        $deps = Department::get();
        return view('research_projects.edit', compact('researchProject', 'users', 'funds', 'deps'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ResearchProject $researchProject)
    {
        $request->validate(
            [
                'project_name' => 'required',
                'budget' => 'required|numeric',
                'project_year' => 'required',
                'fund' => 'required',
                'head' => 'required'
            ],
            [
                'project_name.required' => 'ต้องใส่ข้อมูล ชื่อโครงการวิจัย',
                'budget.required' => 'ต้องใส่ข้อมูล งบประมาณ',
                'project_year.required' => 'ต้องใส่ข้อมูล ปีที่ยื่นขอ',
                'fund.required' => 'ต้องใส่ข้อมูล ทุนวิจัย',
                'head.required' => 'ต้องใส่ข้อมูล ผู้รับผิดชอบโครงการ',
            ]
        );

        $user = Auth::user();
        $this->authorize('update', $researchProject);

        $before = $researchProject->only(['project_name', 'budget', 'project_year', 'fund_id']);
        $req = $request->all();
        $researchProject->update($req);
        $after = $researchProject->only(['project_name', 'budget', 'project_year', 'fund_id']);

        $changes = [];
        foreach ($before as $key => $value) {
            if ($value != $after[$key]) {
                $changes['before'][$key] = $value;
                $changes['after'][$key] = $after[$key];
            }
        }

        $researchProject->user()->detach();
        $head = $request->head;
        $headUser = User::find($head);
        $fund = Fund::find($request->fund);
        $researchProject->user()->attach($head, ['role' => 1]);

        if (isset($request->moreFields)) {
            foreach ($request->moreFields as $value) {
                if ($value['userid'] != null) {
                    $researchProject->user()->attach($value, ['role' => 2]);
                }
            }
        }

        $input = $request->except(['_token']);
        $researchProject->outsider()->detach();
        if (isset($input['fname'][0]) && !empty($input['fname'][0])) {
            foreach ($request->input('fname') as $key => $value) {
                $data = [
                    'fname' => $input['fname'][$key],
                    'lname' => $input['lname'][$key],
                    'title_name' => $input['title_name'][$key],
                ];

                $outsider = Outsider::where([['fname', '=', $data['fname']], ['lname', '=', $data['lname']]])->first();
                if (!$outsider) {
                    $outsider = new Outsider;
                    $outsider->fname = $data['fname'];
                    $outsider->lname = $data['lname'];
                    $outsider->title_name = $data['title_name'];
                    $outsider->save();
                }
                $researchProject->outsider()->attach($outsider->id, ['role' => 2]);
            }
        }

        if (!empty($changes)) {
            event(new UserActionEvent(
                $user,
                'update',
                [
                    'target' => 'research_project',
                    'changes' => $changes,
                    'research_project_id' => $researchProject->id
                ]
            ));
        }

        return redirect()->route('researchProjects.index')->with('success', 'Research Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ResearchProject $researchProject)
    {
        $user = Auth::user();
        $this->authorize('delete', $researchProject);

        $projectName = $researchProject->project_name;
        $fund = Fund::find($researchProject->fund_id);
        $headUser = $researchProject->user()->wherePivot('role', 1)->first(); // Assuming head has role 1
        $projectId = $researchProject->id;
        $researchProject->delete();

        event(new UserActionEvent(
            $user,
            'delete',
            [
                'target' => 'research_project',
                'project_name' => $projectName,
                'research_project_id' => $projectId
            ]
        ));

        return redirect()->route('researchProjects.index')->with('success', 'Research Project deleted successfully');
    }
}