<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;

use App\Models\User;
use App\Models\Project;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProjectDeadlineApproaching extends Notification
{
    use Queueable;

    public $project;
    public $user;
    /**
     * Create a new notification instance.
     */
    public function __construct(Project $project, User $user)
    {
        $this->project = $project;
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
            'project_id' => $this->project->id,
            'message' => "Deadline proyek {$this->project->project_name} akan segera tiba dalam 2 hari.",
            'username' => $this->user->username,
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line("Deadline proyek {$this->project->project_name} akan segera tiba dalam 2 hari.")
            ->action('Lihat Proyek', url("/projects/{$this->project->id}"));
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
            'message' => 'Deadline proyek akan segera tiba dalam 2 hari.',
            'project_id' => $this->project->id,
        ];
    }
}
