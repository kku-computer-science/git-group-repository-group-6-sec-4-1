<?php

namespace App\Http\Controllers;

use App\Events\UserActionEvent;
use App\Models\Academicwork;
use App\Models\Author;
use App\Models\Paper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatentController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;
        if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('staff')) {
            $patents = Academicwork::where('ac_type', '!=', 'book')->get();
        } else {
            $patents = Academicwork::with('user')->where('ac_type', '!=', 'book')->whereHas('user', function ($query) use ($id) {
                $query->where('users.id', '=', $id);
            })->paginate(10);
        }
        return view('patents.index', compact('patents'));
    }

    public function create()
    {
        $users = User::role(['teacher', 'student'])->get();
        return view('patents.create', compact('users'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'ac_name' => 'required',
            'ac_type' => 'required',
            'ac_year' => 'required',
            'ac_refnumber' => 'required',
        ]);

        $input = $request->except(['_token']);
        $acw = Academicwork::create($input);

        $id = auth()->user()->id;
        $user = User::find($id);

        $x = 1;
        $length = count($request->moreFields);
        foreach ($request->moreFields as $key => $value) {
            if ($value['userid'] != null) {
                if ($x === 1) {
                    $acw->user()->attach($value, ['author_type' => 1]);
                } else if ($x === $length) {
                    $acw->user()->attach($value, ['author_type' => 3]);
                } else {
                    $acw->user()->attach($value, ['author_type' => 2]);
                }
            }
            $x++;
        }

        $x = 1;
        if (isset($input['fname'][0]) && !empty($input['fname'][0])) {
            $length = count($request->input('fname'));
            foreach ($request->input('fname') as $key => $value) {
                $data = [
                    'fname' => $input['fname'][$key],
                    'lname' => $input['lname'][$key]
                ];
                $author = Author::where([['author_fname', $data['fname']], ['author_lname', $data['lname']]])->first();
                if (!$author) {
                    $author = Author::create([
                        'author_fname' => $data['fname'],
                        'author_lname' => $data['lname']
                    ]);
                }
                if ($x === 1) {
                    $acw->author()->attach($author->id, ['author_type' => 1]);
                } else if ($x === $length) {
                    $acw->author()->attach($author->id, ['author_type' => 3]);
                } else {
                    $acw->author()->attach($author->id, ['author_type' => 2]);
                }
                $x++;
            }
        }

        // Logging
        $logDetails = [
            'target' => 'patent',
            'patent_id' => $acw->id,
        ];

        $fieldLabels = [
            'ac_name' => 'ชื่อสิทธิบัตร',
            'ac_type' => 'ประเภทสิทธิบัตร',
            'ac_year' => 'ปีที่จดทะเบียน',
            'ac_refnumber' => 'เลขที่อ้างอิง',
            'moreFields' => 'ผู้เขียน (อาจารย์/นักศึกษา)',
            'authors' => 'ผู้เขียน (ภายนอก)'
        ];

        foreach ($input as $key => $value) {
            if (array_key_exists($key, $fieldLabels)) {
                $logDetails[$fieldLabels[$key]] = is_array($value) ? json_encode($value) : $value;
            }
        }

        // Log teachers/students
        $teacherNames = [];
        foreach ($request->moreFields as $teacher) {
            if ($teacher['userid']) {
                $teacherUser = User::find($teacher['userid']);
                if ($teacherUser) {
                    $teacherNames[] = trim($teacherUser->fname_en . ' ' . $teacherUser->lname_en);
                }
            }
        }
        $logDetails[$fieldLabels['moreFields']] = $teacherNames ? implode(', ', $teacherNames) : 'ไม่มีผู้เขียน';

        // Log external authors
        if (isset($input['fname']) && !empty($input['fname'][0])) {
            $authorNames = [];
            foreach ($input['fname'] as $key => $fname) {
                $authorNames[] = trim($fname . ' ' . $input['lname'][$key]);
            }
            $logDetails[$fieldLabels['authors']] = implode(', ', $authorNames);
        }

        event(new UserActionEvent(
            Auth::user(),
            'insert',
            $logDetails
        ));

        return redirect()->route('patents.index')->with('success', 'Patent created successfully.');
    }

    public function show($id)
    {
        $patent = Academicwork::find($id);
        return view('patents.show', compact('patent'));
    }

    public function edit($id)
    {
        $patent = Academicwork::find($id);
        $this->authorize('update', $patent);
        $users = User::role(['teacher', 'student'])->get();
        return view('patents.edit', compact('patent', 'users'));
    }

    public function update(Request $request, $id)
    {
        $patent = Academicwork::find($id);

        // Capture before state
        $before = $patent->only(['ac_name', 'ac_type', 'ac_year', 'ac_refnumber']);
        $beforeTeachers = $patent->user()->get()->map(fn($user) => trim($user->fname_en . ' ' . $user->lname_en));
        $beforeAuthors = $patent->author()->get()->map(fn($author) => trim($author->author_fname . ' ' . $author->author_lname));

        $input = $request->except(['_token']);
        $patent->update([
            'ac_name' => $request->ac_name,
            'ac_type' => $request->ac_type,
            'ac_year' => $request->ac_year,
            'ac_refnumber' => $request->ac_refnumber,
        ]);

        $patent->user()->detach();
        $x = 1;
        $length = count($request->moreFields);
        foreach ($request->moreFields as $key => $value) {
            if ($value['userid'] != null) {
                if ($x === 1) {
                    $patent->user()->attach($value, ['author_type' => 1]);
                } else if ($x === $length) {
                    $patent->user()->attach($value, ['author_type' => 3]);
                } else {
                    $patent->user()->attach($value, ['author_type' => 2]);
                }
            }
            $x++;
        }

        $patent->author()->detach();
        $x = 1;
        if (isset($input['fname'][0]) && !empty($input['fname'][0])) {
            $length = count($request->input('fname'));
            foreach ($request->input('fname') as $key => $value) {
                $data = ['fname' => $input['fname'][$key], 'lname' => $input['lname'][$key]];
                $author = Author::where([['author_fname', $data['fname']], ['author_lname', $data['lname']]])->first();
                if (!$author) {
                    $author = Author::create(['author_fname' => $data['fname'], 'author_lname' => $data['lname']]);
                }
                if ($x === 1) {
                    $patent->author()->attach($author->id, ['author_type' => 1]);
                } else if ($x === $length) {
                    $patent->author()->attach($author->id, ['author_type' => 3]);
                } else {
                    $patent->author()->attach($author->id, ['author_type' => 2]);
                }
                $x++;
            }
        }

        // Capture after state
        $after = $patent->only(['ac_name', 'ac_type', 'ac_year', 'ac_refnumber']);
        $afterTeachers = $patent->user()->get()->map(fn($user) => trim($user->fname_en . ' ' . $user->lname_en));
        $afterAuthors = $patent->author()->get()->map(fn($author) => trim($author->author_fname . ' ' . $author->author_lname));

        // Logging
        $logDetails = [
            'target' => 'patent',
            'patent_id' => $patent->id,
        ];

        $fieldLabels = [
            'ac_name' => 'ชื่อสิทธิบัตร',
            'ac_type' => 'ประเภทสิทธิบัตร',
            'ac_year' => 'ปีที่จดทะเบียน',
            'ac_refnumber' => 'เลขที่อ้างอิง',
            'moreFields' => 'ผู้เขียน (อาจารย์/นักศึกษา)',
            'authors' => 'ผู้เขียน (ภายนอก)'
        ];

        // Compare fields
        $changes = [];
        foreach ($before as $key => $value) {
            if (isset($after[$key]) && $value != $after[$key]) {
                $changes['before'][$fieldLabels[$key]] = $value;
                $changes['after'][$fieldLabels[$key]] = $after[$key];
            }
        }

        // Compare teachers
        if ($beforeTeachers != $afterTeachers) {
            $logDetails[$fieldLabels['moreFields']] = [
                'before' => $beforeTeachers ? implode(', ', $beforeTeachers) : 'ไม่มีผู้เขียน',
                'after' => $afterTeachers ? implode(', ', $afterTeachers) : 'ไม่มีผู้เขียน'
            ];
        }

        // Compare authors
        if ($beforeAuthors != $afterAuthors) {
            $logDetails[$fieldLabels['authors']] = [
                'before' => $beforeAuthors ? implode(', ', $beforeAuthors) : 'ไม่มีผู้เขียน',
                'after' => $afterAuthors ? implode(', ', $afterAuthors) : 'ไม่มีผู้เขียน'
            ];
        }

        if (!empty($changes) || isset($logDetails[$fieldLabels['moreFields']]) || isset($logDetails[$fieldLabels['authors']])) {
            if (!empty($changes)) {
                $logDetails['changes'] = $changes;
            }
            event(new UserActionEvent(
                Auth::user(),
                'update',
                $logDetails
            ));
        }

        return redirect()->route('patents.index')->with('success', 'Patent updated successfully');
    }

    public function destroy($id)
    {
        $patent = Academicwork::find($id);
        $this->authorize('delete', $patent);

        // Logging
        $logDetails = [
            'target' => 'patent',
            'patent_id' => $patent->id,
        ];

        $fieldLabels = [
            'ac_name' => 'ชื่อสิทธิบัตร',
            'ac_type' => 'ประเภทสิทธิบัตร',
            'ac_year' => 'ปีที่จดทะเบียน',
            'ac_refnumber' => 'เลขที่อ้างอิง'
        ];

        $logDetails[$fieldLabels['ac_name']] = $patent->ac_name;
        $logDetails[$fieldLabels['ac_type']] = $patent->ac_type;
        $logDetails[$fieldLabels['ac_year']] = $patent->ac_year;
        $logDetails[$fieldLabels['ac_refnumber']] = $patent->ac_refnumber;

        $patent->delete();

        event(new UserActionEvent(
            Auth::user(),
            'delete',
            $logDetails
        ));

        return redirect()->route('patents.index')->with('success', 'Patent deleted successfully');
    }
}