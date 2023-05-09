<?php

namespace Database\Factories;


use App\Models\Application;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'status' => $this->faker->randomElement(['approved', 'rejected', 'pending']),
            'application_name' => $this->faker->word,
            'meta' => null,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Application $application) {

            try {
                $application->addMediaFromUrl("https://fastly.picsum.photos/id/450/200/200.jpg?hmac=DluUYibC-zBoNHLOHsO6aHIuiA3pDhholFjiR5KcwR0")
                            ->toMediaCollection('files');
                $application->addMediaFromUrl("https://fastly.picsum.photos/id/450/200/200.jpg?hmac=DluUYibC-zBoNHLOHsO6aHIuiA3pDhholFjiR5KcwR0")
                            ->toMediaCollection('files');
                $application->addMediaFromUrl("https://fastly.picsum.photos/id/450/200/200.jpg?hmac=DluUYibC-zBoNHLOHsO6aHIuiA3pDhholFjiR5KcwR0")
                            ->toMediaCollection('files');
            } catch (\Exception $e) {
                dd($e->getMessage());

            }
        });
    }
}
