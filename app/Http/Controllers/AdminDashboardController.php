<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use App\Models\Skill;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'skills'     => Skill::orderBy('id')->get(),   // READ
            'totalPesan' => Pesan::count(),
        ]);
    }
}
