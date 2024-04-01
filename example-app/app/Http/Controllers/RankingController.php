<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Nghesi;
use App\Models\Nhac;
use App\Models\Ranks;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function updateWeeklyRankings()
    {
        $top3Songs = Nhac::orderBy('luotnghe', 'desc')->limit(3)->get();
        $totalListens = Nhac::orderBy('luotnghe', 'desc')->limit(3)->get()->sum('luotnghe');
        foreach ($top3Songs as  $song) {
            $percentage = ($song->luotnghe / $totalListens) * 100;
            Album::where('id', $song->album_idnhac)->first();
            $ranks = new Ranks;
            $ranks->tensong = $song->tennhac;
            $ranks->nghesi = Nghesi::where('id', Album::where('id', $song->album_idnhac)->pluck('nghesi_idalbum')->first())->pluck('tennghesi')->first();
            $ranks->thoigian = Carbon::now()->month . '/' . Carbon::now()->year;
            $ranks->phantram = $percentage;
            $ranks->save();
        }

        return response()->json(['message' => 'Weekly rankings updated successfully']);
    }
}