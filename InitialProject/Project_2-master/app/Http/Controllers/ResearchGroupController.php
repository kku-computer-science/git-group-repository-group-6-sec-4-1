<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\ResearchGroup;
use App\Events\UserActionEvent;
use Illuminate\Http\Request;
use App\Models\Fund;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ResearchGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('permission:groups-list|groups-create|groups-edit|groups-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:groups-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:groups-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:groups-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $researchGroups = ResearchGroup::with('User')->get();
        return view('research_groups.index', compact('researchGroups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::role(['teacher', 'student'])->get();
        $funds = Fund::get();
        return view('research_groups.create', compact('users', 'funds'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'group_name_th' => 'required',
            'group_name_en' => 'required',
            'head' => 'required',
        ]);

        $user = Auth::user();
        $input = $request->all();

        if ($request->group_image) {
            $input['group_image'] = time() . '.' . $request->group_image->extension();
            $request->group_image->move(public_path('img'), $input['group_image']);
        }

        $researchGroup = ResearchGroup::create($input);
        $head = $request->head;
        $researchGroup->user()->attach($head, ['role' => 1]);

        if ($request->moreFields) {
            foreach ($request->moreFields as $value) {
                if ($value['userid'] != null) {
                    $researchGroup->user()->attach($value, ['role' => 2]);
                }
            }
        }

        // Log all validated input data for the research group with custom labels
        $logDetails = [
            'target' => 'research_group',
            'research_group_id' => $researchGroup->id,
        ];

        // Define custom labels for fields
        $fieldLabels = [
            'group_name_th' => 'ชื่อกลุ่มวิจัย',
            'group_name_en' => 'Group Name (English)',
            'group_desc_th' => 'คำอธิบายกลุ่ม (ไทย)',
            'group_desc_en' => 'Group Description (English)',
            'group_detail_en' => 'Group Detail (English)',
            'head_name' => 'หัวหน้า',
            'moreFields' => 'สมาชิก',
            'group_image' => 'ภาพกลุ่ม',
        ];

        // Add all validated request data (except _token and sensitive fields)
        $validatedData = $request->except(['_token']); // Exclude CSRF token
        foreach ($validatedData as $key => $value) {
            if ($key === 'head') {
                // Skip logging the head ID since we have head_name
                continue;
            } elseif ($key === 'moreFields' && is_array($value)) {
                // Transform moreFields into a list of member full names
                $memberNames = [];
                foreach ($value as $member) {
                    if (isset($member['userid']) && !empty($member['userid'])) {
                        $memberUser = User::find($member['userid']);
                        if ($memberUser) {
                            $memberNames[] = trim($memberUser->fname_en . ' ' . $memberUser->lname_en);
                        }
                    }
                }
                $logDetails[$fieldLabels[$key] ?? $key] = $memberNames ? implode(', ', $memberNames) : 'ไม่มีสมาชิก';
            } else {
                // Handle other fields with custom labels
                $logDetails[$fieldLabels[$key] ?? $key] = is_array($value) ? json_encode($value) : $value;
            }
        }

        // Add head name (full name)
        $headUser = User::find($head);
        $logDetails['head_name'] = trim($headUser->fname_en . ' ' . $headUser->lname_en);

        // Include group_image if uploaded
        $logDetails['group_image'] = $input['group_image'] ?? null;

        // If there’s a fund field, include its name (though it’s not validated, check if it exists)
        if ($request->has('fund')) {
            $fund = Fund::find($request->fund);
            $logDetails['fund_name'] = $fund->fund_name ?? 'Unknown';
        }

        event(new UserActionEvent(
            $user,
            'insert',
            $logDetails
        ));

        return redirect()->route('researchGroups.index')->with('success', 'Research group created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ResearchGroup $researchGroup)
    {
        return view('research_groups.show', compact('researchGroup'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ResearchGroup $researchGroup)
    {
        $researchGroup = ResearchGroup::find($researchGroup->id);
        $this->authorize('update', $researchGroup);
        $researchGroup = ResearchGroup::with(['user'])->where('id', $researchGroup->id)->first();
        $users = User::get();
        return view('research_groups.edit', compact('researchGroup', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ResearchGroup $researchGroup)
    {
        $request->validate([
            'group_name_th' => 'required',
            'group_name_en' => 'required',
        ]);

        $user = Auth::user();
        $this->authorize('update', $researchGroup);

        $before = $researchGroup->only(['group_name_th', 'group_name_en', 'group_image']);
        $input = $request->all();

        if ($request->group_image) {
            $input['group_image'] = time() . '.' . $request->group_image->extension();
            $request->group_image->move(public_path('img'), $input['group_image']);
        }

        $researchGroup->update($input);
        $head = $request->head;
        $researchGroup->user()->detach();
        $researchGroup->user()->attach([$head => ['role' => 1]]);

        if ($request->moreFields) {
            foreach ($request->moreFields as $value) {
                if ($value['userid'] != null) {
                    $researchGroup->user()->attach($value, ['role' => 2]);
                }
            }
        }

        $after = $researchGroup->only(['group_name_th', 'group_name_en', 'group_image']);

        $changes = [];
        foreach ($before as $key => $value) {
            if ($value != $after[$key]) {
                $changes['before'][$key] = $value;
                $changes['after'][$key] = $after[$key];
            }
        }

        $headUser = User::find($head);
        if (!empty($changes)) {
            event(new UserActionEvent(
                $user,
                'update',
                [
                    'target' => 'research_group',
                    'changes' => $changes,
                    'research_group_id' => $researchGroup->id,
                ]
            ));
        }

        return redirect()->route('researchGroups.index')
            ->with('success', 'Research group updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ResearchGroup $researchGroup)
    {
        $user = Auth::user();
        $this->authorize('delete', $researchGroup);

        $groupNameTh = $researchGroup->group_name_th;
        $groupNameEn = $researchGroup->group_name_en;
        $headUser = $researchGroup->user()->wherePivot('role', 1)->first(); // Assuming head has role 1
        $groupId = $researchGroup->id;
        $researchGroup->delete();

        event(new UserActionEvent(
            $user,
            'delete',
            [
                'target' => 'research_group',
                'group_name_th' => $groupNameTh,
                'group_name_en' => $groupNameEn,
                'research_group_id' => $groupId,
            ]
        ));

        return redirect()->route('researchGroups.index')
            ->with('success', 'Research group deleted successfully');
    }
}