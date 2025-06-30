<x-slot name="title">Книга: {{ $book->title ?? 'Без названия' }}</x-slot>
<div class="p-4">
    <h2 class="text-xl font-bold mb-2">{{ $book->title ?? 'Без названия' }}</h2>
    <p><strong>Автор:</strong> {{ $book->author->name ?? '-' }}</p>
    <p><strong>Категория:</strong> {{ $book->category->name ?? '-' }}</p>
    <p><strong>Год:</strong> {{ $book->year }}</p>
    <p><strong>Цена:</strong> {{ $book->price }} руб.</p>
    <p><strong>Статус:</strong> {{ $book->status }}</p>
    <p><strong>Доступность:</strong> {{ $book->is_available ? 'Да' : 'Нет' }}</p>
    <a href="{{ route('books.list') }}" class="text-blue-500 underline mt-4 inline-block">Назад к списку</a>

    <hr>
    <br>
    <livewire:book-order-form :book="$book" />
</div>
