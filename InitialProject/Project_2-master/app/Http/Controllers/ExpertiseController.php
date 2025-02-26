<?php

namespace App\Http\Controllers;

use App\Models\Expertise;
use App\Models\User;
use App\Events\UserActionEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpertiseController extends Controller
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('expertise.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

            event(new UserActionEvent(
                $user,
                'insert',
                ['target' => 'expertise', 'expert_name' => $request->expert_name, 'expertise_id' => $expertise->id]
            ));

            $msg = 'Expertise entry created successfully.';
        } else {
            // This should ideally be handled by the update method, but we'll keep it here for now
            $expertise = Expertise::find($exp_id);

            if (!$expertise || ($expertise->user_id !== $user->id && !$user->hasRole('admin'))) {
                return response()->json(['status' => 0, 'msg' => 'Expertise not found or unauthorized.']);
            }

            $before = $expertise->only(['expert_name']);
            $expertise->update(['expert_name' => $request->expert_name]);
            $after = $expertise->only(['expert_name']);

            $changes = [];
            foreach ($before as $key => $value) {
                if ($value !== $after[$key]) {
                    $changes['before'][$key] = $value;
                    $changes['after'][$key] = $after[$key];
                }
            }

            if (!empty($changes)) {
                event(new UserActionEvent(
                    $user,
                    'update',
                    ['target' => 'expertise', 'changes' => $changes, 'expertise_id' => $expertise->id]
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

    /**
     * Display the specified resource.
     */
    public function show(Expertise $expertise)
    {
        return response()->json($expertise);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $expertise = Expertise::find($id);
        if (!$expertise || ($expertise->user_id !== Auth::user()->id && !Auth::user()->hasRole('admin'))) {
            return response()->json(['status' => 0, 'msg' => 'Expertise not found or unauthorized.'], 403);
        }
        return response()->json($expertise);
    }

    /**
     * Update the specified resource in storage.
     */
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

        $changes = [];
        foreach ($before as $key => $value) {
            if ($value !== $after[$key]) {
                $changes['before'][$key] = $value;
                $changes['after'][$key] = $after[$key];
            }
        }

        if (!empty($changes)) {
            event(new UserActionEvent(
                $user,
                'update',
                ['target' => 'expertise', 'changes' => $changes, 'expertise_id' => $expertise->id]
            ));
        }

        $msg = 'Expertise data is updated successfully.';
        if ($user->hasRole('admin')) {
            return redirect()->route('experts.index')->with('success', $msg);
        } else {
            return back()->withInput(['tab' => 'expertise'])->with('success', $msg);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $expertise = Expertise::find($id);
        $user = Auth::user();

        if (!$expertise || ($expertise->user_id !== $user->id && !$user->hasRole('admin'))) {
            return response()->json(['status' => 0, 'msg' => 'Expertise not found or unauthorized.'], 403);
        }

        $expertName = $expertise->expert_name;
        $expertise->delete();

        event(new UserActionEvent(
            $user,
            'delete',
            ['target' => 'expertise', 'expert_name' => $expertName, 'expertise_id' => $id]
        ));

        $msg = 'Expertise entry deleted successfully.';
        if ($user->hasRole('admin')) {
            return redirect()->route('experts.index')->with('success', $msg);
        } else {
            return back()->withInput(['tab' => 'expertise'])->with('success', $msg);
        }
    }
}