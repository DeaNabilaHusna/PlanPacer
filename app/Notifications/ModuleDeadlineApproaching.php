<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\User;
use App\Models\Modul;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ModuleDeadlineApproaching extends Notification
{
    use Queueable;

    public $module;
    public $user; 

    /**
     * Create a new notification instance.
     */
    public function __construct(Modul $module, User $user)
    {
        $this->module = $module;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'module_id' => $this->module->id,
            'message' => "Deadline modul {$this->module->modul_name} akan segera tiba dalam 2 hari.",
            'username' => $this->user->username,
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line("Deadline modul {$this->module->modul_name} akan segera tiba dalam 2 hari.")
            ->action('Lihat Modul', url("/modules/{$this->module->id}"));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'username' => $this->user->username,
            'message' => 'Deadline modul akan segera tiba dalam 2 hari.',
            'modul_id' => $this->module->id,
        ];
    }
}
