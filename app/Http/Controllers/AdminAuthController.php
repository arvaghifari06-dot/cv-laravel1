<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    public function create(Request $request): View|RedirectResponse
    {
        // Jika sudah login, langsung ke dashboard
        if ($request->session()->get('admin_login', false)) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'Username dan password wajib diisi.',
            'password.required' => 'Username dan password wajib diisi.',
        ]);

        $admin = Admin::where('username', $data['username'])->first();

        // password_verify() dipakai langsung (sama seperti project lama) karena hash di
        // database berawalan $2b$, yang tidak diterima oleh Hash::check() bawaan Laravel.
        if (! $admin || ! password_verify($data['password'], $admin->password)) {
            return back()
                ->withInput($request->only('username'))
                ->withErrors(['login' => 'Username atau password salah!']);
        }

        $request->session()->regenerate();
        $request->session()->put([
            'admin_login'    => true,
            'admin_username' => $admin->username,
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->forget(['admin_login', 'admin_username']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
