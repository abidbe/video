<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $videos = Video::paginate(8);
        return view('dashboard', compact('videos'));
    }
}
