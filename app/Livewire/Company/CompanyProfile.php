<?php

namespace App\Livewire\Company;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use Mary\Traits\Toast;
use Illuminate\Support\Facades\Auth;

#[Title('Perfil da Empresa')]
#[Layout('components.layouts.company')]
class CompanyProfile extends Component
{
    use WithFileUploads, Toast;

    public $name;
    public $email;
    public $phone;
    public $address;
    public $logo;
    public $logoUrl;

    public function mount()
    {
        // Carrega os dados da empresa
        $company = Auth::user()->company;
        $this->name = $company->name;
        $this->email = $company->email;
        $this->phone = $company->phone;
        $this->address = $company->address;
        $this->logoUrl = $company->logo_url;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048', // 2MB
        ]);

        // Atualiza os dados da empresa
        $company = Auth::user()->company;
        $company->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
        ]);

        // Faz o upload do logo, se existir
        if ($this->logo) {
            $path = $this->logo->store('public/company-logos');
            $company->update(['logo_url' => asset(str_replace('public', 'storage', $path))]);
        }

        // Mensagem de sucesso
        $this->toast(
            type: 'success',
            title: 'Perfil da empresa atualizado com sucesso!',
        );
    }

    public function render()
    {
        return view('livewire.company.company-profile');
    }
}
