<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BookOrder;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendRentalReminders extends Command
{
    protected $signature = 'rental:reminders {graduationDays=2}';
    protected $description = 'Отправить напоминания об окончании срока аренды книг';

    public function handle()
    {
        $today = Carbon::today();
        $soon = $today->copy()->addDays((int) $this->argument('graduationDays')); // за 2 дня до окончания

        $orders = BookOrder::where('type', 'rent')
            ->whereDate('end_date', '<=', $soon)
            ->with('user', 'book')
            ->get();

        $this->line('Всего заказов:' . count($orders));

        foreach ($orders as $order) {
            if ($order->user && $order->book) {
                Mail::to($order->user->email)->send(
                    new \App\Mail\RentalReminderMail($order)
                );

                $this->info("Напоминание отправлено: {$order->user->email} ({$order->book->title})");
            }
        }
    }
}
