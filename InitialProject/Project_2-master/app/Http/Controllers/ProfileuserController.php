<?php

namespace App\Http\Controllers;

use App\Models\Educaton;
use App\Events\UserActionEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Models\User;
use App\Models\Expertise;

class ProfileuserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index(Request $request)
{
    $users = User::all(); // ดึงข้อมูลผู้ใช้ทั้งหมด
    $user = auth()->user();

    // Logic จาก logs()
    $logPath = storage_path('logs/activity.log');
    $userFilter = $request->query('user_id');
    $search = $request->query('search');

    if (!File::exists($logPath)) {
        return view('dashboards.users.index', [
            'users' => $users,
            'pagedLogs' => null
        ]);
    }

    $logs = array_reverse(explode("\n", File::get($logPath)));
    $parsedLogs = [];
    $usersById = $users->keyBy('id');

    foreach ($logs as $log) {
        if (trim($log) && preg_match('/^\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\]/', $log)) {
            $jsonStart = strpos($log, '{');
            $message = $jsonStart !== false ? trim(substr($log, 0, $jsonStart)) : $log;
            $jsonData = $jsonStart !== false ? json_decode(substr($log, $jsonStart), true) : null;

            $action = 'Unknown';
            $details = [];

            if ($jsonData && is_array($jsonData)) {
                $action = $jsonData['action'] ?? $this->extractActionFromMessage($message);
                $details = $jsonData['details'] ?? [];
                if (empty($details) && in_array($action, ['login', 'logout'])) {
                    $details = ['target' => 'session'];
                }
            } else {
                $action = $this->extractActionFromMessage($message);
                if (in_array($action, ['login', 'logout'])) {
                    $details = ['target' => 'session'];
                } else {
                    $details = ['raw' => $log];
                }
            }

            $userId = $jsonData['user_id'] ?? 'Unknown';
            $user = $usersById->get($userId);

            if ($userFilter && $userId != $userFilter) {
                continue;
            }
            if ($search && !str_contains(strtolower($log), strtolower($search))) {
                continue;
            }

            $parsedLogs[] = [
                'user_id' => $userId,
                'email' => $jsonData['email'] ?? 'Unknown',
                'first_name' => $user ? $user->fname_en : 'Unknown',
                'last_name' => $user ? $user->lname_en : 'Unknown',
                'action' => $action,
                'details' => $details,
                'timestamp' => $jsonData['timestamp'] ?? $this->extractTimestamp($log),
                'ip' => $jsonData['ip'] ?? 'Unknown',
            ];
        }
    }

    usort($parsedLogs, fn($a, $b) => strcmp($b['timestamp'], $a['timestamp']));

    $perPage = 20;
    $currentPage = $request->get('page', 1);
    $pagedLogs = new LengthAwarePaginator(
        array_slice($parsedLogs, ($currentPage - 1) * $perPage, $perPage),
        count($parsedLogs),
        $perPage,
        $currentPage,
        ['path' => url('/dashboard'), 'query' => $request->query()] // เปลี่ยน path เป็น /dashboard หรือตาม route ของคุณ
    );

    return view('dashboards.users.index', [
        'users' => $users,
        'pagedLogs' => $pagedLogs
    ]);
}

    function profile()
    {
        return view('dashboards.users.profile');
    }

    function settings()
    {
        return view('dashboards.users.settings');
    }

    function updateInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname_en' => 'required',
            'lname_en' => 'required',
            'fname_th' => 'required',
            'lname_th' => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $id = Auth::user()->id;
            $user = User::find($id);

            if ($request->title_name_en == "Mr.") {
                $title_name_th = 'นาย';
            }
            if ($request->title_name_en == "Miss") {
                $title_name_th = 'นางสาว';
            }
            if ($request->title_name_en == "Mrs.") {
                $title_name_th = 'นาง';
            }
            $pos_eng = '';
            $pos_thai = '';
            $doctoral = null;
            if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('student')) {
                $request->academic_ranks_en = null;
                $request->academic_ranks_th = null;
                $pos_eng = null;
                $pos_thai = null;
            } else {
                if ($request->academic_ranks_en == "Professor") {
                    $pos_en = 'Prof.';
                    $pos_th = 'ศ.';
                }
                if ($request->academic_ranks_en == "Associate Professo") {
                    $pos_en = 'Assoc. Prof.';
                    $pos_th = 'รศ.';
                }
                if ($request->academic_ranks_en == "Assistant Professor") {
                    $pos_en = 'Asst. Prof.';
                    $pos_th = 'ผศ.';
                }
                if ($request->academic_ranks_en == "Lecturer") {
                    $pos_en = 'Lecturer';
                    $pos_th = 'อ.';
                }
                if ($request->has('pos')) {
                    $pos_eng = $pos_en;
                    $pos_thai = $pos_th;
                } else {
                    if ($pos_en == "Lecturer") {
                        $pos_eng = $pos_en;
                        $pos_thai = $pos_th . 'ดร.';
                        $doctoral = 'Ph.D.';
                    } else {
                        $pos_eng = $pos_en . ' Dr.';
                        $pos_thai = $pos_th . 'ดร.';
                        $doctoral = 'Ph.D.';
                    }
                }
            }

            // เก็บข้อมูลก่อนอัปเดต (รวม fname_th และ lname_th)
            $before = $user->only(['fname_en', 'lname_en', 'email', 'title_name_en', 'academic_ranks_en', 'position_en', 'title_name_th', 'doctoral_degree', 'fname_th', 'lname_th']);
            $query = $user->update([
                'fname_en' => $request->fname_en,
                'lname_en' => $request->lname_en,
                'fname_th' => $request->fname_th,
                'lname_th' => $request->lname_th,
                'email' => $request->email,
                'academic_ranks_en' => $request->academic_ranks_en,
                'academic_ranks_th' => $request->academic_ranks_th,
                'position_en' => $pos_eng,
                'position_th' => $pos_thai,
                'title_name_en' => $request->title_name_en,
                'title_name_th' => $title_name_th,
                'doctoral_degree' => $doctoral,
            ]);

            if (!$query) {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong.']);
            } else {
                // เก็บข้อมูลหลังอัปเดต (รวม fname_th และ lname_th)
                $after = $user->only(['fname_en', 'lname_en', 'email', 'title_name_en', 'academic_ranks_en', 'position_en', 'title_name_th', 'doctoral_degree', 'fname_th', 'lname_th']);
                // ฟิลด์ที่ไม่ต้องการแสดง (เช่น fname_en)
                $excludedFields = ['fname_en']; // สามารถปรับได้ตามต้องการ
                // เปรียบเทียบและเก็บเฉพาะฟิลด์ที่มีการเปลี่ยนแปลง และไม่รวมฟิลด์ที่ระบุใน $excludedFields
                $changes = [];
                foreach ($before as $key => $value) {
                    if (!in_array($key, $excludedFields) && isset($after[$key]) && $this->compareValues($value, $after[$key])) {
                        $changes['before'][$key] = $value;
                        $changes['after'][$key] = $after[$key];
                    }
                }
                if (!empty($changes)) {
                    event(new UserActionEvent(
                        Auth::user(),
                        'update',
                        ['target' => 'profile', 'changes' => $changes]
                    ));
                }
                return response()->json(['status' => 1, 'msg' => 'success']);
            }
        }
    }

    // ฟังก์ชันช่วยเปรียบเทียบค่า (รองรับภาษาไทยและ Unicode)
    private function compareValues($value1, $value2)
    {
        // ตรวจสอบว่าเป็นสตริงหรือไม่ และแปลงเป็น UTF-8 เพื่อเปรียบเทียบ
        if (is_string($value1) && is_string($value2)) {
            return mb_strtolower(trim($value1), 'UTF-8') !== mb_strtolower(trim($value2), 'UTF-8');
        }
        return $value1 !== $value2;
    }

    // ฟังก์ชันอื่นๆ เช่น updatePicture, changePassword, logs, extractActionFromMessage, extractTimestamp คงเดิมแต่ต้องปรับ updatePicture และ changePassword ให้รวม fname_th และ lname_th ใน $before และ $after หากเกี่ยวข้อง

    function updatePicture(Request $request)
    {
        $path = 'images/imag_user/';
        $file = $request->file('admin_image');
        $new_name = 'UIMG_' . date('Ymd') . uniqid() . '.jpg';

        $upload = $file->move(public_path($path), $new_name);

        if (!$upload) {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong, upload new picture failed.']);
        } else {
            $user = User::find(Auth::user()->id);
            $oldPicture = $user->picture;

            if ($oldPicture != '' && File::exists(public_path($path . $oldPicture))) {
                File::delete(public_path($path . $oldPicture));
                // บันทึก log การลบรูปเก่า
                event(new UserActionEvent(
                    Auth::user(),
                    'delete',
                    ['target' => 'old_picture', 'filename' => $oldPicture]
                ));
            }

            // เก็บข้อมูลก่อนอัปเดต (รูปภาพเดิม)
            $before = ['picture' => $oldPicture];
            $update = $user->update(['picture' => $new_name]);

            if (!$update) {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong, updating picture in db failed.']);
            } else {
                // เก็บข้อมูลหลังอัปเดต (รูปภาพใหม่)
                $after = ['picture' => $new_name];
                // ฟิลด์ที่ไม่ต้องการแสดง (ไม่มีในกรณีนี้)
                $excludedFields = []; // สามารถปรับได้ตามต้องการ
                // เปรียบเทียบและเก็บเฉพาะฟิลด์ที่มีการเปลี่ยนแปลง
                $changes = [];
                foreach ($before as $key => $value) {
                    if (!in_array($key, $excludedFields) && $this->compareValues($value, $after[$key] ?? null)) {
                        $changes['before'][$key] = $value;
                        $changes['after'][$key] = $after[$key];
                    }
                }
                if (!empty($changes)) {
                    event(new UserActionEvent(
                        Auth::user(),
                        'update',
                        ['target' => 'picture', 'changes' => $changes]
                    ));
                }
                return response()->json(['status' => 1, 'msg' => 'Your profile picture has been updated successfully']);
            }
        }
    }

    function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldpassword' => [
                'required', function ($attribute, $value, $fail) {
                    if (!\Hash::check($value, Auth::user()->password)) {
                        return $fail(__('The current password is incorrect'));
                    }
                },
                'min:8',
                'max:30'
            ],
            'newpassword' => 'required|min:8|max:30',
            'cnewpassword' => 'required|same:newpassword'
        ], [
            'oldpassword.required' => 'Enter your current password',
            'oldpassword.min' => 'Old password must have atleast 8 characters',
            'oldpassword.max' => 'Old password must not be greater than 30 characters',
            'newpassword.required' => 'Enter new password',
            'newpassword.min' => 'New password must have atleast 8 characters',
            'newpassword.max' => 'New password must not be greater than 30 characters',
            'cnewpassword.required' => 'ReEnter your new password',
            'cnewpassword.same' => 'New password and Confirm new password must match'
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $user = User::find(Auth::user()->id);
            $update = $user->update(['password' => \Hash::make($request->newpassword)]);

            if (!$update) {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong, Failed to update password in db']);
            } else {
                // บันทึก log แค่บอกว่า "password has been changed" โดยไม่เก็บข้อมูลรหัส
                event(new UserActionEvent(
                    Auth::user(),
                    'update',
                    ['target' => 'password', 'message' => 'Password has been changed']
                ));
                return response()->json(['status' => 1, 'msg' => 'Your password has been changed successfully']);
            }
        }
    }

    public function logs(Request $request)
    {
        $logPath = storage_path('logs/activity.log');
        $userFilter = $request->query('user_id');
        $search = $request->query('search');

        if (!File::exists($logPath)) {
            return view('logs.index', ['pagedLogs' => null, 'users' => User::all()]);
        }

        $logs = array_reverse(explode("\n", File::get($logPath)));
        $parsedLogs = [];
        $users = User::all()->keyBy('id');

        foreach ($logs as $log) {
            if (trim($log) && preg_match('/^\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\]/', $log)) {
                $jsonStart = strpos($log, '{');
                $message = $jsonStart !== false ? trim(substr($log, 0, $jsonStart)) : $log;
                $jsonData = $jsonStart !== false ? json_decode(substr($log, $jsonStart), true) : null;

                $action = 'Unknown';
                $details = [];

                if ($jsonData && is_array($jsonData)) {
                    $action = $jsonData['action'] ?? $this->extractActionFromMessage($message);
                    $details = $jsonData['details'] ?? [];
                    if (empty($details) && in_array($action, ['login', 'logout'])) {
                        $details = ['target' => 'session'];
                    }
                } else {
                    $action = $this->extractActionFromMessage($message);
                    if (in_array($action, ['login', 'logout'])) {
                        $details = ['target' => 'session'];
                    } else {
                        $details = ['raw' => $log];
                    }
                }

                $userId = $jsonData['user_id'] ?? 'Unknown';
                $user = $users->get($userId);

                if ($userFilter && $userId != $userFilter) {
                    continue;
                }
                if ($search && !str_contains(strtolower($log), strtolower($search))) {
                    continue;
                }

                $parsedLogs[] = [
                    'user_id' => $userId,
                    'email' => $jsonData['email'] ?? 'Unknown',
                    'first_name' => $user ? $user->fname_en : 'Unknown',
                    'last_name' => $user ? $user->lname_en : 'Unknown',
                    'action' => $action,
                    'details' => $details,
                    'timestamp' => $jsonData['timestamp'] ?? $this->extractTimestamp($log),
                    'ip' => $jsonData['ip'] ?? 'Unknown',
                ];
            }
        }

        usort($parsedLogs, fn($a, $b) => strcmp($b['timestamp'], $a['timestamp']));

        $perPage = 20;
        $currentPage = $request->get('page', 1);
        $pagedLogs = new LengthAwarePaginator(
            array_slice($parsedLogs, ($currentPage - 1) * $perPage, $perPage),
            count($parsedLogs),
            $perPage,
            $currentPage,
            ['path' => url('/logs'), 'query' => $request->query()]
        );

        return view('logs.index', [
            'pagedLogs' => $pagedLogs,
            'users' => User::all(),
        ]);
    }

    private function extractActionFromMessage($message)
    {
        if (preg_match('/has (login|logout)/i', $message, $matches)) {
            return strtolower($matches[1]);
        }
        return 'Unknown';
    }

    private function extractTimestamp($logLine)
    {
        if (preg_match('/^\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\]/', $logLine, $matches)) {
            return $matches[1];
        }
        return null;
    }

    
}