<?php

namespace App\Http\Controllers;

use App\Events\UserActionEvent;
use App\Models\Academicwork;
use App\Models\Paper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;
        if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('staff')) {
            $books = Academicwork::where('ac_type', '=', 'book')->get();
        } else {
            $books = Academicwork::with('user')->whereHas('user', function ($query) use ($id) {
                $query->where('users.id', '=', $id);
            })->paginate(10);
        }
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'ac_name' => 'required',
            'ac_year' => 'required',
        ]);

        $input = $request->except(['_token']);
        $input['ac_type'] = 'book';
        $acw = Academicwork::create($input);
        $id = auth()->user()->id;
        $user = User::find($id);
        $user->academicworks()->attach($acw);

        // Logging
        $logDetails = [
            'target' => 'book',
            'book_id' => $acw->id,
        ];

        $fieldLabels = [
            'ac_name' => 'ชื่อหนังสือ',
            'ac_year' => 'ปีที่ตีพิมพ์',
            'ac_sourcetitle' => 'สถานที่ตีพิมพ์',
            'ac_page' => 'จำนวนหน้า',
            'ac_issue' => 'ฉบับที่'
        ];

        foreach ($input as $key => $value) {
            if (array_key_exists($key, $fieldLabels)) {
                $logDetails[$fieldLabels[$key]] = is_array($value) ? json_encode($value) : $value;
            }
        }

        event(new UserActionEvent(
            Auth::user(),
            'insert',
            $logDetails
        ));

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function show($id)
    {
        $paper = Academicwork::find($id);
        return view('books.show', compact('paper'));
    }

    public function edit($id)
    {
        $book = Academicwork::find($id);
        $this->authorize('update', $book);
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $book = Academicwork::find($id);

        $this->validate($request, [
            'ac_name' => 'required',
            'ac_year' => 'required',
        ]);

        // Capture before state
        $before = $book->only(['ac_name', 'ac_year', 'ac_sourcetitle', 'ac_page', 'ac_issue']);

        $input = $request->except(['_token']);
        $input['ac_type'] = 'book';
        $book->update($input);

        // Capture after state
        $after = $book->only(['ac_name', 'ac_year', 'ac_sourcetitle', 'ac_page', 'ac_issue']);

        // Logging
        $logDetails = [
            'target' => 'book',
            'book_id' => $book->id,
        ];

        $fieldLabels = [
            'ac_name' => 'ชื่อหนังสือ',
            'ac_year' => 'ปีที่ตีพิมพ์',
            'ac_sourcetitle' => 'สถานที่ตีพิมพ์',
            'ac_page' => 'จำนวนหน้า',
            'ac_issue' => 'ฉบับที่'
        ];

        // Compare fields
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

        return redirect()->route('books.index')->with('success', 'Book updated successfully');
    }

    public function destroy($id)
    {
        $book = Academicwork::find($id);
        $this->authorize('delete', $book);

        // Logging
        $logDetails = [
            'target' => 'book',
            'book_id' => $book->id,
        ];

        $fieldLabels = [
            'ac_name' => 'ชื่อหนังสือ',
            'ac_year' => 'ปีที่ตีพิมพ์',
            'ac_sourcetitle' => 'สถานที่ตีพิมพ์',
            'ac_page' => 'จำนวนหน้า',
            'ac_issue' => 'ฉบับที่'
        ];

        $logDetails[$fieldLabels['ac_name']] = $book->ac_name;
        $logDetails[$fieldLabels['ac_year']] = $book->ac_year;
        // Include optional fields if they exist
        if ($book->ac_sourcetitle) $logDetails[$fieldLabels['ac_sourcetitle']] = $book->ac_sourcetitle;
        if ($book->ac_page) $logDetails[$fieldLabels['ac_page']] = $book->ac_page;
        if ($book->ac_issue) $logDetails[$fieldLabels['ac_issue']] = $book->ac_issue;

        $book->delete();

        event(new UserActionEvent(
            Auth::user(),
            'delete',
            $logDetails
        ));

        return redirect()->route('books.index')->with('success', 'Book deleted successfully');
    }
}