<?php

namespace App\Http\Controllers;

use App\Events\UserActionEvent;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Paper;
use App\Models\Source_data;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ScopuscallController extends Controller
{
    public function create($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $data = User::find($id);

            // ตรวจสอบว่าผู้ใช้ที่เรียกคือผู้ใช้ที่ล็อกอิน
            if (Auth::user()->id !== $id) {
                return redirect()->back()->with('error', 'Unauthorized action.');
            }

            $fname = substr($data['fname_en'], 0, 1);
            $lname = $data['lname_en'];

            $url = Http::get('https://api.elsevier.com/content/search/scopus?', [
                'query' => "AUTHOR-NAME(" . "$lname" . "," . "$fname" . ")",
                'apikey' => '6ab3c2a01c29f0e36b00c8fa1d013f83',
            ])->json();

            $content = $url["search-results"]["entry"];
            $links = $url["search-results"]["link"];

            // ดึงข้อมูลจากหน้าเพิ่มเติม (pagination)
            do {
                $ref = 'prev';
                foreach ($links as $link) {
                    if ($link['@ref'] == 'next') {
                        $link2 = $link['@href'];
                        $link2 = Http::get("$link2")->json();
                        $links = $link2["search-results"]["link"];
                        $nextcontent = $link2["search-results"]["entry"];
                        foreach ($nextcontent as $item) {
                            array_push($content, $item);
                        }
                    }
                }
            } while ($ref != 'prev');

            $newPapersCount = 0; // นับจำนวน Paper ใหม่ที่เพิ่ม

            foreach ($content as $item) {
                if (array_key_exists('error', $item)) {
                    continue;
                }

                if (Paper::where('paper_name', '=', $item['dc:title'])->first() == null) {
                    $scoid = $item['dc:identifier'];
                    $scoid = explode(":", $scoid);
                    $scoid = $scoid[1];

                    $all = Http::get("https://api.elsevier.com/content/abstract/scopus_id/" . $scoid . "?field=authors&apiKey=6ab3c2a01c29f0e36b00c8fa1d013f83&httpAccept=application%2Fjson")->json();

                    $paper = new Paper;
                    $paper->paper_name = $item['dc:title'];
                    $paper->paper_type = $item['prism:aggregationType'];
                    $paper->paper_subtype = $item['subtypeDescription'];
                    $paper->paper_sourcetitle = $item['prism:publicationName'];
                    $paper->paper_url = $item['link'][2]['@href'];
                    $paper->paper_yearpub = Carbon::parse($item['prism:coverDate'])->format('Y');
                    $paper->paper_volume = $item['prism:volume'] ?? null;
                    $paper->paper_issue = $item['prism:issueIdentifier'] ?? null;
                    $paper->paper_citation = $item['citedby-count'];
                    $paper->paper_page = $item['prism:pageRange'] ?? null;
                    $paper->paper_doi = $item['prism:doi'] ?? null;

                    if (array_key_exists('item', $all['abstracts-retrieval-response'])) {
                        if (array_key_exists('xocs:meta', $all['abstracts-retrieval-response']['item']) && 
                            array_key_exists('xocs:funding-text', $all['abstracts-retrieval-response']['item']['xocs:meta']['xocs:funding-list'])) {
                            $funder = $all['abstracts-retrieval-response']['item']['xocs:meta']['xocs:funding-list']['xocs:funding-text'];
                            $paper->paper_funder = json_encode($funder);
                        } else {
                            $paper->paper_funder = null;
                        }
                        $paper->abstract = $all['abstracts-retrieval-response']['item']['bibrecord']['head']['abstracts'] ?? null;
                        $paper->keyword = (array_key_exists('author-keywords', $all['abstracts-retrieval-response']['item']['bibrecord']['head']['citation-info'])) 
                            ? json_encode($all['abstracts-retrieval-response']['item']['bibrecord']['head']['citation-info']['author-keywords']['author-keyword']) 
                            : null;
                    } else {
                        $paper->paper_funder = null;
                        $paper->abstract = null;
                        $paper->keyword = null;
                    }

                    $paper->save();
                    $newPapersCount++; // เพิ่มจำนวน Paper ใหม่

                    $source = Source_data::findOrFail(1);
                    $paper->source()->sync($source);

                    $all_au = $all['abstracts-retrieval-response']['authors']['author'];
                    $x = 1;
                    $length = count($all_au);

                    foreach ($all_au as $i) {
                        $givenName = $i['ce:given-name'] ?? $i['preferred-name']['ce:given-name'];
                        $surname = $i['ce:surname'];

                        if (User::where([['fname_en', '=', $givenName], ['lname_en', '=', $surname]])
                            ->orWhere([[DB::raw("concat(left(fname_en,1),'.')"), '=', $givenName], ['lname_en', '=', $surname]])->first() == null) {
                            if (Author::where([['author_fname', '=', $givenName], ['author_lname', '=', $surname]])->first() == null) {
                                $author = new Author;
                                $author->author_fname = $givenName;
                                $author->author_lname = $surname;
                                $author->save();
                            } else {
                                $author = Author::where([['author_fname', '=', $givenName], ['author_lname', '=', $surname]])->first();
                            }
                            $authorType = ($x === 1) ? 1 : (($x === $length) ? 3 : 2);
                            $paper->author()->attach($author->id, ['author_type' => $authorType]);
                        } else {
                            $us = User::where([['fname_en', '=', $givenName], ['lname_en', '=', $surname]])
                                ->orWhere([[DB::raw("concat(left(fname_en,1),'.')"), '=', $givenName], ['lname_en', '=', $surname]])->first();
                            $authorType = ($x === 1) ? 1 : (($x === $length) ? 3 : 2);
                            $paper->teacher()->attach($us->id, ['author_type' => $authorType]);
                        }
                        $x++;
                    }
                } else {
                    $paper = Paper::where('paper_name', '=', $item['dc:title'])->first();
                    $paperid = $paper->id;
                    $user = User::find($id);

                    $hasTask = $user->paper()->where('paper_id', $paperid)->exists();
                    if (!$hasTask) {
                        $useaut = Author::where([['author_fname', '=', $user->fname_en], ['author_lname', '=', $user->lname_en]])->first();
                        if ($useaut != null) {
                            $paper->author()->detach($useaut);
                            $paper->teacher()->attach($id);
                        } else {
                            $paper->teacher()->attach($id);
                        }
                    }
                }
            }

            // บันทึก Logs หลังจากเรียก Paper เสร็จ
            event(new UserActionEvent(
                Auth::user(),
                'call_paper',
                [
                    'target' => 'scopus',
                    'user_id' => $id,
                    'message' => 'User requested to call papers from Scopus',
                    'new_papers_added' => $newPapersCount,
                    'timestamp' => now()->toDateTimeString(),
                ]
            ));

            return redirect()->route('papers.index')->with('success', "Called papers from Scopus successfully. Added $newPapersCount new papers.");

        } catch (\Exception $e) {
            return redirect()->route('papers.index')->with('error', 'Failed to call papers: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $year = range(Carbon::now()->year - 5, Carbon::now()->year);
        $paper = [];
        foreach ($year as $key => $value) {
            $paper[] = Paper::where(DB::raw('(paper_yearpub)'), $value)->count();
        }
        //return $paper;
        return view('test')->with('year', json_encode($year, JSON_NUMERIC_CHECK))->with('paper', json_encode($paper, JSON_NUMERIC_CHECK));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
