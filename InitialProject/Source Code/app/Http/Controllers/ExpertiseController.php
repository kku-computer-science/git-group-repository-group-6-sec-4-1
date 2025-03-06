<?php

namespace App\Http\Controllers;

use App\Events\UserActionEvent;
use App\Models\Expertise;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpertiseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $id = auth()->user()->id;
        if (auth()->user()->hasRole('admin')) {
            $experts = Expertise::all();
        } else {
            $experts = Expertise::with('user')->whereHas('user', function ($query) use ($id) {
                $query->where('users.id', '=', $id);
            })->paginate(10);
        }

        return view('expertise.index', compact('experts'));
    }

    public function create()
    {
        return view('expertise.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'expert_name' => 'required',
        ]);

        $exp_id = $request->exp_id;
        $user = Auth::user();

        if (empty($exp_id)) {
            // Create new expertise
            $expertise = Expertise::create([
                'expert_name' => $request->expert_name,
                'user_id' => $user->id,
            ]);

            // Logging
            $logDetails = [
                'target' => 'expertise',
                'expertise_id' => $expertise->id,
            ];

            $fieldLabels = [
                'expert_name' => 'ความเชี่ยวชาญ',
                'user_id' => 'ผู้ใช้'
            ];

            $logDetails[$fieldLabels['expert_name']] = $expertise->expert_name;
            $logDetails[$fieldLabels['user_id']] = trim($user->fname_en . ' ' . $user->lname_en);

            event(new UserActionEvent(
                $user,
                'insert',
                $logDetails
            ));

            $msg = 'Expertise entry created successfully.';
        } else {
            // Update existing expertise (handled here as per original logic)
            $expertise = Expertise::find($exp_id);

            if (!$expertise || ($expertise->user_id !== $user->id && !$user->hasRole('admin'))) {
                return response()->json(['status' => 0, 'msg' => 'Expertise not found or unauthorized.']);
            }

            $before = $expertise->only(['expert_name']);
            $expertise->update(['expert_name' => $request->expert_name]);
            $after = $expertise->only(['expert_name']);

            // Logging
            $logDetails = [
                'target' => 'expertise',
                'expertise_id' => $expertise->id,
            ];

            $fieldLabels = [
                'expert_name' => 'ความเชี่ยวชาญ'
            ];

            $changes = [];
            foreach ($before as $key => $value) {
                if ($value !== $after[$key]) {
                    $changes['before'][$fieldLabels[$key]] = $value;
                    $changes['after'][$fieldLabels[$key]] = $after[$key];
                }
            }

            if (!empty($changes)) {
                $logDetails['changes'] = $changes;
                event(new UserActionEvent(
                    $user,
                    'update',
                    $logDetails
                ));
            }

            $msg = 'Expertise data is updated successfully.';
        }

        if ($user->hasRole('admin')) {
            return redirect()->route('experts.index')->with('success', $msg);
        } else {
            return back()->withInput(['tab' => 'expertise'])->with('success', $msg);
        }
    }

    public function show(Expertise $expertise)
    {
        return response()->json($expertise);
    }

    public function edit($id)
    {
        $expertise = Expertise::find($id);
        if (!$expertise || ($expertise->user_id !== Auth::user()->id && !Auth::user()->hasRole('admin'))) {
            return response()->json(['status' => 0, 'msg' => 'Expertise not found or unauthorized.'], 403);
        }
        return response()->json($expertise);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'expert_name' => 'required',
        ]);

        $expertise = Expertise::find($id);
        $user = Auth::user();

        if (!$expertise || ($expertise->user_id !== $user->id && !$user->hasRole('admin'))) {
            return response()->json(['status' => 0, 'msg' => 'Expertise not found or unauthorized.'], 403);
        }

        $before = $expertise->only(['expert_name']);
        $expertise->update(['expert_name' => $request->expert_name]);
        $after = $expertise->only(['expert_name']);

        // Logging
        $logDetails = [
            'target' => 'expertise',
            'expertise_id' => $expertise->id,
        ];

        $fieldLabels = [
            'expert_name' => 'ความเชี่ยวชาญ'
        ];

        $changes = [];
        foreach ($before as $key => $value) {
            if ($value !== $after[$key]) {
                $changes['before'][$fieldLabels[$key]] = $value;
                $changes['after'][$fieldLabels[$key]] = $after[$key];
            }
        }

        if (!empty($changes)) {
            $logDetails['changes'] = $changes;
            event(new UserActionEvent(
                $user,
                'update',
                $logDetails
            ));
        }

        $msg = 'Expertise data is updated successfully.';
        if ($user->hasRole('admin')) {
            return redirect()->route('experts.index')->with('success', $msg);
        } else {
            return back()->withInput(['tab' => 'expertise'])->with('success', $msg);
        }
    }

    public function destroy($id)
    {
        $expertise = Expertise::find($id);
        $user = Auth::user();

        if (!$expertise || ($expertise->user_id !== $user->id && !$user->hasRole('admin'))) {
            return response()->json(['status' => 0, 'msg' => 'Expertise not found or unauthorized.'], 403);
        }

        $expertName = $expertise->expert_name;

        // Logging
        $logDetails = [
            'target' => 'expertise',
            'expertise_id' => $expertise->id,
        ];

        $fieldLabels = [
            'expert_name' => 'ความเชี่ยวชาญ'
        ];

        $logDetails[$fieldLabels['expert_name']] = $expertName;

        $expertise->delete();

        event(new UserActionEvent(
            $user,
            'delete',
            $logDetails
        ));

        $msg = 'Expertise entry deleted successfully.';
        if ($user->hasRole('admin')) {
            return redirect()->route('experts.index')->with('success', $msg);
        } else {
            return back()->withInput(['tab' => 'expertise'])->with('success', $msg);
        }
    }
}