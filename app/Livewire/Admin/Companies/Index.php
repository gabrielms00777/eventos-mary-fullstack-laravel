<?php

namespace App\Livewire\Admin\Companies;

use App\Models\Company;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('Empresas')]
#[Layout('components.layouts.admin')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $sortBy = ['column' => 'nome', 'direction' => 'asc'];
    public array $headers = [
        ['key' => 'name', 'label' => 'Nome', 'class' => 'w-64'],
        ['key' => 'cnpj', 'label' => 'CNPJ', 'class' => 'w-64'],
        ['key' => 'email', 'label' => 'E-mail'],
        ['key' => 'phone', 'label' => 'Telefone', 'sortable' => false]

    ];

    #[Computed()]
    public function rows()
    {
        return Company::query()
            // ->sortBy(...array_values($this->sortBy))
            // ->when($this->search, function ($query) {
            //     return $query->where('nome', 'like', '%' . $this->search . '%');
            // })
            ->select('id', 'name', 'cnpj', 'email', 'phone')
            ->paginate();
    }

    public function render()
    {
        return view('livewire.admin.companies.index');
    }
}
