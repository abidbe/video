<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Video;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::paginate(10);
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.videos.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'video' => 'required|mimes:mp4,mov,ogg,qt|max:20000',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos', 'public');

            // Create thumbnail
            $thumbnailPath = 'thumbnails/' . pathinfo($videoPath, PATHINFO_FILENAME) . '.jpg';
            $ffmpeg = FFMpeg::create([
                'ffmpeg.binaries'  => 'D:\ffmpeg\bin\ffmpeg.exe',
                'ffprobe.binaries' => 'D:\ffmpeg\bin\ffprobe.exe',
                'timeout'          => 3600,
                'ffmpeg.threads'   => 12,
            ]);

            try {
                $video = $ffmpeg->open(Storage::disk('public')->path($videoPath));
                $frame = $video->frame(TimeCode::fromSeconds(1));
                $frame->save(Storage::disk('public')->path($thumbnailPath));

                // Save video with thumbnail
                Video::create([
                    'title' => $request->title,
                    'path' => $videoPath,
                    'thumbnail' => $thumbnailPath,
                    'category_id' => $request->category_id,
                ]);
            } catch (\Exception $e) {
                return back()->withErrors(['video' => 'Unable to save frame: ' . $e->getMessage()]);
            }
        }

        return redirect()->route('videos.index')->with('success', 'Video created successfully!');
    }

    public function show(Video $video)
    {
        return view('admin.videos.show', compact('video'));
    }

    public function edit(Video $video)
    {
        $categories = Category::all();
        return view('admin.videos.edit', compact('video', 'categories'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'required',
            'video' => 'mimes:mp4,mov,ogg,qt|max:20000',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('video')) {
            if ($video->path && Storage::disk('public')->exists($video->path)) {
                Storage::disk('public')->delete($video->path);
            }
            if ($video->thumbnail && Storage::disk('public')->exists($video->thumbnail)) {
                Storage::disk('public')->delete($video->thumbnail);
            }
            $videoPath = $request->file('video')->store('videos', 'public');

            // Create thumbnail
            $thumbnailPath = 'thumbnails/' . pathinfo($videoPath, PATHINFO_FILENAME) . '.jpg';
            $ffmpeg = FFMpeg::create([
                'ffmpeg.binaries'  => 'D:\ffmpeg\bin\ffmpeg.exe',
                'ffprobe.binaries' => 'D:\ffmpeg\bin\ffprobe.exe',
                'timeout'          => 3600,
                'ffmpeg.threads'   => 12,
            ]);

            try {
                $videoFile = $ffmpeg->open(Storage::disk('public')->path($videoPath));
                $frame = $videoFile->frame(TimeCode::fromSeconds(1));
                $frame->save(Storage::disk('public')->path($thumbnailPath));

                $video->update([
                    'title' => $request->title,
                    'path' => $videoPath,
                    'thumbnail' => $thumbnailPath,
                    'category_id' => $request->category_id,
                ]);
            } catch (\Exception $e) {
                return back()->withErrors(['video' => 'Unable to save frame: ' . $e->getMessage()]);
            }
        } else {
            $video->update([
                'title' => $request->title,
                'category_id' => $request->category_id,
            ]);
        }

        return redirect()->route('videos.index')->with('success', 'Video updated successfully!');
    }

    public function destroy(Video $video)
    {
        if ($video->path && Storage::disk('public')->exists($video->path)) {
            Storage::disk('public')->delete($video->path);
        }
        if ($video->thumbnail && Storage::disk('public')->exists($video->thumbnail)) {
            Storage::disk('public')->delete($video->thumbnail);
        }
        $video->delete();
        return redirect()->route('videos.index')->with('success', 'Video deleted successfully!');
    }
}
