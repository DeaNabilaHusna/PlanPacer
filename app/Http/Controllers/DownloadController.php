<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function download($filename)
    {
        $filePath = storage_path('uploads/docs/' . $filename.'/' . $filename);

        if (!Storage::disk('public')->exists('uploads/docs/' . $filename)) {
            abort(404);
        }

        return response()->download($filePath);
    }
}
