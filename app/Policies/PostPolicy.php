<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the news.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function view(User $user, Post $post)
    {
    return $user->type === 'administrador';
    }

    /**
     * Determine whether the user can create news.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the news.
     *
     * @param  \App\User  $user
     * @param  \App\Models\News  $news
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        return $user->id == $post->user_id;
    }

    /**
     * Determine whether the user can delete the news.
     *
     * @param  \App\User  $user
     * @param  \App\Models\News  $news
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can restore the news.
     *
     * @param  \App\User  $user
     * @param  \App\Models\News  $news
     * @return mixed
     */
    public function restore(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the news.
     *
     * @param  \App\User  $user
     * @param  \App\Models\News  $news
     * @return mixed
     */
    public function forceDelete(User $user, Post $post)
    {
        //
    }
}
