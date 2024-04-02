<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Nghesi;
use App\Models\Nhac;
use App\Models\Ranks;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class RankingController extends Controller
{
    public function updateWeeklyRankings()
    {
        $top3Songs = Nhac::orderBy('luotnghe', 'desc')->limit(3)->get();
        $totalListens = Nhac::orderBy('luotnghe', 'desc')->limit(3)->get()->sum('luotnghe');

        $ranks = new Ranks;
        $ranks->tensong1 = $top3Songs[0]->tennhac;
        $ranks->nghesi1 = Nghesi::where('id', Album::where('id', $top3Songs[0]->album_idnhac)->pluck('nghesi_idalbum')->first())->pluck('tennghesi')->first();
        $ranks->phantram1 = ($top3Songs[0]->luotnghe / $totalListens) * 100;
        $ranks->tensong2 = $top3Songs[1]->tennhac;
        $ranks->nghesi2 = Nghesi::where('id', Album::where('id', $top3Songs[1]->album_idnhac)->pluck('nghesi_idalbum')->first())->pluck('tennghesi')->first();
        $ranks->phantram2 = ($top3Songs[1]->luotnghe / $totalListens) * 100;
        $ranks->tensong3 = $top3Songs[2]->tennhac;
        $ranks->nghesi3 = Nghesi::where('id', Album::where('id', $top3Songs[2]->album_idnhac)->pluck('nghesi_idalbum')->first())->pluck('tennghesi')->first();
        $ranks->phantram3 = ($top3Songs[2]->luotnghe / $totalListens) * 100;
        $ranks->thoigian = Carbon::now()->month . '/' . Carbon::now()->year;

        $ranks->save();

        return response()->json(['message' => 'Weekly rankings updated successfully']);
    }
}
