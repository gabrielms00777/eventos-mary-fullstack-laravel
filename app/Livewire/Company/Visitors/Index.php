<?php

namespace App\Livewire\Company\Visitors;

use App\Models\Visitor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Mary\Traits\Toast;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Visitantes')]
#[Layout('components.layouts.company')]
class Index extends Component
{
    use Toast;

    public $search = '';
    public $sortBy = ['column' => 'name', 'direction' => 'asc'];
    public $headers = [
        ['key' => 'name', 'label' => 'Nome', 'class' => 'w-64'],
        ['key' => 'email', 'label' => 'E-mail'], 
        ['key' => 'phone', 'label' => 'Telefone', 'sortable' => false],
        ['key' => 'actions', 'label' => 'Ações', 'class' => 'text-right'],
    ];

    #[Computed]
    public function visitors()
    {
        return Visitor::query()
        ->where('company_id', Auth::user()->company_id)
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name')
            ->paginate(10);
    }

    public function delete(Visitor $visitor)
    {
        $visitor->delete();

        $this->toast(
            type: 'success',
            title: 'Visitante deletado com sucesso!',
        );
    }

    public function render()
    {
        return view('livewire.company.visitors.index');
    }
}
