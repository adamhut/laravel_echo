<?php

namespace App\Broadcasting;

use App\User;

class ProjectChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\User  $user
     * @return array|bool
     */
    public function join(User $user, Project $project)
    {
        if ($project->participants->contains($user)) {
            return ['name' => $user->name];
        }
        return false;
    }
}
