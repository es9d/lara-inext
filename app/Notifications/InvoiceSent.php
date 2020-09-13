<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class InvoiceSent extends Notification
{
    /**
     * Public Variables
     */
    public $invoice;
    public $company;

    /**
     * Create a notification instance.
     *
     * @param \App\Models\Invoice  $invoice
     * @return void
     */
    public function __construct($invoice)
    {
        $this->invoice = $invoice;
        $this->company = $invoice->company;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('messages.invoice_sent', ['invoice_number' => $this->invoice->invoice_number]))
            ->view('emails.notifications.invoice_sent');
    }
}