<?php

namespace Database\Factories;


use App\Models\ApplicationFile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Internship Application Form Example',
            'status' => 'public',
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (ApplicationFile $application) {

            try {
                /*$application->addMedia(public_path('pdf-files/INTERNSHIP-APPLICATION-FORM.pdf'))
                            ->toMediaCollection('file');*/
            } catch (\Exception $e) {
            /*    dd($e->getMessage());*/
            }
        });
    }
}
