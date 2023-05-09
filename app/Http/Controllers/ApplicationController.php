<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\TemporaryFile;
use Exception;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        $submitted_applications = auth()->user()->applications;

        return view('applications.index', compact([
            'submitted_applications'
        ]));
    }

    public function create()
    {
        /*
         * some fields the user can fill
         * update the template with the new fields
         * send application type offical letter
         * internship cordinator can download the application
         * sing it
         * update the application file with the new one
         * update the apploication status to be approved
         * if the application is rejected the user can see the reason
         * */
        return view('applications.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $fileName = $user->student_no . '-' . 'official_letter' . '_' . now() . '.docx';

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $section->addText(
            now()->format('d/m/Y'),
            [
                'bold' => true,
                'size' => 16,
            ],
            [
                'align' => 'right'
            ]

        );
        $section->addTextBreak(5);
        $section->addText(
            'To (Company Name)',
            [
                'bold' => true,
                'size' => 16,
            ]
        );
        $section->addTextBreak(3);
        $section->addText(
            '(student name),',
            [
                'bold' => true,
                'size' => 16,
            ]
        );
        $section->addText(
            'who has applied to your department for a summer internship, is studying at Üsküdar University, Faculty of Engineering and Natural Sciences, Software Engineering Department. In the Software Engineering department, there are two compulsory internships, one at the end of the second year and the other at the end of third year. The duration of each compulsory internship is 20 working days. Work Accident and Occupational Diseases Insurance Premiums between the dates of internship of the student are covered by our University. The named student has',
            [
                'size' => 14,
            ]
        );

        $section->addText(
            '(number of incomplete internships)',
            [
                'bold' => true,
                'size' => 16,
            ]
        );

        $section->addText(
            'compulsory internships. This document has been prepared to inform your institution.',
            [
                'size' => 14,
            ]
        );

        $section->addTextBreak(5);
        $section->addText(
            'Software Engineering Internship Committee Member',
            [
                'size' => 14,
            ],
            [
                'align' => 'right'
            ]

        );
        $section->addText(
            '(name of the department internship coordinator)',
            [
                'bold' => true,
                'size' => 16,
            ],
            [
                'align' => 'right'
            ]
        );

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path($fileName));
        } catch (Exception $e) {
        }


        return response()->download(storage_path($fileName));

        $files = $request->meta['files'];

        $application = Application::query()->create(
            [
                'user_id' => auth()->id(),
                'application_name' => $request->application_name,
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
