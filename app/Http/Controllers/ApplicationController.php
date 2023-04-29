<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {

        $files = $request->meta['files'];

        $application = Application::query()->create(
            [
                'user_id' => auth()->id(),
                'application_name' => $request->get('application_name'),
            ]
        );

        foreach ($files as $file) {
            $temporaryFile = TemporaryFile::query()->where('folder', $file)->first();
            if ($temporaryFile) {
                $application->addMedia(storage_path('app/public/files/temp/' . $temporaryFile->folder . '/' . $temporaryFile->file_name))
                            ->toMediaCollection('files');
                rmdir(storage_path('app/public/files/temp/' . $temporaryFile->folder));
                $temporaryFile->delete();
            }
        }


        return redirect()->back();
    }
}
