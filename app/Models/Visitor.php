<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    /** @use HasFactory<\Database\Factories\VisitorFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'company_id', 'phone'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }
}
