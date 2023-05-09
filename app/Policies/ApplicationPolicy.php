<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Application;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view any models.
     *
     * @param \App\Models\Admin $admin
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasRole('super-admin') || $admin->hasPermissionTo('applications.view_any');
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param \App\Models\Admin       $admin
     * @param \App\Models\Application $application
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin)
    {
        return $admin->hasRole('super-admin') || $admin->hasPermissionTo('applications.view');
    }


    /**
     * Determine whether the admin can update the model.
     *
     * @param \App\Models\Admin       $admin
     * @param \App\Models\Application $application
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Application $application)
    {
        return $admin->hasRole('super-admin') || $admin->hasPermissionTo('applications.update');
    }
}
