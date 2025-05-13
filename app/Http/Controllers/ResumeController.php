<?php

namespace App\Http\Controllers;

use App\Models\Seeker;
use Illuminate\Http\Request;

class ResumeController extends Controller
{

    public function __invoke(string $obfuscated)
    {

        $seeker = Seeker::findByObfuscatedId($obfuscated);
        abort_if(!$seeker, 404);

        if(empty($seeker)) {
            return response()->json([
                'message' => 'Seeker not found',
            ], 404);
        }

        return view('resume', [
            'seeker' => $seeker,
        ]);
    }
}
