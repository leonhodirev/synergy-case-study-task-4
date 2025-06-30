<x-slot name="title">Список книг</x-slot>

<div>
    <div class="mb-4 flex flex-wrap gap-2">
        <button wire:click="sortBy('category')" class="px-3 py-1 border rounded {{ $sortField==='category' ? 'bg-blue-600 text-white' : '' }}">
            Категория
            @if($sortField === 'category')
                @if($sortDirection === 'asc') &uarr; @else &darr; @endif
            @endif
        </button>
        <button wire:click="sortBy('author')" class="px-3 py-1 border rounded {{ $sortField==='author' ? 'bg-blue-600 text-white' : '' }}">
            Автор
            @if($sortField === 'author')
                @if($sortDirection === 'asc') &uarr; @else &darr; @endif
            @endif
        </button>
        <button wire:click="sortBy('year')" class="px-3 py-1 border rounded {{ $sortField==='year' ? 'bg-blue-600 text-white' : '' }}">
            Год написания
            @if($sortField === 'year')
                @if($sortDirection === 'asc') &uarr; @else &darr; @endif
            @endif
        </button>
    </div>

    <div class="space-y-4">
        @foreach($books as $book)
            <div class="p-4 border rounded shadow-sm flex flex-col md:flex-row items-start md:items-center gap-4" wire:key="book-{{ $book->id }}">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold">{{ $book->title ?? 'Без названия' }}</h3>
                    <div class="text-gray-700">
                        <span><strong>Автор:</strong> {{ $book->author->name ?? '-' }}</span><br>
                        <span><strong>Категория:</strong> {{ $book->category->name ?? '-' }}</span><br>
                        <span><strong>Год:</strong> {{ $book->year }}</span><br>
                        <span><strong>Цена:</strong> {{ $book->price }} ₽</span><br>
                        <span><strong>Статус:</strong> {{ $book->status }}</span><br>
                        <span><strong>Доступность:</strong> {{ $book->is_available ? 'Да' : 'Нет' }}</span>
                    </div>
                </div>
                <div>
                    <a href="{{ route('books.show', $book->id) }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Подробнее</a>
                </div>
            </div>
        @endforeach

        <div class="mt-6">
            {{ $books->links() }}
        </div>
    </div>
</div>
