<?php

namespace App\Policies;

use App\Models\GrowthRecord;
use App\Models\User;

class GrowthRecordPolicy
{
    public function view(User $user, GrowthRecord $growthRecord): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isStudent()) {
            return $growthRecord->student->user_id === $user->id;
        }

        if ($user->isParent()) {
            return $user->parentProfile
                && $user->parentProfile->students->contains($growthRecord->student_id);
        }

        return false;
    }

    public function update(User $user, GrowthRecord $growthRecord): bool
    {
        return $user->isStudent() && $growthRecord->student->user_id === $user->id;
    }

    public function delete(User $user, GrowthRecord $growthRecord): bool
    {
        return $this->update($user, $growthRecord);
    }
}
