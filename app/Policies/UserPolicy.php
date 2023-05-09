<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
        return $admin->hasRole('super-admin') || $admin->hasPermissionTo('students.view_any');
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param \App\Models\Admin $admin
     * @param \App\Models\User  $user
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin)
    {
        return $admin->hasRole('super-admin') || $admin->hasPermissionTo('students.view');
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param \App\Models\Admin              $admin
     * @param \Spatie\Permission\Models\Role $role
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin)
    {
        return $admin->hasRole('super-admin') || $admin->hasPermissionTo('students.update');
    }
}
