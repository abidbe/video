<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\VideoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoRequestController extends Controller
{
    public function requestAccess($videoId)
    {
        $videoRequest = VideoRequest::create([
            'user_id' => auth()->id(),
            'video_id' => $videoId,
            'requested_at' => now(),
        ]);

        return redirect()->back()->with('status', 'Request for video access sent.');
    }

    public function index()
    {
        $requests = VideoRequest::with('user', 'video')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.requests.index', compact('requests'));
    }

    public function approveAccess(Request $request, $id)
    {
        $request->validate([
            'hours' => 'required|integer|min:1',
        ]);

        $hours = (int) $request->input('hours'); // Pastikan input dikonversi ke integer

        $videoRequest = VideoRequest::findOrFail($id);
        $videoRequest->approved_at = now();
        $videoRequest->expires_at = now()->addHours($hours);
        $videoRequest->save();

        return redirect()->route('video_requests.index')->with('success', 'Video access approved.');
    }
}
