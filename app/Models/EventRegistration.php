<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    /** @use HasFactory<\Database\Factories\ExhibitorFactory> */
    use HasFactory;

    protected $fillable = ['event_id', 'visitor_id', 'status'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}
