<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Work;

class WorkPolicy
{
    public function view(User $user, Work $work): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isStudent()) {
            return $work->student->user_id === $user->id;
        }

        if ($user->isParent()) {
            return $user->parentProfile
                && $user->parentProfile->students->contains($work->student_id);
        }

        return false;
    }

    public function update(User $user, Work $work): bool
    {
        return $user->isStudent() && $work->student->user_id === $user->id;
    }

    public function delete(User $user, Work $work): bool
    {
        return $this->update($user, $work);
    }
}
