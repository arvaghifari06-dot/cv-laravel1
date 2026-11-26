<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\JsonResponse;

class CvApiController extends Controller
{
    public function profile(): JsonResponse
    {
        $path = resource_path('data/cv.json');
        $data = json_decode(file_get_contents($path), true);

        return response()->json($data, 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function skills(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => Skill::query()
                ->orderBy('id')
                ->get(['id', 'nama_skill', 'tingkat', 'nilai']),
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
