<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use App\Models\BookOrder;

class RentalReminderMail extends Mailable
{
    public $order;

    public function __construct(BookOrder $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('Напоминание об окончании аренды книги')
            ->view('emails.rental_reminder');
    }
}
