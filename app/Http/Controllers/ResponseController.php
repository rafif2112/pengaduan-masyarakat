<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Response;
use Illuminate\Http\Request;
use App\Models\ResponseProgres;

class ResponseController extends Controller
{
    public function viewResponse($id)
    {
        $reports = Report::with('user', 'response')->where('id', $id)->get();
        $responses = Response::with('user', 'report')->where('report_id', $id)->get();
        $responseProgres = ResponseProgres::where('response_id', $id)->get();

        return view('staff.report.detail', compact('reports', 'responses', 'responseProgres'));
    }

    public function index(Request $request, $id)
    {
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
    public function store(Request $request, $report_id)
    {
        $report = Report::where('id', $report_id)->first();
        if (!$report->statement) {
            Report::where('id', $report_id)->update([
                'statement' => $request->report_statement,
            ]);
        }

        $response = Response::find($report_id);
        if (!$response) {
            $existingResponse = Response::where('report_id', $report_id)
                ->where('staff_id', auth()->id())
                ->first();
            if (!$existingResponse) {
                $newResponse = new Response();
                $newResponse->report_id = $report_id;
                $newResponse->response_status = $request->report_statement ? 'on_process' : 'reject';
                $newResponse->staff_id = auth()->id();
                $newResponse->save();
            }
        }

        return redirect()->route('staff.response.view', $report_id)->with('success', 'Tanggapan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Response $response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Response $response)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $response = Response::where('id', $id)->first();
        $response->response_status = 'done';
        $response->save();

        return redirect()->back()->with('success', 'Status tanggapan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Response $response)
    {
        //
    }
}
