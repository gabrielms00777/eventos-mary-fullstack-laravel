<?php

namespace App\Livewire\Forms\Admin;

use App\Enums\UserTypeEnum;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Event;
use App\Models\User;
use App\Notifications\NewEventCreatedNotification;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EventForm extends Form
{
    public ?Event $event = null;

    #[Validate(['required', 'string', 'max:255'])]
    public ?string $name = null;

    #[Validate(['required', 'integer', 'min:1'])]
    public ?int $max_participants = null;

    #[Validate(['required', 'date'])]
    public ?string $start_date = null;

    #[Validate(['required', 'date', 'after_or_equal:start_date'])]
    public ?string $end_date = null;

    #[Validate(['required', 'integer'])]
    public ?int $company_id = null;

    #[Validate(['string', 'nullable'])]
    public ?string $description = null;

    #[Validate(['string', 'nullable', 'max:255'])]
    public ?string $location = null;

    #[Validate(['nullable', 'image', 'max:2048'])]
    public $image;

    public ?string $image_url = null;

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
        
        $this->validate();

        DB::beginTransaction();
        
        if ($this->image) {
            $this->image_url = $this->uploadImage($this->image);
        }

        $event = Event::create([
            'name' => $this->name,
            'description' => $this->description,
            'location' => $this->location,
            'max_participants' => $this->max_participants,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'company_id' => $this->company_id,
            'image_url' => $this->image_url,
        ]);

        $adminOrMange = User::whereHas('employee', function ($query) {
            $query->where('company_id', $this->company_id)
                ->whereIn('role', [UserTypeEnum::ADMIN, UserTypeEnum::MANAGER]);
        })->first();
        
        if($adminOrMange){
            $password = Str::random(10);
            $adminOrMange->update([
                'password' => Hash::make($password),
                'last_event_id' => $event->id,
            ]);

            $adminOrMange->notify(new NewEventCreatedNotification($event, $password));
        }

        DB::commit();
        return;
        // try {

        // } catch (\Exception $e) {
        //     DB::rollBack();

        //     throw $e;
        // }
    }

    public function update()
    {
        if ($this->image) {
            $this->image_url = $this->uploadImage($this->image);
        }

        $this->event->update([
            'name' => $this->name,
            'description' => $this->description,
            'location' => $this->location,
            'max_participants' => $this->max_participants,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'image_url' => $this->image_url,
        ]);
    }

    protected function uploadImage($image)
    {
        return Storage::url($image->store('public/events'));
    }
}
