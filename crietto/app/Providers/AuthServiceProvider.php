<?php

namespace App\Providers;

use App\Models\GrowthRecord;
use App\Models\Student;
use App\Models\Work;
use App\Policies\GrowthRecordPolicy;
use App\Policies\StudentPolicy;
use App\Policies\WorkPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        GrowthRecord::class => GrowthRecordPolicy::class,
        Work::class => WorkPolicy::class,
        Student::class => StudentPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('view-admin-dashboard', function ($user) {
            return $user->isAdmin();
        });

        Gate::define('view-parent-dashboard', function ($user) {
            return $user->isParent();
        });

        Gate::define('view-student-dashboard', function ($user) {
            return $user->isStudent();
        });
    }
}
