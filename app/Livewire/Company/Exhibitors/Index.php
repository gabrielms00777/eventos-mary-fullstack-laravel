<?php

namespace App\Livewire\Company\Exhibitors;

use Livewire\Component;
use App\Models\Exhibitor;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Expositores')]
#[Layout('components.layouts.company')]
class Index extends Component
{
    use WithPagination;

    public $search;

    public function render()
    {
        $exhibitors = Exhibitor::where('company_id', Auth::user()->company_id)
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.company.exhibitors.index', [
            'exhibitors' => $exhibitors,
        ]);
    }

    public function delete($id)
    {
        Exhibitor::find($id)->delete();
        session()->flash('message', 'Expositor excluído com sucesso.');
    }
}
