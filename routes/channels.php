<?php

use App\Order;
use App\Project;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('pizza-tracker.{id}', function ($user, $id) {
    return (int) $user->id === (int) Order::find($id)->user_id;
});

Broadcast::channel('tasks.{project}', function ($user,Project $project) {
    if($project->participants->contains($user))
    {
        return ['name'=>$user->name];
    }
    
    return $project->participants->contains($user);
});
