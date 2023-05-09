<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class PermissionPolicy
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
        return $admin->hasRole('super-admin');
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param \App\Models\Admin              $admin
     * @param \Spatie\Permission\Models\Role $role
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Role $role)
    {
        return $admin->hasRole('super-admin');
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
    public function update(Admin $admin, Role $role)
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
    public function delete(Admin $admin, Role $role)
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
    public function forceDelete(Admin $admin, Role $role)
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
    public function restore(Admin $admin, Role $role)
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
    public function replicate(Admin $admin, Role $role)
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
