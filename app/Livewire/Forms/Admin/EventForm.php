<?php

namespace App\Livewire\Forms\Admin;

use App\Models\Event;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EventForm extends Form
{
    public ?Event $event = null;

    #[Validate(['required', 'string', 'max:255'])]
    public ?string $name = null;

    #[Validate(['required', 'integer', 'min:0'])]
    public ?int $max_participants = null;

    #[Validate(['required', 'date'])]
    public ?string $start_date = null;

    #[Validate(['required', 'date', 'after_or_equal:start_date'])]
    public ?string $end_date = null;

    #[Validate(['string', 'url', 'max:255', 'nullable'])]
    public ?string $image_url = null;

    #[Validate(['required', 'integer'])]
    public ?int $company_id = null;

    #[Validate(['string', 'nullable'])]
    public ?string $description = null;

    #[Validate(['string', 'nullable', 'max:255'])]
    public ?string $location = null;


    public function setEvent(Event $event)
    {
        $this->event = $event;
        $this->company_id = $event->company_id;
        $this->name = $event->name;
        $this->max_participants = $event->max_participants;
        $this->start_date = $event->start_date;
        $this->end_date = $event->end_date;
        $this->image_url = $event->image_url;
        $this->description = $event->description;
        $this->location = $event->location;
    }

    public function store()
    {
        Event::create($this->validate());
    }

    public function update()
    {
        $this->validate();

        $this->event->update($this->all());
    }
}
