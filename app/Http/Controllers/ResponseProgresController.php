<?php

namespace App\Http\Controllers;

use App\Models\ResponseProgres;
use Illuminate\Http\Request;

class ResponseProgresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'tanggapan' => 'required|string|max:255',
        ],[
            'tanggapan.required' => 'Tanggapan harus diisi',
            'tanggapan.string' => 'Tanggapan harus berupa teks',
            'tanggapan.max' => 'Tanggapan maksimal 255 karakter',
        ]);

        $responseProgres = new ResponseProgres();
        $responseProgres->response_id = $request->response_id;

        $histories = [
            'tanggapan' => $request->tanggapan,
            'user_id' => auth()->id(),
        ];

        $responseProgres->histories = $histories;
        $responseProgres->save();
        return redirect()->back()->with('success', 'Tanggapan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(ResponseProgres $responseProgres)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ResponseProgres $responseProgres)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ResponseProgres $responseProgres)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $responseProgres = ResponseProgres::where('id', $id)->first();
        $responseProgres->delete();

        return redirect()->back()->with('success', 'Tanggapan berhasil dihapus');
    }
}
