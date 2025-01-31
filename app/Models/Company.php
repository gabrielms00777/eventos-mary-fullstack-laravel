<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;

    protected $fillable = ['name', 'cnpj', 'email', 'phone', 'address'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function visitors()
    {
        return $this->hasMany(Visitor::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
