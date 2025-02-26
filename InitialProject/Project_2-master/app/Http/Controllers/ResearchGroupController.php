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

    public function create()
    {
        $users = User::role(['teacher', 'student'])->get();
        $funds = Fund::get();
        return view('research_groups.create', compact('users', 'funds'));
    }

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

        $logDetails = [
            'target' => 'research_group',
            'research_group_id' => $researchGroup->id,
        ];

        $fieldLabels = [
            'group_name_th' => 'ชื่อกลุ่มวิจัย',
            'group_name_en' => 'Group Name (English)',
            'group_desc_th' => 'คำอธิบายกลุ่ม (ไทย)',
            'group_desc_en' => 'Group Description (English)',
            'group_detail_en' => 'Group Detail (English)',
            'moreFields' => 'สมาชิก',
            'group_image' => 'ภาพกลุ่ม',
            'head_name' => 'หัวหน้า',
        ];

        $validatedData = $request->except(['_token', 'group_image']);
        foreach ($validatedData as $key => $value) {
            if ($key === 'head') {
                continue;
            } elseif ($key === 'moreFields' && is_array($value)) {
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
                $logDetails[$fieldLabels[$key] ?? $key] = is_array($value) ? json_encode($value) : $value;
            }
        }

        $headUser = User::find($head);
        $logDetails[$fieldLabels['head_name']] = trim($headUser->fname_en . ' ' . $headUser->lname_en);
        $logDetails[$fieldLabels['group_image']] = $input['group_image'] ?? null;

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

    public function show(ResearchGroup $researchGroup)
    {
        return view('research_groups.show', compact('researchGroup'));
    }

    public function edit(ResearchGroup $researchGroup)
    {
        $researchGroup = ResearchGroup::find($researchGroup->id);
        $this->authorize('update', $researchGroup);
        $researchGroup = ResearchGroup::with(['user'])->where('id', $researchGroup->id)->first();
        $users = User::get();
        return view('research_groups.edit', compact('researchGroup', 'users'));
    }

    public function update(Request $request, ResearchGroup $researchGroup)
    {
        $request->validate([
            'group_name_th' => 'required',
            'group_name_en' => 'required',
        ]);

        $user = Auth::user();
        $this->authorize('update', $researchGroup);

        // Define custom labels for fields (same as store)
        $fieldLabels = [
            'group_name_th' => 'ชื่อกลุ่มวิจัย',
            'group_name_en' => 'Group Name (English)',
            'group_desc_th' => 'คำอธิบายกลุ่ม (ไทย)',
            'group_desc_en' => 'Group Description (English)',
            'group_detail_en' => 'Group Detail (English)',
            'moreFields' => 'สมาชิก',
            'group_image' => 'ภาพกลุ่ม',
            'head_name' => 'หัวหน้า',
        ];

        // Capture the before state
        $before = $researchGroup->only(['group_name_th', 'group_name_en', 'group_desc_th', 'group_desc_en', 'group_detail_en', 'group_image']);
        $beforeUsers = $researchGroup->user()->get()->map(function ($user) {
            return [
                'userid' => $user->id,
                'name' => trim($user->fname_en . ' ' . $user->lname_en),
                'role' => $user->pivot->role
            ];
        })->toArray();

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

        // Capture the after state
        $after = $researchGroup->only(['group_name_th', 'group_name_en', 'group_desc_th', 'group_desc_en', 'group_detail_en', 'group_image']);
        $afterUsers = [];
        $headUser = User::find($head);
        if ($headUser) {
            $afterUsers[] = [
                'userid' => $headUser->id,
                'name' => trim($headUser->fname_en . ' ' . $headUser->lname_en),
                'role' => 1
            ];
        }
        if ($request->moreFields) {
            foreach ($request->moreFields as $value) {
                if ($value['userid'] != null) {
                    $memberUser = User::find($value['userid']);
                    if ($memberUser) {
                        $afterUsers[] = [
                            'userid' => $memberUser->id,
                            'name' => trim($memberUser->fname_en . ' ' . $memberUser->lname_en),
                            'role' => 2
                        ];
                    }
                }
            }
        }

        // Build log details
        $logDetails = [
            'target' => 'research_group',
            'research_group_id' => $researchGroup->id,
        ];

        // Compare tracked fields
        $changes = [];
        foreach ($before as $key => $value) {
            if ($value != $after[$key]) {
                $changes['before'][$fieldLabels[$key] ?? $key] = $value;
                $changes['after'][$fieldLabels[$key] ?? $key] = $after[$key];
            }
        }

        // Compare members
        $beforeUserIds = array_column($beforeUsers, 'userid');
        $afterUserIds = array_column($afterUsers, 'userid');
        $memberChanges = [];

        // Head change
        $beforeHead = array_filter($beforeUsers, fn($user) => $user['role'] == 1);
        $afterHead = array_filter($afterUsers, fn($user) => $user['role'] == 1);
        $beforeHeadName = !empty($beforeHead) ? reset($beforeHead)['name'] : null;
        $afterHeadName = !empty($afterHead) ? reset($afterHead)['name'] : null;
        if ($beforeHeadName !== $afterHeadName) {
            $logDetails[$fieldLabels['head_name']] = [
                'before' => $beforeHeadName,
                'after' => $afterHeadName
            ];
        }

        // Members change
        $beforeMembers = array_filter($beforeUsers, fn($user) => $user['role'] == 2);
        $afterMembers = array_filter($afterUsers, fn($user) => $user['role'] == 2);
        $beforeMemberNames = array_column($beforeMembers, 'name');
        $afterMemberNames = array_column($afterMembers, 'name');
        if ($beforeMemberNames != $afterMemberNames) {
            $memberChanges['before'] = $beforeMemberNames ? implode(', ', $beforeMemberNames) : 'ไม่มีสมาชิก';
            $memberChanges['after'] = $afterMemberNames ? implode(', ', $afterMemberNames) : 'ไม่มีสมาชิก';
            $logDetails[$fieldLabels['moreFields']] = $memberChanges;
        }

        // Add changes to log details
        if (!empty($changes)) {
            $logDetails['changes'] = $changes;
        }

        // Trigger event if there are any changes
        if (!empty($changes) || isset($logDetails[$fieldLabels['head_name']]) || isset($logDetails[$fieldLabels['moreFields']])) {
            event(new UserActionEvent(
                $user,
                'update',
                $logDetails
            ));
        }

        return redirect()->route('researchGroups.index')
            ->with('success', 'Research group updated successfully');
    }

    public function destroy(ResearchGroup $researchGroup)
{
    $user = Auth::user();
    $this->authorize('delete', $researchGroup);

    // Define custom labels for fields (only essentials)
    $fieldLabels = [
        'group_name_th' => 'ชื่อกลุ่มวิจัย',
        'group_name_en' => 'Group Name (English)',
    ];

    // Capture essential data before deletion
    $logDetails = [
        'target' => 'research_group',
        'research_group_id' => $researchGroup->id,
    ];

    $logDetails[$fieldLabels['group_name_th']] = $researchGroup->group_name_th;
    $logDetails[$fieldLabels['group_name_en']] = $researchGroup->group_name_en;

    $researchGroup->delete();

    event(new UserActionEvent(
        $user,
        'delete',
        $logDetails
    ));

    return redirect()->route('researchGroups.index')
        ->with('success', 'Research group deleted successfully');
}
}