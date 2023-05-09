<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

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
        return $admin->hasRole('internship-coordinator');
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
        return $admin->hasRole('internship-coordinator');
    }
    /**
     * Determine whether the admin can create models.
     *
     * @param \App\Models\Admin $admin
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasRole('super-admin');
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
        return $admin->hasRole('super-admin');
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param \App\Models\Admin              $admin
     * @param \Spatie\Permission\Models\Role $role
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin)
    {
        return $admin->hasRole('super-admin');
    }

    /**
     * Determine whether the admin can bulk delete.
     *
     * @param \App\Models\Admin $admin
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteAny(Admin $admin)
    {
        return $admin->hasRole('super-admin');
    }

    /**
     * Determine whether the admin can permanently delete.
     *
     * @param \App\Models\Admin              $admin
     * @param \Spatie\Permission\Models\Role $role
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin)
    {
        return $admin->hasRole('super-admin');
    }

    /**
     * Determine whether the admin can permanently bulk delete.
     *
     * @param \App\Models\Admin $admin
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteAny(Admin $admin)
    {
        return $admin->hasRole('super-admin');
    }

    /**
     * Determine whether the admin can restore.
     *
     * @param \App\Models\Admin              $admin
     * @param \Spatie\Permission\Models\Role $role
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin)
    {
        return $admin->hasRole('super-admin');
    }

    /**
     * Determine whether the admin can bulk restore.
     *
     * @param \App\Models\Admin $admin
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreAny(Admin $admin)
    {
        return $admin->hasRole('super-admin');
    }

    /**
     * Determine whether the admin can replicate.
     *
     * @param \App\Models\Admin              $admin
     * @param \Spatie\Permission\Models\Role $role
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function replicate(Admin $admin)
    {
        return $admin->hasRole('super-admin');
    }

    /**
     * Determine whether the admin can reorder.
     *
     * @param \App\Models\Admin $admin
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reorder(Admin $admin)
    {
        return $admin->hasRole('super-admin');
    }
}
