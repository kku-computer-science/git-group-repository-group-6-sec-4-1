<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\User;
use App\Events\UserActionEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EducationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function updateEdInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'b_uname' => 'required',
            'b_qua_name' => 'required',
            'b_year' => 'required',
            'm_uname' => 'required',
            'm_qua_name' => 'required',
            'm_year' => 'required',
            'd_uname' => 'required',
            'd_qua_name' => 'required',
            'd_year' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $user = Auth::user();
        $id = $user->id;

        // Level 1: Bachelor's
        $bachelorData = [
            'uname' => $request->b_uname,
            'qua_name' => $request->b_qua_name,
            'year' => $request->b_year,
            'level' => 1,
        ];
        $bachelorBefore = Education::where('user_id', $id)->where('level', 1)->first();
        $bachelor = $user->education()->updateOrCreate(['level' => 1], $bachelorData);

        if (!$bachelorBefore) {
            // Insert
            event(new UserActionEvent(
                $user,
                'insert',
                ['target' => 'education', 'level' => 1, 'details' => $bachelorData, 'education_id' => $bachelor->id]
            ));
        } else {
            // Update
            $bachelorAfter = $bachelor->refresh()->only(['uname', 'qua_name', 'year']);
            $bachelorBeforeData = $bachelorBefore->only(['uname', 'qua_name', 'year']);
            $changes = [];
            foreach ($bachelorBeforeData as $key => $value) {
                if ($value !== $bachelorAfter[$key]) {
                    $changes['before'][$key] = $value;
                    $changes['after'][$key] = $bachelorAfter[$key];
                }
            }
            if (!empty($changes)) {
                event(new UserActionEvent(
                    $user,
                    'update',
                    ['target' => 'education', 'level' => 1, 'changes' => $changes, 'education_id' => $bachelor->id]
                ));
            }
        }

        // Level 2: Master's
        $masterData = [
            'uname' => $request->m_uname,
            'qua_name' => $request->m_qua_name,
            'year' => $request->m_year,
            'level' => 2,
        ];
        $masterBefore = Education::where('user_id', $id)->where('level', 2)->first();
        $master = $user->education()->updateOrCreate(['level' => 2], $masterData);

        if (!$masterBefore) {
            // Insert
            event(new UserActionEvent(
                $user,
                'insert',
                ['target' => 'education', 'level' => 2, 'details' => $masterData, 'education_id' => $master->id]
            ));
        } else {
            // Update
            $masterAfter = $master->refresh()->only(['uname', 'qua_name', 'year']);
            $masterBeforeData = $masterBefore->only(['uname', 'qua_name', 'year']);
            $changes = [];
            foreach ($masterBeforeData as $key => $value) {
                if ($value !== $masterAfter[$key]) {
                    $changes['before'][$key] = $value;
                    $changes['after'][$key] = $masterAfter[$key];
                }
            }
            if (!empty($changes)) {
                event(new UserActionEvent(
                    $user,
                    'update',
                    ['target' => 'education', 'level' => 2, 'changes' => $changes, 'education_id' => $master->id]
                ));
            }
        }

        // Level 3: Doctoral
        $doctoralData = [
            'uname' => $request->d_uname,
            'qua_name' => $request->d_qua_name,
            'year' => $request->d_year,
            'level' => 3,
        ];
        $doctoralBefore = Education::where('user_id', $id)->where('level', 3)->first();
        $doctoral = $user->education()->updateOrCreate(['level' => 3], $doctoralData);

        if (!$doctoralBefore) {
            // Insert
            event(new UserActionEvent(
                $user,
                'insert',
                ['target' => 'education', 'level' => 3, 'details' => $doctoralData, 'education_id' => $doctoral->id]
            ));
        } else {
            // Update
            $doctoralAfter = $doctoral->refresh()->only(['uname', 'qua_name', 'year']);
            $doctoralBeforeData = $doctoralBefore->only(['uname', 'qua_name', 'year']);
            $changes = [];
            foreach ($doctoralBeforeData as $key => $value) {
                if ($value !== $doctoralAfter[$key]) {
                    $changes['before'][$key] = $value;
                    $changes['after'][$key] = $doctoralAfter[$key];
                }
            }
            if (!empty($changes)) {
                event(new UserActionEvent(
                    $user,
                    'update',
                    ['target' => 'education', 'level' => 3, 'changes' => $changes, 'education_id' => $doctoral->id]
                ));
            }
        }

        return response()->json(['status' => 1, 'msg' => 'Your profile info has been updated successfully.']);
    }
}