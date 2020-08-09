<?php

namespace App\Policies;

use App\Estabelecimento;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class EstabelecimentoPolicy
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
        foreach ($user->roles as $role) {
            if ($role->id == 2) return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Estabelecimento  $estabelecimento
     * @return mixed
     */
    public function view(User $user, Estabelecimento $estabelecimento)
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
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Estabelecimento  $estabelecimento
     * @return mixed
     */
    public function update(User $user, Estabelecimento $estabelecimento)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Estabelecimento  $estabelecimento
     * @return mixed
     */
    public function delete(User $user, Estabelecimento $estabelecimento)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Estabelecimento  $estabelecimento
     * @return mixed
     */
    public function restore(User $user, Estabelecimento $estabelecimento)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Estabelecimento  $estabelecimento
     * @return mixed
     */
    public function forceDelete(User $user, Estabelecimento $estabelecimento)
    {
        //
    }
}
