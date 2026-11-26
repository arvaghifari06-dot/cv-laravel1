<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminSkillController extends Controller
{
    private const TINGKAT = ['PEMULA', 'MENENGAH', 'MAHIR'];

    public function create(): View
    {
        return view('admin.skill-form', [
            'skill'         => new Skill(['tingkat' => 'MENENGAH']),
            'daftarTingkat' => self::TINGKAT,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Skill::create($request->validate($this->rules(), $this->messages()));   // CREATE

        return redirect()->route('admin.dashboard')->with('status', 'tambah');
    }

    public function edit(Skill $skill): View
    {
        return view('admin.skill-form', [
            'skill'         => $skill,
            'daftarTingkat' => self::TINGKAT,
        ]);
    }

    public function update(Request $request, Skill $skill): RedirectResponse
    {
        $skill->update($request->validate($this->rules(), $this->messages()));   // UPDATE ... WHERE id

        return redirect()->route('admin.dashboard')->with('status', 'edit');
    }

    public function destroy(Skill $skill): RedirectResponse
    {
        $skill->delete();   // DELETE ... WHERE id

        return redirect()->route('admin.dashboard')->with('status', 'hapus');
    }

    private function rules(): array
    {
        return [
            'nama_skill' => ['required', 'string', 'max:100'],
            'tingkat'    => ['required', Rule::in(self::TINGKAT)],
            'nilai'      => ['required', 'integer', 'between:1,12'],
        ];
    }

    private function messages(): array
    {
        return [
            'nama_skill.required' => 'Nama skill dan nilai wajib diisi.',
            'nama_skill.max'      => 'Nama skill maksimal 100 karakter.',
            'tingkat.required'    => 'Tingkat tidak valid.',
            'tingkat.in'          => 'Tingkat tidak valid.',
            'nilai.required'      => 'Nama skill dan nilai wajib diisi.',
            'nilai.integer'       => 'Nilai harus berupa angka 1 sampai 12.',
            'nilai.between'       => 'Nilai harus berupa angka 1 sampai 12.',
        ];
    }
}
