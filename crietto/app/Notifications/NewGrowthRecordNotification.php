<?php

namespace App\Notifications;

use App\Models\GrowthRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewGrowthRecordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(private GrowthRecord $record)
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
            ->subject('新しい成長記録が投稿されました')
            ->greeting('こんにちは '.$notifiable->user->name.' さん')
            ->line($this->record->student->user->name.'さんが新しい学習記録を投稿しました。')
            ->line($this->record->content)
            ->action('記録を見る', url(route('parent.children.show', $this->record->student_id)));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'student_id' => $this->record->student_id,
            'content' => $this->record->content,
        ];
    }
}
