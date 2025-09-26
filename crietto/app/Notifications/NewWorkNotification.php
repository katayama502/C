<?php

namespace App\Notifications;

use App\Models\Work;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewWorkNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(private Work $work)
    {
    }

    public function via(object $notifiable): array
    {
        $channels = ['mail'];
        if ($notifiable->notification_enabled) {
            $channels[] = 'database';
        }

        return $channels;
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('新しい作品が投稿されました')
            ->greeting('こんにちは '.$notifiable->user->name.' さん')
            ->line($this->work->student->user->name.'さんが新しい作品を投稿しました。')
            ->line('タイトル: '.$this->work->title)
            ->action('作品を見る', url(route('parent.children.show', $this->work->student_id)));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'student_id' => $this->work->student_id,
            'work_title' => $this->work->title,
        ];
    }
}
