<?php

namespace App\Livewire\Forms\Company;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Exhibitor;
use Illuminate\Support\Facades\Auth;

class ExhibitorForm extends Form
{
    public ?Exhibitor $exhibitor = null;

    #[Validate(['required', 'string', 'max:255'])]
    public ?string $name = null;

    #[Validate(['required', 'string', 'max:255'])]
    public ?string $company = null;

    #[Validate(['required', 'string', 'max:10'])]
    public ?string $stand = null;

    #[Validate(['required', 'email', 'max:255'])]
    public ?string $email = null;

    #[Validate(['required', 'string', 'max:20'])]
    public ?string $phone = null;

    public function setExhibitor(Exhibitor $exhibitor)
    {
        $this->exhibitor = $exhibitor;
        $this->name = $exhibitor->name;
        $this->company = $exhibitor->company;
        $this->stand = $exhibitor->stand;
        $this->email = $exhibitor->email;
        $this->phone = $exhibitor->phone;
    }

    public function store()
    {
        $this->validate();

        Exhibitor::create([
            'company_id' => Auth::user()->company_id,
            'name' => $this->name,
            'company' => $this->company,
            'stand' => $this->stand,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        return Exhibitor::latest()->first()->id;
    }

    public function update()
    {
        $this->validate();

        $this->exhibitor->update([
            'name' => $this->name,
            'company' => $this->company,
            'stand' => $this->stand,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);
    }
}
