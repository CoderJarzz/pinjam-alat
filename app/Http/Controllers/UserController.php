<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // 📄 Daftar user
    public function index()
    {
        $users = User::latest()->get();
        return view('user.index', compact('users'));
    }

    // 🔍 Detail user
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    // ✏️ Form edit user
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    // 💾 Update data user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email',
            'role'  => 'required|in:admin,user',
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ]);

        return redirect()
            ->route('user.show', $user->id)
            ->with('success', 'Data user berhasil diperbarui');
    }

    // 🗑 Hapus user
    public function destroy(User $user)
    {
        // ❗ Cegah hapus akun sendiri
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri');
        }

        $user->delete();

        return redirect()
            ->route('user.index')
            ->with('success', 'User berhasil dihapus');
    }
}
