<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Response;
use App\Models\ResponseProgres;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;

class ReportController extends Controller
{
    public function headStaffIndex()
    {
        $user = User::with('staffProvince')->find(auth()->id());
        $reports = Report::with('response')->where('province', $user->staffProvince->province)->get();
        $responses = Response::with('report', 'responseProgres')->whereHas('report', function ($query) use ($user) {
            $query->where('province', $user->staffProvince->province);
        })->get();

        $countReports = Report::where('province', $user->staffProvince->province)->count();
        $countResponses = Response::whereHas('report', function ($query) use ($user) {
            $query->where('province', $user->staffProvince->province);
        })->count();

        $userProvince = $user->staffProvince->province;

        return view('head_staff.report.index', compact('reports', 'responses', 'countReports', 'countResponses', 'userProvince'));
    }

    public function index()
    {
        $user = auth()->user();
        $reports = Report::with('user', 'response')->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        $responses = Response::with('report', 'responseProgres')->get();
        return view('guest.report.index', compact('reports', 'responses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $reports = Report::all();
        return view('guest.report.create', compact('reports'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'province' => 'required',
            'regency' => 'required',
            'subdistrict' => 'required',
            'village' => 'required',
            'type' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'province.required' => 'Provinsi harus diisi',
            'regency.required' => 'Kabupaten harus diisi',
            'subdistrict.required' => 'Kecamatan harus diisi',
            'village.required' => 'Desa harus diisi',
            'type.required' => 'Jenis laporan harus diisi',
            'description.required' => 'Deskripsi harus diisi',
            'image.required' => 'Gambar harus diisi',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'File harus berformat jpeg, png, jpg',
            'image.max' => 'Ukuran file maksimal 2MB',
        ]);

        $image = $request->file('image');
        $image_name = time() . "_" . $image->getClientOriginalName();
        $image->move(public_path('assets/images'), $image_name);

        $report = new Report();
        $report->user_id = auth()->user()->id;
        $report->province = $request->province;
        $report->regency = $request->regency;
        $report->subdistrict = $request->subdistrict;
        $report->village = $request->village;
        $report->type = $request->type;
        $report->description = $request->description;
        $report->image = $image_name;
        $report->save();

        return redirect()->route('report.index')->with('success', 'Laporan berhasil dibuat');
    }

    public function show(Report $report) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $report = Report::whire('id', $id)->first();
        $report->delete();
        return redirect()->back()->with('success', 'Laporan berhasil dihapus');
    }

    public function staffIndex()
    {
        $reports = Report::with('response')->orderBy('created_at', 'desc')->get();
        $responses = Response::with('report', 'responseProgres')->get();
        return view('staff.report.index', compact('reports', 'responses'));
    }

    public function export(Request $request)
    {
        if ($request->date) {
            $date = $request->date;
            $reports = Report::with('response')->whereDate('created_at', $date)->get();
        } else {
            $reports = Report::with('response')->get();
        }

        $provinces = [];
        $regencies = [];
        $subdistricts = [];
        $villages = [];

        foreach ($reports as $report) {
            $dataProvince = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')->json();
            $provinces[] = collect($dataProvince)->where('id', $report->province)->first();

            $dataRegency = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/regencies/' . $report->province . '.json')->json();
            $regencies[] = collect($dataRegency)->where('id', $report->regency)->first();

            $dataSubdistrict = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/districts/' . $report->regency . '.json')->json();
            $subdistricts[] = collect($dataSubdistrict)->where('id', $report->subdistrict)->first();

            $dataVillage = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/villages/' . $report->subdistrict . '.json')->json();
            $villages[] = collect($dataVillage)->where('id', $report->village)->first();
        }

        return Excel::download(new ReportExport($provinces, $regencies, $subdistricts, $villages, $request->date), 'laporan-' . ($request->date ?? 'all') . '.xlsx');
    }
}
