<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PesanController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $tujuan = route('home') . '#kontak';

        $validator = Validator::make($request->all(), [
            'nama'   => ['required', 'string', 'max:100'],
            'email'  => ['required', 'email', 'max:100'],
            'subjek' => ['required', 'string', 'max:150'],
            'pesan'  => ['required', 'string', 'min:10'],
        ], [
            'nama.required'   => 'Nama wajib diisi.',
            'nama.max'        => 'Nama maksimal 100 karakter.',
            'email.required'  => 'Email wajib diisi.',
            'email.email'     => 'Format email tidak valid.',
            'email.max'       => 'Email maksimal 100 karakter.',
            'subjek.required' => 'Subjek wajib diisi.',
            'subjek.max'      => 'Subjek maksimal 150 karakter.',
            'pesan.required'  => 'Pesan wajib diisi.',
            'pesan.min'       => 'Pesan minimal 10 karakter.',
        ]);

        if ($validator->fails()) {
            return redirect($tujuan)->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        try {
            Pesan::create($data);   // INSERT lewat Eloquent (prepared statement otomatis)
        } catch (QueryException $e) {
            report($e);

            return redirect($tujuan)
                ->withErrors(['db' => 'Pesan gagal disimpan. Silakan coba lagi.'])
                ->withInput();
        }

        return redirect($tujuan)
            ->with('contact_success', 'Terima kasih, ' . $data['nama'] . '! Pesan Anda telah tersimpan.');
    }
}
