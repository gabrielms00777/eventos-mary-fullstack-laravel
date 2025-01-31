<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory, HasUuids;

    protected $fillable = [
        'company_id',
        'name',
        'description',
        'location',
        'max_participants',
        'start_date',
        'end_date',
        'image_url',
    ];

    // protected $fillable = ['company_id', 'name', 'description', 'start_date', 'end_date', 'location', 'status'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function exhibitors()
    {
        return $this->hasMany(Exhibitor::class);
    }
}
