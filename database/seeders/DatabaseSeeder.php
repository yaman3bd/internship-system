<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Address;
use App\Models\Admin;
use App\Models\ApplicationFile;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::factory()->create();
        User::factory()->create();
        Address::factory()->create();
        ApplicationFile::factory([
            'name' => 'Internship Application Form Example',
        ])->create();
        ApplicationFile::factory([
            'name' => 'Career Change Form Example',
        ])->create();
    }
}
