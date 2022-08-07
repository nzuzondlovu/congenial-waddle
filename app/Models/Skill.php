<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skill extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the employees that owns the skill.
     */
    public function employees()
    {
        return $this->belongsToMany(Employee::class)->withPivot('years', 'seniority_rating');
    }
}
