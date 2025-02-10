<?php

namespace App\Models;

use App\Enums\EmployeeTypeEnum;
use App\Enums\EventStatusEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'status' => EventStatusEnum::class,
        ];
    }

    // protected $fillable = ['company_id', 'name', 'description', 'start_date', 'end_date', 'location', 'status'];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'event_employee');
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function exhibitors(): HasMany
    {
        return $this->hasMany(Exhibitor::class);
    }
}
