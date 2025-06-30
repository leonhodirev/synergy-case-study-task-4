<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Book;

class BookManager extends Component
{
    use WithPagination;

    public $editingBook = null;
    public $editForm = [
        'title' => '',
        'price' => '',
        'status' => '',
        'is_available' => false,
    ];

    public $statuses = ['новая', 'б/у', 'распродажа'];

    public function edit($bookId)
    {
        $book = Book::findOrFail($bookId);
        $this->editingBook = $book->id;
        $this->editForm = [
            'title' => $book->title,
            'price' => $book->price,
            'status' => $book->status,
            'is_available' => $book->is_available,
        ];
    }

    public function update()
    {
        $this->validate([
            'editForm.title' => 'required|string|max:255',
            'editForm.price' => 'required|numeric|min:0',
            'editForm.status' => 'required|string',
            'editForm.is_available' => 'boolean',
        ]);

        $book = Book::findOrFail($this->editingBook);
        $book->update($this->editForm);

        $this->editingBook = null;
        session()->flash('success', 'Книга обновлена!');
    }

    public function cancelEdit()
    {
        $this->editingBook = null;
    }

    public function render()
    {
        return view('livewire.admin.book-manager', [
            'books' => Book::with(['author', 'category'])->orderBy('id')->paginate(10),
        ]);
    }
}
