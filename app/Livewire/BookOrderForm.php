<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Book;
use App\Models\BookOrder;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookOrderForm extends Component
{
    public Book $book;
    public $type = 'rent'; // rent или buy
    public $period = '2_weeks'; // для аренды
    public $price = 0;

    public function mount(Book $book)
    {
        $this->book = $book;
        $this->updatePrice();
    }

    public function updatedType()
    {
        $this->updatePrice();
    }

    public function updatedPeriod()
    {
        $this->updatePrice();
    }

    public function updatePrice()
    {
        if ($this->type === 'buy') {
            $this->price = $this->book->price;
        } else {
            // Примерная логика ценообразования аренды
            $base = $this->book->price * 0.2;
            if ($this->period === '2_weeks') $this->price = round($base, 2);
            if ($this->period === '1_month') $this->price = round($base * 1.5, 2);
            if ($this->period === '3_months') $this->price = round($base * 3, 2);
        }
    }

    public function order()
    {
        $orderData = [
            'user_id' => Auth::id(),
            'book_id' => $this->book->id,
            'type' => $this->type,
            'price' => $this->price,
        ];

        if ($this->type === 'rent') {
            $start = Carbon::today();
            $end = match ($this->period) {
                '2_weeks' => $start->copy()->addWeeks(2),
                '1_month' => $start->copy()->addMonth(),
                '3_months' => $start->copy()->addMonths(3),
            };
            $orderData['start_date'] = $start;
            $orderData['end_date'] = $end;
        }

        BookOrder::create($orderData);

        session()->flash('success', 'Заказ успешно оформлен!');
        $this->dispatch('orderCreated');
    }

    public function render()
    {
        return view('livewire.book-order-form');
    }
}
