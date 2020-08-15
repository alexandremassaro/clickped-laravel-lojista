<?php

namespace App\Policies;

use App\Mesa;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class MesaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Mesa  $mesa
     * @return mixed
     */
    public function view(User $user, Mesa $mesa)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return Auth::user()->id == $user->id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Mesa  $mesa
     * @return mixed
     */
    public function update(User $user, Mesa $mesa)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Mesa  $mesa
     * @return mixed
     */
    public function delete(User $user, Mesa $mesa)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Mesa  $mesa
     * @return mixed
     */
    public function restore(User $user, Mesa $mesa)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Mesa  $mesa
     * @return mixed
     */
    public function forceDelete(User $user, Mesa $mesa)
    {
        //
    }
}
