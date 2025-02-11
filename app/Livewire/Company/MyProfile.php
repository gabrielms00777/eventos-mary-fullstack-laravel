<?php

namespace App\Livewire\Company;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

#[Title('Meu Perfil')]
#[Layout('components.layouts.company')]
class MyProfile extends Component
{
    public $name;
    public $email;
    public $currentPassword;
    public $newPassword;
    public $newPasswordConfirmation;

    public function mount()
    {
        // Carrega os dados do usuário
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::user()->id,
            'currentPassword' => ['nullable', 'current_password'],
            'newPassword' => ['nullable', 'confirmed'],
        ]);

        // Atualiza os dados do usuário
        $user = Auth::user();
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        // Atualiza a senha, se fornecida
        if ($this->newPassword) {
            $user->update(['password' => Hash::make($this->newPassword)]);
        }

        // Mensagem de sucesso
        $this->toast(
            type: 'success',
            title: 'Perfil atualizado com sucesso!',
        );
    }

    public function render()
    {
        return view('livewire.company.my-profile');
    }
}
