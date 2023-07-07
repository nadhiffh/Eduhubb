<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model
{
    use HasFactory, SoftDeletes;

    const SEMESTERS = [
        self::SEMESTER_ODD,
        self::SEMESTER_FALL,
        self::SEMESTER_EVEN,
        self::SEMESTER_SPRING
    ];
    const SEMESTER_ODD = "odd"; // semester ganjil
    const SEMESTER_FALL = "fall"; // semester pendek ganjil
    const SEMESTER_EVEN = "even"; // semester genap
    const SEMESTER_SPRING = "spring"; // semester pendek genap

    protected $guarded = [];

    protected $with = [
        'user'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
