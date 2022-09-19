<?php

namespace App\Policies;

use App\Models\User;
use App\Models\item;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Facades\UserPermissions;

class ItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return UserPermissions::isAuthorized('items.index');

    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\item  $item
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, item $item)
    {
        return UserPermissions::isAuthorized('items.show');

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return UserPermissions::isAuthorized('items.create');

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\item  $item
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, item $item)
    {
        return UserPermissions::isAuthorized('items.edit');

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\item  $item
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, item $item)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\item  $item
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, item $item)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\item  $item
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, item $item)
    {
        //
    }
}
