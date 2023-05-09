<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Address;
use App\Models\Admin;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $superAdmin = Admin::factory()->create();

        $internshipCoordinator = Admin::factory()->create([
                'name' => 'Internship Coordinator',
                'email' => 'internship_coordinator@admin.com'
            ]
        );
        $careerCenter = Admin::factory()->create([
            'name' => 'Career Center',
            'email' => 'career_center@admin.com'
        ]);

        User::factory()->create();
        Address::factory()->create();


        $superAdminRole = Role::create([
            'name' => 'super-admin',
            'nickname' => 'Super Admin',
            'guard_name' => 'web_admin',
            'description' => 'This role has all the permissions in the system, this means the admin can do anything to any resource'
        ]);
        $superAdmin->assignRole($superAdminRole);

        $studentsViewAny = Permission::query()
                                     ->firstOrCreate([
                                         'guard_name' => 'web_admin',
                                         'name' => 'students.view_any',
                                         'nickname' => 'View Any Student',
                                         'description' => 'This permission allows the admin to view any student in the system'
                                     ]);
        $studentsView = Permission::query()
                                  ->firstOrCreate([
                                      'guard_name' => 'web_admin',
                                      'name' => 'students.view',
                                      'nickname' => 'View Student',
                                      'description' => 'This permission allows the admin to view only the student landing page in the system, this means he can not see the index page'
                                  ]);

        $studentsUpdate = Permission::query()
                                    ->firstOrCreate([
                                        'guard_name' => 'web_admin',
                                        'name' => 'students.update',
                                        'nickname' => 'Update Student',
                                        'description' => 'This permission allows the admin to update any student in the system'
                                    ]);

        $applicationsViewAny = Permission::query()
                                         ->firstOrCreate([
                                             'guard_name' => 'web_admin',
                                             'name' => 'applications.view_any',
                                             'nickname' => 'View Any Application',
                                             'description' => 'This permission allows the admin to view any application in the system'
                                         ]);

        $applicationsView = Permission::query()
                                      ->firstOrCreate([
                                          'guard_name' => 'web_admin',
                                          'name' => 'applications.view',
                                          'nickname' => 'View Application',
                                          'description' => 'This permission allows the admin to view only the application landing page in the system, this means he can not see the index page'
                                      ]);

        $applicationsUpdate = Permission::query()
                                        ->firstOrCreate([
                                            'guard_name' => 'web_admin',
                                            'name' => 'applications.update',
                                            'nickname' => 'Update Application',
                                            'description' => 'This permission allows the admin to update any application in the system'
                                        ]);

        $internshipCoordinatorRole = Role::create([
            'name' => 'internship-coordinator',
            'nickname' => 'Internship Coordinator',
            'guard_name' => 'web_admin',
            'description' => 'This role has the permissions to only view and update applications with any status'
            //view_applications
            //update_applications => 'watting for sgk'
            //delete_applications
        ]);

        $careerCenterRole = Role::create([
            'name' => 'career-center',
            'nickname' => 'Career Center',
            'guard_name' => 'web_admin',
            'description' => 'This role has the permission to only view applications that have the status "waiting for SGK"'
            //view_applications  only with status 'watting for sgk' can approve or reject on reject set back to
            //internship-coordinator
        ]);

        $internshipCoordinatorRole->givePermissionTo([
            $applicationsViewAny,
            $applicationsView,
            $applicationsUpdate,
            $studentsViewAny,
            $studentsView,
            $studentsUpdate,
        ]);

        $internshipCoordinator->assignRole($internshipCoordinatorRole);

        $careerCenterRole->givePermissionTo([
            $applicationsViewAny,
            $applicationsView,
            $applicationsUpdate,
        ]);
        $careerCenter->assignRole($careerCenterRole);
    }
}
