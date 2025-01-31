<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exhibitor extends Model
{
    /** @use HasFactory<\Database\Factories\ExhibitorFactory> */
    use HasFactory;

    protected $fillable = ['event_id', 'company_id', 'status'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
