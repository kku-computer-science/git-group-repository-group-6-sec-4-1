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

    function updateEdInfo(Request $request)
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
        } else {
            $id = Auth::user()->id;
            $user = User::find($id);

            // เก็บข้อมูลก่อนอัปเดตสำหรับแต่ละ level
            $levels = [1 => 'b_', 2 => 'm_', 3 => 'd_'];
            $changes = [];

            foreach ($levels as $level => $prefix) {
                $existingEducation = $user->education()->where('level', $level)->first();

                // เก็บข้อมูลก่อนอัปเดต (รวมทุกฟิลด์) และแปลงเป็นสตริงสำหรับเปรียบเทียบ
                $before = $existingEducation ? $existingEducation->only(['uname', 'qua_name', 'year']) : ['uname' => null, 'qua_name' => null, 'year' => null];
                $beforeString = json_encode($before); // แปลงเป็น JSON เพื่อเปรียบเทียบ

                // ข้อมูลใหม่จาก request
                $newData = [
                    'uname' => $request->{$prefix . 'uname'},
                    'qua_name' => $request->{$prefix . 'qua_name'},
                    'year' => $request->{$prefix . 'year'},
                    'level' => $level,
                    'user_id' => $id,
                ];

                // อัปเดตหรือสร้างข้อมูลใหม่
                $education = $user->education()->updateOrCreate(
                    ['level' => $level],
                    $newData
                );

                // เก็บข้อมูลหลังอัปเดต (รวมทุกฟิลด์)
                $after = $education->only(['uname', 'qua_name', 'year']);
                $afterString = json_encode($after); // แปลงเป็น JSON เพื่อเปรียบเทียบ

                // เพิ่มการ debug เพื่อตรวจสอบข้อมูล
                \Log::debug('Education Update Comparison', ['level' => $level, 'before' => $before, 'after' => $after, 'beforeString' => $beforeString, 'afterString' => $afterString]);

                // เปรียบเทียบข้อมูลก่อนและหลัง (ใช้ JSON เพื่อตรวจสอบการเปลี่ยนแปลงอย่างละเอียด)
                if ($beforeString !== $afterString) {
                    $changes[$level] = [
                        'before' => $before,
                        'after' => $after,
                    ];
                }
            }

            // บันทึก log ถ้ามีการเปลี่ยนแปลง
            if (!empty($changes)) {
                event(new UserActionEvent(
                    Auth::user(),
                    'update',
                    ['target' => 'education', 'changes' => $changes]
                ));
            } else {
                \Log::warning('No changes detected in education update for user ' . $id);
            }

            return response()->json(['status' => 1, 'msg' => 'Your profile info has been updated successfully.']);
        }
    }
}