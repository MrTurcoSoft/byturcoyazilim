<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max
        ]);

        $file = $request->file('file');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        
        // Store in public/uploads directory
        $path = $file->storeAs('uploads', $filename, 'public');
        
        $url = asset('storage/' . $path);

        return response()->json([
            'success' => true,
            'url' => $url,
            'filename' => $filename,
        ]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'filename' => 'required|string',
        ]);

        $path = 'uploads/' . $request->filename;
        
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'File not found'], 404);
    }

    public function list()
    {
        $files = Storage::disk('public')->files('uploads');
        
        $images = collect($files)->map(function ($file) {
            return [
                'filename' => basename($file),
                'url' => asset('storage/' . $file),
                'size' => Storage::disk('public')->size($file),
                'created_at' => date('Y-m-d H:i:s', Storage::disk('public')->lastModified($file)),
            ];
        })->values();

        return response()->json(['images' => $images]);
    }
}
