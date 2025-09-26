<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Badge extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'name',
        'description',
        'threshold',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
