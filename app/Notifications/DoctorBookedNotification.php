<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DoctorBookedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    // public function toDatabase($notifiable)
    // {

    // }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
{
    return (new MailMessage)
        ->greeting('Dr. ' . $notifiable->name)
        ->line('You have an appointnment: ' . $this->appointment->user->name)
        ->line('Clinic: ' . $this->appointment->clinic->name)
        ->line('Time: ' . $this->appointment->appointment->start_time . ' to ' . $this->appointment->appointment->end_time);
}

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'the patient booked ' . $this->appointment->user->name,
            'clinic_name' => $this->appointment->clinic->name,
            'patient_name' => $this->appointment->user->name,
            'appointment_time' => $this->appointment->appointment->start_time . ' ' . $this->appointment->appointment->end_time,
        ];
    }
}
