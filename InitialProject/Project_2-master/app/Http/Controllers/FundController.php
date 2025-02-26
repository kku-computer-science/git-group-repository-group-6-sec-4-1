<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use App\Models\User;
use App\Events\UserActionEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class FundController extends Controller
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
            $funds = Fund::with('User')->get();
        } elseif (auth()->user()->hasRole('headproject')) {
            $funds = Fund::with('User')->get();
        } elseif (auth()->user()->hasRole('staff')) {
            $funds = Fund::with('User')->get();
        } else {
            $funds = User::find($id)->fund()->get();
        }

        return view('funds.index', compact('funds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('funds.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fund_name' => 'required',
            'fund_type' => 'required',
            'support_resource' => 'required',
        ]);

        $user = Auth::user();
        $input = $request->all();

        if ($request->fund_type == 'ทุนภายนอก') {
            $input['fund_level'] = null;
        }

        $fund = $user->fund()->create($input);

        event(new UserActionEvent(
            $user,
            'insert',
            [
                'target' => 'fund',
                'fund_name' => $fund->fund_name,
                'fund_type' => $fund->fund_type,
                'support_resource' => $fund->support_resource,
                'fund_id' => $fund->id
            ]
        ));

        return redirect()->route('funds.index')->with('success', 'Fund created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fund $fund)
    {
        return view('funds.show', compact('fund'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fu_id = Crypt::decrypt($id);
        $fund = Fund::find($fu_id);
        $this->authorize('update', $fund);
        return view('funds.edit', compact('fund'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fund $fund)
    {
        $request->validate([
            'fund_name' => 'required',
            'fund_type' => 'required',
            'support_resource' => 'required',
        ]);

        $user = Auth::user();
        $this->authorize('update', $fund);

        $before = $fund->only(['fund_name', 'fund_type', 'support_resource', 'fund_level']);
        $input = $request->all();

        if ($request->fund_type == 'ทุนภายนอก') {
            $input['fund_level'] = null;
        }

        $fund->update($input);
        $after = $fund->only(['fund_name', 'fund_type', 'support_resource', 'fund_level']);

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
                ['target' => 'fund', 'changes' => $changes, 'fund_id' => $fund->id]
            ));
        }

        return redirect()->route('funds.index')->with('success', 'Fund updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fund $fund)
    {
        $user = Auth::user();
        $this->authorize('delete', $fund);

        $fundName = $fund->fund_name;
        $fundId = $fund->id;
        $fund->delete();

        event(new UserActionEvent(
            $user,
            'delete',
            ['target' => 'fund', 'fund_name' => $fundName, 'fund_id' => $fundId]
        ));

        return redirect()->route('funds.index')->with('success', 'Fund deleted successfully');
    }
}