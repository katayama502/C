<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\User;

class StudentPolicy
{
    public function view(User $user, Student $student): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isStudent()) {
            return $student->user_id === $user->id;
        }

        if ($user->isParent()) {
            return $user->parentProfile
                && $user->parentProfile->students->contains($student->id);
        }

        return false;
    }
}
