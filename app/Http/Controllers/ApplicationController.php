<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationFile;
use App\Models\TemporaryFile;
use Exception;
use Illuminate\Http\Request;


class ApplicationController extends Controller
{
    public function index()
    {
        $type = request()->query('type');
        $submitted_applications = auth()->user()->applications()->where('type', $type)->get();

        return view('applications.index', compact([
            'submitted_applications'
        ]));
    }

    public function show(Application $application)
    {

        $files = $application->getMedia('files')->map(function ($media) {
            return [
                'name' => $media->name,
                'url' => $media->getUrl(),
            ];
        });

        return view('applications.show', compact('application', 'files'));
    }

    public function create()
    {

        $files = ApplicationFile::query()->get()->map(function ($file) {
            $media = $file->getMedia('file')->first();

            if ($media) {
                return [
                    'name' => $file->name,
                    'url' => $media->getUrl(),
                ];
            }

            return null;
        });

        return view('applications.create', compact('files'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'meta.files' => 'required_if:type,internship_application|array',
                'company_name' => 'required_if:type,official_letter_request',
                'name_of_the_department_internship_coordinator' => 'required_if:type,official_letter_request',
                'number_of_incomplete_internships' => 'required_if:type,official_letter_request',
            ]
        );

        $type = $request->query('type');

        if ($type === 'official_letter_request') {
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
                "To " . $validated['company_name'],
                [
                    'bold' => true,
                    'size' => 16,
                ]
            );
            $section->addTextBreak(3);
            $section->addText(
                "$user->name,",
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
                $validated['number_of_incomplete_internships'],
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
                $validated['name_of_the_department_internship_coordinator'],
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

                $application = Application::query()->create(
                    [
                        'user_id' => auth()->id(),
                        'type' => 'official_letter_request'
                    ]
                );

                $application->addMedia(storage_path($fileName))
                            ->toMediaCollection('files');

                rmdir(storage_path($fileName));
            } catch (Exception $e) {
            }

        } else {
            $files = $request->meta['files'];

            $application = Application::query()->create([
                'user_id' => auth()->id(),
                'type' => 'internship_application'
            ]);

            foreach ($files as $file) {
                $temporaryFile = TemporaryFile::query()->where('folder', $file)->first();
                if ($temporaryFile) {
                    $application->addMedia(storage_path('app/public/files/temp/' . $temporaryFile->folder . '/' . $temporaryFile->file_name))
                                ->toMediaCollection('files');
                    rmdir(storage_path('app/public/files/temp/' . $temporaryFile->folder));
                    $temporaryFile->delete();
                }
            }

        }
        session()->flash('flash.banner', 'Application Submitted Successfully!');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('applications.index', ['type' => $type]);
    }
}
