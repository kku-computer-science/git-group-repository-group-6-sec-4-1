<?php

namespace App\Http\Controllers;

use App\Models\Educaton;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Models\User;

class ProfileuserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index()
    {

        //return view('dashboards.admins.index');
        $users = User::get();
        $user = auth()->user();
        //$user->givePermissionTo('readpaper');
        //return view('home');
        return view('dashboards.users.index', compact('users'));
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

            if ($request->title_name_en == "Mr.") {
                $title_name_th = 'นาย';
            }
            if ($request->title_name_en == "Miss") {
                $title_name_th = 'นางสาว';
            }
            if ($request->title_name_en == "Mrs.") {
                $title_name_th = 'นาง';
            }
            // $pos_en='';
            // $pos_th='';
            // $doctoral = '';
            $pos_eng = '';
            $pos_thai = '';
            if (Auth::user()->hasRole('admin') or Auth::user()->hasRole('student') ) {
                $request->academic_ranks_en = null;
                $request->academic_ranks_th = null;
                $pos_eng = null;
                $pos_thai = null;
                $doctoral = null;
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
                    //$doctoral = null ;
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
            $query = User::find($id)->update([
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
                return response()->json(['status' => 1, 'msg' => 'success']);
            }
        }
    }

    function updatePicture(Request $request)
    {
        $path = 'images/imag_user/';
        //return 'aaaaaa';
        $file = $request->file('admin_image');
        $new_name = 'UIMG_' . date('Ymd') . uniqid() . '.jpg';

        //dd(public_path());
        //Upload new image
        $upload = $file->move(public_path($path), $new_name);
        //$filename = time() . '.' . $file->getClientOriginalExtension();
        //$upload = $file->move('user/images', $filename);


        if (!$upload) {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong, upload new picture failed.']);
        } else {
            //Get Old picture
            $oldPicture = User::find(Auth::user()->id)->getAttributes()['picture'];

            if ($oldPicture != '') {
                if (\File::exists(public_path($path . $oldPicture))) {
                    \File::delete(public_path($path . $oldPicture));
                }
            }

            //Update DB
            $update = User::find(Auth::user()->id)->update(['picture' => $new_name]);

            if (!$upload) {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong, updating picture in db failed.']);
            } else {
                return response()->json(['status' => 1, 'msg' => 'Your profile picture has been updated successfully']);
            }
        }
    }


    function changePassword(Request $request)
    {
        //Validate form
        $validator = \Validator::make($request->all(), [
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

            $update = User::find(Auth::user()->id)->update(['password' => \Hash::make($request->newpassword)]);

            if (!$update) {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong, Failed to update password in db']);
            } else {
                return response()->json(['status' => 1, 'msg' => 'Your password has been changed successfully']);
            }
        }
    }

    public function logs(Request $request)
    {
        $logType = $request->query('type'); // ถ้ามี type จะกรองเฉพาะไฟล์นั้น
        $logDir = storage_path('logs');
        $allLogs = [];

        // ดึงไฟล์ log ทั้งหมด
        $logFiles = File::files($logDir);

        foreach ($logFiles as $file) {
            $fileName = $file->getFilename();
            if ($logType && $fileName !== "{$logType}.log") {
                continue; // กรองเฉพาะ logType ถ้ามีการระบุ
            }

            $content = array_reverse(explode("\n", File::get($file->getPathname())));
            foreach ($content as $line) {
                if (trim($line)) {
                    // เพิ่มชื่อไฟล์และบรรทัด log เข้าไป
                    $allLogs[] = [
                        'file' => $fileName,
                        'line' => $line,
                        'timestamp' => $this->extractTimestamp($line) ?: null,
                    ];
                }
            }
        }

        // เรียงลำดับตาม timestamp (ถ้ามี) หรือตามลำดับไฟล์
        usort($allLogs, function ($a, $b) {
            if ($a['timestamp'] && $b['timestamp']) {
                return strcmp($b['timestamp'], $a['timestamp']); // เรียงจากใหม่ไปเก่า
            }
            return strcmp($a['file'], $b['file']); // ถ้าไม่มี timestamp ให้เรียงตามชื่อไฟล์
        });

        // แบ่งหน้า
        $perPage = 20;
        $currentPage = $request->get('page', 1);
        $pagedLogs = new LengthAwarePaginator(
            array_slice($allLogs, ($currentPage - 1) * $perPage, $perPage),
            count($allLogs),
            $perPage,
            $currentPage,
            ['path' => url('/logs') . ($logType ? "?type={$logType}" : '')]
        );

        return view('logs.index', compact('pagedLogs', 'logType'));
    }

    // ฟังก์ชันช่วยดึง timestamp จาก log
    private function extractTimestamp($logLine)
    {
        if (preg_match('/^\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\]/', $logLine, $matches)) {
            return $matches[1];
        }
        return null;
    }

    public function exportLogs(Request $request)
    {
        $logType = $request->query('type'); // ถ้ามี type จะส่งออกเฉพาะไฟล์นั้น
        $logDir = storage_path('logs');
        $exportContent = '';

        $logFiles = File::files($logDir);
        foreach ($logFiles as $file) {
            $fileName = $file->getFilename();
            if ($logType && $fileName !== "{$logType}.log") {
                continue;
            }
            $exportContent .= "=== {$fileName} ===\n" . File::get($file->getPathname()) . "\n\n";
        }

        if (empty($exportContent)) {
            return redirect()->back()->with('error', 'ไม่มีไฟล์ Log ให้ดาวน์โหลด');
        }

        $fileName = ($logType ? $logType : 'all_logs') . "_" . now()->format('Ymd_His') . ".txt";
        return response($exportContent)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', "attachment; filename={$fileName}");
    }

}
