<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithPagination;

class BookList extends Component
{
    use WithPagination;

    public $sortField = 'year';
    public $sortDirection = 'desc';

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    public function render()
    {
        $books = Book::with(['author', 'category'])
            ->when($this->sortField === 'category', function ($query) {
                $query->join('categories', 'books.category_id', '=', 'categories.id')
                    ->orderBy('categories.name', $this->sortDirection)
                    ->select('books.*');
            })
            ->when($this->sortField === 'author', function ($query) {
                $query->join('authors', 'books.author_id', '=', 'authors.id')
                    ->orderBy('authors.name', $this->sortDirection)
                    ->select('books.*');
            })
            ->when($this->sortField === 'year', function ($query) {
                $query->orderBy('year', $this->sortDirection);
            })
            ->paginate(10);

        return view('livewire.book-list', [
            'books' => $books,
        ]);
    }
}
