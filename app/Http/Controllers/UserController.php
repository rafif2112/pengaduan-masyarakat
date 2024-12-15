<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StaffProvince;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::with('staffProvince')->find(auth()->id());
        // Mengambil semua pengguna dengan peran 'staff'
        $users = User::where('role', 'staff')
            // Memeriksa apakah pengguna memiliki relasi 'staffProvince'
            ->whereHas('staffProvince', function ($query) use ($user) {
                // Menambahkan kondisi pada relasi 'staffProvince'
                // Memeriksa apakah kolom 'province' pada relasi 'staffProvince' sama dengan kolom 'province' dari pengguna yang sedang login
                $query->where('province', $user->staffProvince->province);
            })
            // Mengambil semua hasil yang sesuai dengan kondisi yang telah ditentukan
            ->get();
        return view('head_staff.users.create', compact('users'));
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ], [
            'email.required' => 'Email waajib diisi',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password waajib diisi',
        ]);

        $userHeadStaff = User::with('staffProvince')->find(auth()->id());
        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 'staff';
        $user->save();

        $userStaffProvince = new StaffProvince();
        $userStaffProvince->user_id = $user->id;
        $userStaffProvince->province = $userHeadStaff->staffProvince->province;
        $userStaffProvince->save();

        return redirect()->back()->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $password = substr($user->email, 0, 4);
        $user->password = bcrypt($password);
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil direset');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::with('response')->where('id', $id)->first();

        if ($user->response->isNotEmpty()) {
            return redirect()->back()->with('error', 'User tidak bisa dihapus karena sudah membuat tanggapan');
        }

        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus');
    }
}
