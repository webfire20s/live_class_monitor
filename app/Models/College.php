<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class College extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'address',
        'contact_number',
        'username',
        'college_code',
        'email',
        'password',
        'is_active',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'password' => 'hashed',
    ];

    /**
     * Get the students for the college.
     */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
