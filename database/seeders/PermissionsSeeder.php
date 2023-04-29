<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Academies
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'academies.view']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'academies.create']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'academies.update']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'academies.delete']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'academies.dashboard']);

        // Roles
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'roles.view']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'roles.create']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'roles.update']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'roles.delete']);

        // Users
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'users.view']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'users.create']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'users.update']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'users.delete']);

        // Members
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'members.view']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'members.create']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'members.update']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'members.delete']);

        // Blog
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'blog.view']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'blog.create']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'blog.update']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'blog.delete']);

        // Courses
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'courses.view']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'courses.create']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'courses.update']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'courses.delete']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'courses.contents']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'courses.landing_pages']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'courses.settings']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'courses.assignments']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'courses.quizzes']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'courses.instructors']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'courses.community']);

        // Products
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'products.view']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'products.create']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'products.update']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'products.delete']);

        // Difficulties
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'difficulties.view']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'difficulties.create']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'difficulties.update']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'difficulties.delete']);

        // Categories
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'categories.view']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'categories.create']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'categories.update']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'categories.delete']);

        // Tags
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'tags.view']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'tags.create']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'tags.update']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'tags.delete']);

        // Marketing Apps
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'marketing-apps.view']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'marketing-apps.install']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'marketing-apps.uninstall']);

        // Payment Apps
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'payment-apps.view']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'payment-apps.install']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'payment-apps.uninstall']);

        // Coupons
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'coupons.view']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'coupons.create']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'coupons.update']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'coupons.delete']);

        // affiliate
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'affiliate.manage']);

        // Orders
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'orders.view']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'orders.create']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'orders.update']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'orders.delete']);

        // Msaaqpay
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'msaaqpay.dashboard']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'msaaqpay.enable']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'msaaqpay.disable']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'msaaqpay.manage']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'msaaqpay.transactions']);

        // Settings
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'settings.general']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'settings.domain']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'settings.translations']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'settings.code_snippets']);

        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'settings.payment']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'settings.subscription']);
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'settings.verification']);

        // Builder
        Permission::firstOrCreate(['guard_name' => 'web_admin', 'name' => 'builder.view']);
    }
}
