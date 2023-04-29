<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\ApplicationFile;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicationFilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view any models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $admin)
    {
        return $admin->can('view_any_application::file');
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\ApplicationFile  $applicationFile
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, ApplicationFile $applicationFile)
    {
        return $admin->can('view_application::file');
    }

    /**
     * Determine whether the admin can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->can('create_application::file');
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\ApplicationFile  $applicationFile
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, ApplicationFile $applicationFile)
    {
        return $admin->can('update_application::file');
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\ApplicationFile  $applicationFile
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, ApplicationFile $applicationFile)
    {
        return $admin->can('delete_application::file');
    }

    /**
     * Determine whether the admin can bulk delete.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteAny(Admin $admin)
    {
        return $admin->can('delete_any_application::file');
    }

    /**
     * Determine whether the admin can permanently delete.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\ApplicationFile  $applicationFile
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, ApplicationFile $applicationFile)
    {
        return $admin->can('force_delete_application::file');
    }

    /**
     * Determine whether the admin can permanently bulk delete.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteAny(Admin $admin)
    {
        return $admin->can('force_delete_any_application::file');
    }

    /**
     * Determine whether the admin can restore.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\ApplicationFile  $applicationFile
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, ApplicationFile $applicationFile)
    {
        return $admin->can('restore_application::file');
    }

    /**
     * Determine whether the admin can bulk restore.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreAny(Admin $admin)
    {
        return $admin->can('restore_any_application::file');
    }

    /**
     * Determine whether the admin can replicate.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\ApplicationFile  $applicationFile
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function replicate(Admin $admin, ApplicationFile $applicationFile)
    {
        return $admin->can('replicate_application::file');
    }

    /**
     * Determine whether the admin can reorder.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reorder(Admin $admin)
    {
        return $admin->can('reorder_application::file');
    }

}
