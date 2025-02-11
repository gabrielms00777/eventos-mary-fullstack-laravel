<?php

namespace App\Livewire\Company\Access;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Mary\Traits\Toast;

#[Title('Acesso')]
#[Layout('components.layouts.company')]
class Index extends Component
{
    use Toast;

    public $search;
    public $users;

    public function mount()
    {
        // Carrega os usuários da empresa
        $this->users = User::where('company_id', Auth::user()->company_id)
            ->orderBy('name')
            ->get();
    }

    public function updateRole($userId, $role)
    {
        // Atualiza o papel do usuário
        $user = User::find($userId);
        $user->update(['role' => $role]);

        // Mensagem de sucesso
        $this->toast(
            type: 'success',
            title: 'Papel do usuário atualizado com sucesso!',
        );
    }

    public function render()
    {
        return view('livewire.company.access.index');
    }
}
