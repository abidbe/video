<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\VideoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $videos = Video::with('category')->orderBy('created_at', 'desc')->paginate(8);
        return view('customer.dashboard', compact('videos'));
    }

    public function show(Video $video)
    {
        // Memeriksa apakah user memiliki akses ke video
        $hasAccess = VideoRequest::where('video_id', $video->id)
            ->where('user_id', Auth::id())
            ->where('expires_at', '>', now())
            ->exists();

        if ($hasAccess || Auth::user()->is_admin) {
            return view('customer.show', compact('video'));
        }

        return redirect()->route('dashboard')->with('error', 'You do not have access to this video.');
    }
}
