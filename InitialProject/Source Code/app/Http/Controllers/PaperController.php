<?php

namespace App\Http\Controllers;

use App\Exports\ExportPaper;
use App\Exports\ExportUser;
use App\Exports\UsersExport;
use App\Events\UserActionEvent;
use App\Models\Author;
use App\Models\Paper;
use App\Models\Source_data;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class PaperController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;
        if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('staff')) {
            $papers = Paper::with('teacher', 'author')->orderBy('paper_yearpub', 'desc')->get();
        } else {
            $papers = Paper::with('teacher', 'author')->whereHas('teacher', function ($query) use ($id) {
                $query->where('users.id', '=', $id);
            })->orderBy('paper_yearpub', 'desc')->get();
        }
        return view('papers.index', compact('papers'));
    }

    public function create()
    {
        $source = Source_data::all();
        $users = User::role(['teacher', 'student'])->get();
        return view('papers.create', compact('source', 'users'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'paper_name' => 'required|unique:papers,paper_name',
            'paper_type' => 'required',
            'paper_sourcetitle' => 'required',
            'paper_yearpub' => 'required',
            'paper_volume' => 'required',
            'paper_doi' => 'required',
        ]);

        $input = $request->except(['_token']);
        $key = $input['keyword'];
        $key = explode(', ', $key);
        $myNewArray = [];
        foreach ($key as $val) {
            $myNewArray[] = ['$' => $val];
        }
        $input['keyword'] = $myNewArray;

        $paper = Paper::create($input);

        // Attach sources
        foreach ($request->cat as $value) {
            $paper->source()->attach($value);
        }

        // Attach teachers
        foreach ($request->moreFields as $key => $value) {
            if ($value['userid'] != null) {
                $paper->teacher()->attach($value, ['author_type' => $request->pos[$key]]);
            }
        }

        // Attach authors
        if (isset($input['fname'][0]) && !empty($input['fname'][0])) {
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
                $paper->author()->attach($author->id, ['author_type' => $request->pos2[$key]]);
            }
        }

        // Logging
        $logDetails = [
            'target' => 'paper',
            'paper_id' => $paper->id,
        ];

        $fieldLabels = [
            'paper_name' => 'ชื่อบทความ',
            'paper_type' => 'ประเภทบทความ',
            'paper_sourcetitle' => 'ชื่อวารสาร',
            'paper_yearpub' => 'ปีที่ตีพิมพ์',
            'paper_volume' => 'เล่มที่',
            'paper_issue' => 'ฉบับที่',
            'paper_citation' => 'การอ้างอิง',
            'paper_page' => 'หน้าที่',
            'paper_doi' => 'DOI',
            'keyword' => 'คำสำคัญ',
            'moreFields' => 'ผู้เขียน (อาจารย์/นักศึกษา)',
            'authors' => 'ผู้เขียน (ภายนอก)',
            'sources' => 'แหล่งข้อมูล'
        ];

        // Add validated input data
        foreach ($input as $key => $value) {
            if ($key === 'moreFields') {
                $teacherNames = [];
                foreach ($value as $teacher) {
                    if ($teacher['userid']) {
                        $user = User::find($teacher['userid']);
                        if ($user) {
                            $teacherNames[] = trim($user->fname_en . ' ' . $user->lname_en);
                        }
                    }
                }
                $logDetails[$fieldLabels['moreFields']] = $teacherNames ? implode(', ', $teacherNames) : 'ไม่มีผู้เขียน';
            } elseif ($key === 'fname' || $key === 'lname') {
                continue; // Handled separately below
            } elseif ($key === 'cat') {
                $sourceNames = Source_data::whereIn('id', $value)->pluck('source_name')->all();
                $logDetails[$fieldLabels['sources']] = implode(', ', $sourceNames);
            } else {
                $logDetails[$fieldLabels[$key] ?? $key] = is_array($value) ? json_encode($value) : $value;
            }
        }

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

        return redirect()->route('papers.index')->with('success', 'Paper created successfully.');
    }

    public function show(Paper $paper)
    {
        $k = collect($paper['keyword']);
        $val = $k->implode('$', ', ');
        $paper['keyword'] = $val;
        return view('papers.show', compact('paper'));
    }

    public function edit($id)
    {
        try {
            $id = decrypt($id);
            $paper = Paper::find($id);
            $k = collect($paper['keyword']);
            $val = $k->implode('$', ', ');
            $paper['keyword'] = $val;
            $this->authorize('update', $paper);
            $sources = Source_data::pluck('source_name', 'source_name')->all();
            $paperSource = $paper->source->pluck('source_name', 'source_name')->all();
            $users = User::role(['teacher', 'student'])->get();
            return view('papers.edit', compact('paper', 'users', 'paperSource', 'sources'));
        } catch (DecryptException $e) {
            return abort(404, "page not found");
        }
    }

    public function update(Request $request, Paper $paper)
    {
        $this->validate($request, [
            'paper_type' => 'required',
            'paper_sourcetitle' => 'required',
            'paper_volume' => 'required',
            'paper_issue' => 'required',
            'paper_citation' => 'required',
            'paper_page' => 'required',
        ]);
    
        \Log::info('Form Input Before Update:', $request->all());
    
        // Capture before state
        $before = $paper->only(['paper_name', 'paper_type', 'paper_sourcetitle', 'paper_yearpub', 'paper_volume', 'paper_issue', 'paper_citation', 'paper_page', 'paper_doi', 'keyword']);
        $beforeTeachers = $paper->teacher()->get()->map(fn($user) => ['userid' => $user->id, 'name' => trim($user->fname_en . ' ' . $user->lname_en)]);
        $beforeAuthors = $paper->author()->get()->map(fn($author) => trim($author->author_fname . ' ' . $author->author_lname));
        $beforeSources = $paper->source()->pluck('source_name')->all();
        \Log::info('Before State:', ['fields' => $before, 'teachers' => $beforeTeachers, 'authors' => $beforeAuthors, 'sources' => $beforeSources]);
    
        $input = $request->except(['_token']);
        $key = $input['keyword'] ?? $paper->keyword;
        $key = explode(', ', $key);
        $myNewArray = [];
        foreach ($key as $val) {
            $myNewArray[] = ['$' => $val];
        }
        $input['keyword'] = $myNewArray;
    
        $paper->update($input);
        $paper->refresh();
    
        $paper->author()->detach();
        $paper->teacher()->detach();
        $paper->source()->detach();
    
        foreach ($request->sources ?? [] as $value) {
            $source = Source_data::where('source_name', $value)->first();
            if ($source) {
                $paper->source()->attach($source->id);
            }
        }
    
        foreach ($request->moreFields ?? [] as $key => $value) {
            if ($value['userid'] != null) {
                $paper->teacher()->attach($value, ['author_type' => $input['pos'][$key] ?? 2]);
            }
        }
    
        if (isset($input['fname'][0]) && !empty($input['fname'][0])) {
            foreach ($request->input('fname') as $key => $value) {
                $data = ['fname' => $input['fname'][$key], 'lname' => $input['lname'][$key]];
                $author = Author::where([['author_fname', $data['fname']], ['author_lname', $data['lname']]])->first();
                if (!$author) {
                    $author = Author::create(['author_fname' => $data['fname'], 'author_lname' => $data['lname']]);
                }
                $paper->author()->attach($author->id, ['author_type' => $request->pos2[$key] ?? 2]);
            }
        }
    
        // Capture after state
        $after = $paper->only(['paper_name', 'paper_type', 'paper_sourcetitle', 'paper_yearpub', 'paper_volume', 'paper_issue', 'paper_citation', 'paper_page', 'paper_doi', 'keyword']);
        $afterTeachers = $paper->teacher()->get()->map(fn($user) => ['userid' => $user->id, 'name' => trim($user->fname_en . ' ' . $user->lname_en)]);
        $afterAuthors = $paper->author()->get()->map(fn($author) => trim($author->author_fname . ' ' . $author->author_lname));
        $afterSources = $paper->source()->pluck('source_name')->all();
        \Log::info('After State:', ['fields' => $after, 'teachers' => $afterTeachers, 'authors' => $afterAuthors, 'sources' => $afterSources]);
    
        // Logging
        $logDetails = [
            'target' => 'paper',
            'paper_id' => $paper->id,
        ];
    
        $fieldLabels = [
            'paper_name' => 'ชื่อบทความ',
            'paper_type' => 'ประเภทบทความ',
            'paper_sourcetitle' => 'ชื่อวารสาร',
            'paper_yearpub' => 'ปีที่ตีพิมพ์',
            'paper_volume' => 'เล่มที่',
            'paper_issue' => 'ฉบับที่',
            'paper_citation' => 'การอ้างอิง',
            'paper_page' => 'หน้าที่',
            'paper_doi' => 'DOI',
            'keyword' => 'คำสำคัญ',
            'moreFields' => 'ผู้เขียน (อาจารย์/นักศึกษา)',
            'authors' => 'ผู้เขียน (ภายนอก)',
            'sources' => 'แหล่งข้อมูล'
        ];
    
        // Compare fields
        $changes = [];
        foreach ($before as $key => $value) {
            if (isset($after[$key])) {
                $changed = (is_array($value) && is_array($after[$key])) ? ($value !== $after[$key]) : ($value != $after[$key]);
                \Log::info("Comparing $key: Before=" . json_encode($value) . ", After=" . json_encode($after[$key]) . ", Changed=" . ($changed ? 'Yes' : 'No'));
                if ($changed) {
                    $changes['before'][$fieldLabels[$key]] = is_array($value) ? json_encode($value) : $value;
                    $changes['after'][$fieldLabels[$key]] = is_array($after[$key]) ? json_encode($after[$key]) : $after[$key];
                }
            }
        }
    
        // Compare teachers
        $beforeTeacherNames = $beforeTeachers->pluck('name')->all();
        $afterTeacherNames = $afterTeachers->pluck('name')->all();
        if ($beforeTeacherNames != $afterTeacherNames) {
            $logDetails[$fieldLabels['moreFields']] = [
                'before' => $beforeTeacherNames ? implode(', ', $beforeTeacherNames) : 'ไม่มีผู้เขียน',
                'after' => $afterTeacherNames ? implode(', ', $afterTeacherNames) : 'ไม่มีผู้เขียน'
            ];
        }
    
        // Compare authors
        if ($beforeAuthors != $afterAuthors) {
            $logDetails[$fieldLabels['authors']] = [
                'before' => $beforeAuthors ? implode(', ', $beforeAuthors) : 'ไม่มีผู้เขียน',
                'after' => $afterAuthors ? implode(', ', $afterAuthors) : 'ไม่มีผู้เขียน'
            ];
        }
    
        // Compare sources
        if ($beforeSources != $afterSources) {
            $logDetails[$fieldLabels['sources']] = [
                'before' => implode(', ', $beforeSources),
                'after' => implode(', ', $afterSources)
            ];
        }
    
        if (!empty($changes) || isset($logDetails[$fieldLabels['moreFields']]) || isset($logDetails[$fieldLabels['authors']]) || isset($logDetails[$fieldLabels['sources']])) {
            \Log::info('Final Log Details:', $logDetails);
            event(new UserActionEvent(
                Auth::user(),
                'update',
                $logDetails
            ));
        } else {
            \Log::info('No changes detected for paper update', ['paper_id' => $paper->id]);
        }
    
        return redirect()->route('papers.index')->with('success', 'Paper updated successfully');
    }

    public function export(Request $request)
    {
        return Excel::download(new ExportUser, 'papers.xlsx');
    }
}