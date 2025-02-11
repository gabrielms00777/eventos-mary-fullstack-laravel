<?php

namespace App\Livewire\Forms\Company;

use App\Models\Visitor;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\Auth;

class VisitorForm extends Form
{
    public ?Visitor $visitor = null;

    #[Validate(['required', 'string', 'max:255'])]
    public ?string $name = null;

    #[Validate(['required', 'email', 'max:255', 'unique:visitors,email'])]
    public ?string $email = null;

    #[Validate(['required', 'string', 'max:20'])]
    public ?string $phone = null;

    #[Validate(['required', 'string', 'max:255'])]
    public ?string $company = null;

    #[Validate(['required', 'string', 'max:255'])]
    public ?string $position = null;

    public function setVisitor(Visitor $visitor)
    {
        $this->visitor = $visitor;
        $this->name = $visitor->name;
        $this->email = $visitor->email;
        $this->phone = $visitor->phone;
        $this->company = $visitor->company;
        $this->position = $visitor->position;
    }

    public function store()
    {
        $this->validate();

        // Cria o visitante
        Visitor::create([
            'company_id' => Auth::user()->company_id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company,
            'position' => $this->position,
        ]);

        // Retorna o ID do visitante criado
        return Visitor::latest()->first()->id;
    }

    public function update()
    {
        $this->validate();

        // Atualiza o visitante
        $this->visitor->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company,
            'position' => $this->position,
        ]);
    }
}
