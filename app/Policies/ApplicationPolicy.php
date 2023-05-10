<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Application;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicationPolicy
{
    use HandlesAuthorization;

    public function viewAny(Admin $admin)
    {
        return $admin->hasRole('super-admin') || $admin->hasPermissionTo('applications.view_any');
    }

    public function view(Admin $admin)
    {
        return $admin->hasRole('super-admin') || $admin->hasPermissionTo('applications.view');
    }

    public function update(Admin $admin, Application $application)
    {
        return $admin->hasRole('super-admin') || $admin->hasPermissionTo('applications.update');
    }

    public function delete(Admin $admin)
    {
        return $admin->hasRole('super-admin');
    }

    public function deleteAny(Admin $admin)
    {
        return $admin->hasRole('super-admin');
    }

    public function forceDelete(Admin $admin)
    {
        return $admin->hasRole('super-admin');
    }

    public function forceDeleteAny(Admin $admin)
    {
        return $admin->hasRole('super-admin');
    }

    public function restore(Admin $admin)
    {
        return $admin->hasRole('super-admin');
    }

    public function restoreAny(Admin $admin)
    {
        return $admin->hasRole('super-admin');
    }


    public function replicate(Admin $admin)
    {
        return $admin->hasRole('super-admin');
    }

    public function reorder(Admin $admin)
    {
        return $admin->hasRole('super-admin');
    }
}
