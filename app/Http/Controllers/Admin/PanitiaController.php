<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

        User::create([
            'name'            => $request->name,
            'email'           => $request->email,
            'password'        => Hash::make($request->password),
            'role'            => 'panitia',
            'is_otp_verified' => true, // Bypass OTP requirement for manually created admins/panitias, or we leave it as false if we want them to verify. Let's make it true so they don't get stuck if emails are fake. Wait, OTP on login is different. OTP on login might happen regardless of is_otp_verified. We'll set it to true.
        ]);

        return redirect()->route('admin.panitia.index')
            ->with('success', 'Akun Panitia berhasil dibuat!');
    }

    public function destroy(User $panitium) // Route model binding uses singular of panitia
    {
        if ($panitium->role !== 'panitia') {
            abort(403);
        }

        $panitium->delete();

        return redirect()->route('admin.panitia.index')
            ->with('success', 'Akun Panitia berhasil dihapus.');
    }
}
