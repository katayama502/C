<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GrowthRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'content',
        'mood',
        'learning_time',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
