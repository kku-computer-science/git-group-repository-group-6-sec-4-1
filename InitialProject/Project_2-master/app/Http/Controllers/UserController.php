<?php

namespace App\Http\Controllers;

use App\Events\UserActionEvent;
use App\Models\Department;
use App\Models\Program;
use DB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data = User::all();
        return view('users.index', compact('data'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $departments = Department::all();
        return view('users.create', compact('roles', 'departments'));
    }

    public function getCategory(Request $request)
    {
        $cat = $request->cat_id;
        $subcat = Program::with('degree')->where('department_id', 1)->get();
        return response()->json($subcat);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'fname_en' => 'required',
            'lname_en' => 'required',
            'fname_th' => 'required',
            'lname_th' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'roles' => 'required',
            'sub_cat' => 'required',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'fname_en' => $request->fname_en,
            'lname_en' => $request->lname_en,
            'fname_th' => $request->fname_th,
            'lname_th' => $request->lname_th,
        ]);

        $user->assignRole($request->roles);
        $pro_id = $request->sub_cat;
        $program = Program::find($pro_id);
        $user->program()->associate($program)->save();

        // Logging
        $logDetails = [
            'target' => 'user',
            'user_id' => $user->id,
        ];

        $fieldLabels = [
            'fname_en' => 'ชื่อ (อังกฤษ)',
            'lname_en' => 'นามสกุล (อังกฤษ)',
            'fname_th' => 'ชื่อ (ไทย)',
            'lname_th' => 'นามสกุล (ไทย)',
            'email' => 'อีเมล',
            'roles' => 'บทบาท',
            'sub_cat' => 'หลักสูตร'
        ];

        foreach ($request->only(array_keys($fieldLabels)) as $key => $value) {
            if ($key === 'sub_cat') {
                $logDetails[$fieldLabels[$key]] = $program ? $program->program_name_en : 'Unknown';
            } elseif ($key === 'roles') {
                $logDetails[$fieldLabels[$key]] = implode(', ', $value);
            } else {
                $logDetails[$fieldLabels[$key]] = $value;
            }
        }

        event(new UserActionEvent(
            Auth::user(),
            'insert',
            $logDetails
        ));

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $departments = Department::all();
        $id = $user->program->department_id;
        $programs = Program::whereHas('department', function ($q) use ($id) {
            $q->where('id', '=', $id);
        })->get();
        $roles = Role::pluck('name', 'name')->all();
        $deps = Department::pluck('department_name_EN', 'department_name_EN')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        $userDep = $user->department()->pluck('department_name_EN', 'department_name_EN')->all();
        return view('users.edit', compact('user', 'roles', 'deps', 'userRole', 'userDep', 'programs', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'fname_en' => 'required',
            'fname_th' => 'required',
            'lname_en' => 'required',
            'lname_th' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'confirmed',
            'roles' => 'required'
        ]);

        $user = User::find($id);

        // Capture before state
        $before = $user->only(['fname_en', 'lname_en', 'fname_th', 'lname_th', 'email']);
        $beforeRoles = $user->roles->pluck('name')->all();
        $beforeProgram = $user->program ? $user->program->program_name_en : null;

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, ['password']);
        }

        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));

        $pro_id = $request->sub_cat;
        $program = Program::find($pro_id);
        $user->program()->associate($program)->save();

        // Capture after state
        $after = $user->only(['fname_en', 'lname_en', 'fname_th', 'lname_th', 'email']);
        $afterRoles = $user->roles->pluck('name')->all();
        $afterProgram = $user->program ? $user->program->program_name_en : null;

        // Logging
        $logDetails = [
            'target' => 'user',
            'user_id' => $user->id,
        ];

        $fieldLabels = [
            'fname_en' => 'ชื่อ (อังกฤษ)',
            'lname_en' => 'นามสกุล (อังกฤษ)',
            'fname_th' => 'ชื่อ (ไทย)',
            'lname_th' => 'นามสกุล (ไทย)',
            'email' => 'อีเมล',
            'roles' => 'บทบาท',
            'sub_cat' => 'หลักสูตร'
        ];

        // Compare fields
        $changes = [];
        foreach ($before as $key => $value) {
            if (isset($after[$key]) && $value != $after[$key]) {
                $changes['before'][$fieldLabels[$key]] = $value;
                $changes['after'][$fieldLabels[$key]] = $after[$key];
            }
        }

        // Compare roles
        if ($beforeRoles != $afterRoles) {
            $logDetails[$fieldLabels['roles']] = [
                'before' => implode(', ', $beforeRoles),
                'after' => implode(', ', $afterRoles)
            ];
        }

        // Compare program
        if ($beforeProgram != $afterProgram) {
            $logDetails[$fieldLabels['sub_cat']] = [
                'before' => $beforeProgram,
                'after' => $afterProgram
            ];
        }

        // Log password change (without revealing the password)
        if (!empty($request->password)) {
            $logDetails['message'] = 'รหัสผ่านถูกเปลี่ยนแปลง';
        }

        if (!empty($changes) || isset($logDetails[$fieldLabels['roles']]) || isset($logDetails[$fieldLabels['sub_cat']]) || isset($logDetails['message'])) {
            if (!empty($changes)) {
                $logDetails['changes'] = $changes;
            }
            event(new UserActionEvent(
                Auth::user(),
                'update',
                $logDetails
            ));
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        // Logging
        $logDetails = [
            'target' => 'user',
            'user_id' => $user->id,
        ];

        $fieldLabels = [
            'fname_en' => 'ชื่อ (อังกฤษ)',
            'lname_en' => 'นามสกุล (อังกฤษ)',
            'fname_th' => 'ชื่อ (ไทย)',
            'lname_th' => 'นามสกุล (ไทย)',
            'email' => 'อีเมล'
        ];

        $logDetails[$fieldLabels['fname_en']] = $user->fname_en;
        $logDetails[$fieldLabels['lname_en']] = $user->lname_en;
        $logDetails[$fieldLabels['fname_th']] = $user->fname_th;
        $logDetails[$fieldLabels['lname_th']] = $user->lname_th;
        $logDetails[$fieldLabels['email']] = $user->email;

        $user->delete();

        event(new UserActionEvent(
            Auth::user(),
            'delete',
            $logDetails
        ));

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    function profile()
    {
        return view('dashboards.users.profile');
    }

    function updatePicture(Request $request)
    {
        $path = 'images/imag_user/';
        $file = $request->file('admin_image');
        $new_name = 'UIMG_' . date('Ymd') . uniqid() . '.jpg';

        $upload = $file->move(public_path($path), $new_name);

        if (!$upload) {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong, upload new picture failed.']);
        }

        $user = User::find(Auth::user()->id);
        $oldPicture = $user->getAttributes()['picture'];

        if ($oldPicture != '' && \File::exists(public_path($path . $oldPicture))) {
            \File::delete(public_path($path . $oldPicture));
            event(new UserActionEvent(
                Auth::user(),
                'delete',
                ['target' => 'old_picture', 'filename' => $oldPicture]
            ));
        }

        // Capture before state
        $before = ['picture' => $oldPicture];

        $update = $user->update(['picture' => $new_name]);

        // Capture after state
        $after = ['picture' => $new_name];

        if (!$update) {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong, updating picture in db failed.']);
        }

        // Logging
        $logDetails = [
            'target' => 'user_picture',
            'user_id' => $user->id,
        ];

        $fieldLabels = [
            'picture' => 'รูปภาพโปรไฟล์'
        ];

        $changes = [];
        foreach ($before as $key => $value) {
            if (isset($after[$key]) && $value != $after[$key]) {
                $changes['before'][$fieldLabels[$key]] = $value;
                $changes['after'][$fieldLabels[$key]] = $after[$key];
            }
        }

        if (!empty($changes)) {
            $logDetails['changes'] = $changes;
            event(new UserActionEvent(
                Auth::user(),
                'update',
                $logDetails
            ));
        }

        return response()->json(['status' => 1, 'msg' => 'Your profile picture has been updated successfully']);
    }
}