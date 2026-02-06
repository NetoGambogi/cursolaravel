<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class PostPolicy
{
    // passe livre pra TODAS AS POLICIES. ele ignora tudo, ganha todas as permissões
    public function before(User $user)
    {
        if($user->name === 'SUPER'){
            return true;
        }

        return null;
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post): bool
    {
        return ($user->role === 'admin' || $user->id === $post->user_id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        // if ($user->role !== 'visitor') {
        //     return true;
        // }
        // return false;

        // return $user->permissions()->where('permission', 'create_post')->exists();

        // essa é a opção mais performática
        // return $user->permissions->contains('permission', 'create_post');
    
        // foreach(Auth::user()->permissions as $permission){
        //     if($permission['permission'] == 'create_post'){
        //         return true;
        //     } 
        // }
        // return false;

        // ------------------------------------------------
        if($user->permissions->contains('permission', 'create_post')){
            return Response::allow();
        } else {
            return Response::denyWithStatus(403, 'Você não tem permissão para essa ação.');
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): bool
    {
        // return $user->id === $post->user_id;

        return $user->permissions->contains('permission', 'update_post');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        // return $user->role === 'admin';

        return $user->permissions->contains('permission', 'delete_post');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return true;
    }
}
