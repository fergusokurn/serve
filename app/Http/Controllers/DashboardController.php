<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;
use App\Models\Song;

class DashboardController extends Controller
{
    public function index()
    {
        $latestInfo = Information::latest()->first();
        $totalSongs = Song::count();
        $userSongs = auth()->user()->role === 'admin' ? 
            Song::count() : 
            Song::where('user_id', auth()->id())->count();
        
        return view('dashboard', compact('latestInfo', 'totalSongs', 'userSongs'));
    }
}
