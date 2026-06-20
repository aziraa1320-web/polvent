<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\PanitiaAccountCreatedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class PanitiaController extends Controller
{
    public function index()
    {
        $panitias = User::where('role', 'panitia')->latest()->get();
        return view('admin.panitia.index', compact('panitias'));
    }

    public function create()
    {
        return view('admin.panitia.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $panitia = User::create([
            'name'            => $request->name,
            'email'           => $request->email,
            'password'        => Hash::make($request->password),
            'role'            => 'panitia',
            'is_otp_verified' => true,
        ]);

        try {
            Mail::to($panitia->email)->send(new PanitiaAccountCreatedMail($request->name, $request->email, $request->password));
        } catch (\Exception $e) {
            // Log the error but don't stop the creation process
            \Log::error('Failed to send Panitia account creation email: ' . $e->getMessage());
            return redirect()->route('admin.panitia.index')
                ->with('success', 'Akun Panitia berhasil dibuat, namun gagal mengirim email notifikasi. Silakan hubungi Panitia secara manual.');
        }

        return redirect()->route('admin.panitia.index')
            ->with('success', 'Akun Panitia berhasil dibuat dan email notifikasi telah dikirim!');
    }

    public function edit(User $panitium)
    {
        if ($panitium->role !== 'panitia') {
            abort(403);
        }
        return view('admin.panitia.edit', compact('panitium'));
    }

    public function update(Request $request, User $panitium)
    {
        if ($panitium->role !== 'panitia') {
            abort(403);
        }

        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($panitium->id)],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $panitium->name = $request->name;
        $panitium->email = $request->email;

        if ($request->filled('password')) {
            $panitium->password = Hash::make($request->password);
        }

        $panitium->save();

        return redirect()->route('admin.panitia.index')
            ->with('success', 'Data Panitia berhasil diperbarui!');
    }

    public function destroy(User $panitium)
    {
        if ($panitium->role !== 'panitia') {
            abort(403);
        }

        $panitium->delete();

        return redirect()->route('admin.panitia.index')
            ->with('success', 'Akun Panitia berhasil dihapus.');
    }
}
