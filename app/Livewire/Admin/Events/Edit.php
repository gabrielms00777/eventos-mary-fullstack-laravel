<?php

namespace App\Livewire\Admin\Events;

use App\Livewire\Forms\Admin\EventForm;
use App\Models\Company;
use App\Models\Event;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Mary\Traits\Toast;

#[Title('Evento')]
#[Layout('components.layouts.admin')]
class Edit extends Component
{
    use Toast;

    public Event $event;
    public EventForm $form;
    public bool $isEditing = false;

    public function mount()
    {
        $this->form->setEvent($this->event);
    }

    #[Computed()]
    public function companies()
    {
        return Company::query()->select('name', 'id')->get();
    }

    public function save()
    {
        $this->form->update($this->event);

        $this->success(
            title: 'Evento atualizado com sucesso!!!',
        );

        $this->isEditing = false;
    }

    public function render()
    {
        return view('livewire.admin.events.edit');
    }
}
