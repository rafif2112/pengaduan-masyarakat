<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Report;
use App\Models\Comment;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
        $provinces = $response->json();

        if ($request->province) {
            $provinceName = $request->province;
            $provinceData = collect($provinces)->firstWhere('name', $provinceName);

            if ($provinceData) {
                $reports = Report::with('user')
                    ->where('province', $provinceData['id'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(5);
            } else {
                $reports = Report::with('user')->orderBy('created_at', 'desc')->paginate(5);
            }
        } else {
            $reports = Report::with('user')->orderBy('created_at', 'desc')->paginate(5);
        }

        return view('guest.article.index', compact('provinces', 'reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $updateViewers = Report::where('id', $id)->first();

        if (url()->previous() != url()->current()) {
            $updateViewers->increment('viewers');
        }

        $comments = Comment::with('user', 'report')->where('report_id', $id)->get();
        $report = Report::with('user')->where('id', $id)->first();
        return view('guest.article.detail', compact('report', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function vote(Request $request, $id)
    {
        $report = Report::where('id', $id)->first();
        $userId = $request->user_id;
        $voting = $report->voting ? $report->voting : [];

        if (!in_array($userId, $voting)) {
            array_push($voting, $userId);
            $report->voting = $voting;
            $report->save();
            return redirect()->back()->with('success', 'Terimakasih atas partisipasinya');
        } else {
            unset($voting[array_search($userId, $voting)]);
            $report->voting = $voting;
            $report->save();
            return redirect()->back()->with('success', 'Berhasil membatalkan voting');
        }
    }
}
