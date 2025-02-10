<?php

namespace App\Notifications;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewEventCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Event $event,
        public string $password 
    )
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Novo Evento Criado')
            ->line('Um novo evento foi criado na plataforma.')
            ->line('Detalhes do Evento:')
            ->line('Nome: ' . $this->event->name)
            ->line('Descrição: ' . $this->event->description)
            ->line('Data de Início: ' . $this->event->start_date)
            ->line('Data de Término: ' . $this->event->end_date)
            ->line('Sua senha temporária é: ' . $this->password)
            ->action('Acessar Painel', route('login'))
            ->line('Por favor, altere sua senha ao acessar o sistema.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
