<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can delete the given project.
     *
     * @param  User  $user
     * @param  Project  $project
     * @return bool
     */
    public function destroy(User $user, Project $project)
    {
        return $user->id === $project->user_id;
    }
    
    public function checkProjectOwner(User $user, Project $project)
    {
        return $user->id === $project->user_id;
    } 

    public function checkIsMember(User $user, Project $project)
    {
        // Check if user's name exists in the long string column
        return strpos($project->members, $user->name) !== false;
    } 
    
}
