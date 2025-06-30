<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;

class BookShow extends Component
{
    public $book;

    public function mount($id)
    {
        $this->book = Book::with(['author', 'category'])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.book-show');
    }
}
