<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\View\View;

class AdminMessageController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.messages', [
            'pesan' => Pesan::orderByDesc('id')->get(),   // terbaru dahulu
        ]);
    }
}
