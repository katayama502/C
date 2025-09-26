<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

class ParentProfile extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'notification_enabled',
    ];

    protected $casts = [
        'notification_enabled' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'parent_student');
    }

    public function routeNotificationForMail(): string
    {
        return $this->user->email;
    }
}
