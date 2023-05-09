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
        return $admin->hasRole([
            'internship-coordinator',
            'career-center'
        ]);
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param \App\Models\Admin       $admin
     * @param \App\Models\Application $application
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Application $application)
    {
        return $admin->hasRole([
            'internship-coordinator',
            'career-center'
        ]);
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param \App\Models\Admin       $admin
     * @param \App\Models\Application $application
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return false;
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
        return $admin->hasRole('internship-coordinator');
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param \App\Models\Admin       $admin
     * @param \App\Models\Application $application
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin)
    {
        return false;
    }

}
