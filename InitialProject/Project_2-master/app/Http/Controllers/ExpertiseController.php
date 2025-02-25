<?php

namespace App\Http\Controllers;

use App\Models\Expertise;
use App\Models\User;
use App\Events\UserActionEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExpertiseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expertise.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'expert_name' => 'required|string|max:255',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $expertise = Expertise::create([
                'expert_name' => $request->expert_name,
                'user_id' => Auth::user()->id, // เก็บ user_id ของผู้ใช้ที่ล็อกอิน
            ]);

            if ($expertise) {
                event(new UserActionEvent(
                    Auth::user(),
                    'insert',
                    ['target' => 'expertise', 'expert_name' => $request->expert_name, 'expertise_id' => $expertise->id]
                ));
                if (auth()->user()->hasRole('admin')) {
                    return redirect()->route('experts.index')->with('success', 'Expertise entry created successfully.');
                } else {
                    return back()->withInput(['tab' => 'expertise'])->with('success', 'Your expertise info has been created successfully.');
                }
            } else {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong.']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Expertise $expertise)
    {
        return response()->json($expertise);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $exp = Expertise::where($where)->first();
        return response()->json($exp);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'expert_name' => 'required|string|max:255',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $expertise = Expertise::find($id);

            if (!$expertise || ($expertise->user_id !== Auth::user()->id && !auth()->user()->hasRole('admin'))) {
                return response()->json(['status' => 0, 'msg' => 'Expertise not found or unauthorized.']);
            }

            // เก็บข้อมูลก่อนอัปเดต
            $before = $expertise->only(['expert_name']);
            $update = $expertise->update([
                'expert_name' => $request->expert_name,
            ]);

            if ($update) {
                // เก็บข้อมูลหลังอัปเดต
                $after = $expertise->only(['expert_name']);
                // เปรียบเทียบและเก็บเฉพาะฟิลด์ที่มีการเปลี่ยนแปลง
                $changes = [];
                foreach ($before as $key => $value) {
                    if (isset($after[$key]) && $value !== $after[$key]) {
                        $changes['before'][$key] = $value;
                        $changes['after'][$key] = $after[$key];
                    }
                }
                if (!empty($changes)) {
                    event(new UserActionEvent(
                        Auth::user(),
                        'update',
                        ['target' => 'expertise', 'changes' => $changes, 'expertise_id' => $expertise->id]
                    ));
                }
                if (auth()->user()->hasRole('admin')) {
                    return redirect()->route('experts.index')->with('success', 'Expertise data is updated successfully.');
                } else {
                    return back()->withInput(['tab' => 'expertise'])->with('success', 'Your expertise info has been updated successfully.');
                }
            } else {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong.']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expertise = Expertise::find($id);

        if (!$expertise || ($expertise->user_id !== Auth::user()->id && !auth()->user()->hasRole('admin'))) {
            return response()->json(['status' => 0, 'msg' => 'Expertise not found or unauthorized.']);
        }

        $expertName = $expertise->expert_name;
        $expertise->delete();

        event(new UserActionEvent(
            Auth::user(),
            'delete',
            ['target' => 'expertise', 'expert_name' => $expertName, 'expertise_id' => $id]
        ));

        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('experts.index')->with('success', 'Expertise entry deleted successfully.');
        } else {
            return back()->withInput(['tab' => 'expertise'])->with('success', 'Your expertise info has been deleted successfully.');
        }
    }
}