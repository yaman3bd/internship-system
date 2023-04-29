<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        $file = $request->file('meta.files.0');
        $fileName = $file->getClientOriginalName();
        $folder = uniqid() . '-' . now()->timestamp;
        $file->storeAs('public/files/temp/' . $folder, $fileName);
        TemporaryFile::query()->create([
            'folder' => $folder,
            'file_name' => $fileName,
        ]);

        return $folder;
    }

    public function destroy(Request $request)
    {
        return true;
        $file = $request->getContent();

        $temporaryFile = TemporaryFile::query()->where('folder', $file)->first();
        if ($temporaryFile) {
            rmdir(storage_path('app/public/files/temp/' . $temporaryFile->folder));
            $temporaryFile->delete();
        }
    }
}
