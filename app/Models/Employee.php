<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'city',
        'last_name',
        'country_id',
        'first_name',
        'postal_code',
        'date_of_birth',
        'email_address',
        'contact_number',
        'street_address',
    ];

    /**
     * Get the country the employee belongs to.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the skills that belong to the employee.
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
}
