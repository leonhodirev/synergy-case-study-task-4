<div>
    <h2 class="text-2xl font-bold mb-4">Управление книгами</h2>
    @if(session()->has('success'))
        <div class="text-green-600 mb-2">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300" style="width: 100%;">
            <thead>
            <tr class="bg-gray-100">
                <th class="px-3 py-2 border">ID</th>
                <th class="px-3 py-2 border">Название</th>
                <th class="px-3 py-2 border">Автор</th>
                <th class="px-3 py-2 border">Категория</th>
                <th class="px-3 py-2 border">Год</th>
                <th class="px-3 py-2 border">Цена</th>
                <th class="px-3 py-2 border">Статус</th>
                <th class="px-3 py-2 border">Доступна</th>
                <th class="px-3 py-2 border">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($books as $book)
                <tr wire:key="book-{{ $book->id }}">
                    @if($editingBook === $book->id)
                        <td class="border px-2 py-1">{{ $book->id }}</td>
                        <td class="border px-2 py-1">
                            <input type="text" wire:model.defer="editForm.title" class="border rounded px-2 py-1 w-full" placeholder="Название">
                        </td>
                        <td class="border px-2 py-1">{{ $book->author->name ?? '-' }}</td>
                        <td class="border px-2 py-1">{{ $book->category->name ?? '-' }}</td>
                        <td class="border px-2 py-1">{{ $book->year }}</td>
                        <td class="border px-2 py-1">
                            <input type="number" wire:model.defer="editForm.price" class="border rounded px-2 py-1 w-full" placeholder="Цена">
                        </td>
                        <td class="border px-2 py-1">
                            <select wire:model.defer="editForm.status" class="border rounded px-2 py-1 w-full">
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}">{{ $status }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="border px-2 py-1 text-center">
                            <input type="checkbox" wire:model.defer="editForm.is_available">
                        </td>
                        <td class="border px-2 py-1">
                            <button wire:click="update" class="px-3 py-1 bg-green-600 text-white rounded">Сохранить</button>
                            <button wire:click="cancelEdit" class="px-3 py-1 bg-gray-400 text-white rounded">Отмена</button>
                        </td>
                    @else
                        <td class="border px-2 py-1">{{ $book->id }}</td>
                        <td class="border px-2 py-1">{{ $book->title }}</td>
                        <td class="border px-2 py-1">{{ $book->author->name ?? '-' }}</td>
                        <td class="border px-2 py-1">{{ $book->category->name ?? '-' }}</td>
                        <td class="border px-2 py-1">{{ $book->year }}</td>
                        <td class="border px-2 py-1">{{ $book->price }}</td>
                        <td class="border px-2 py-1">{{ $book->status }}</td>
                        <td class="border px-2 py-1 text-center">{{ $book->is_available ? 'Да' : 'Нет' }}</td>
                        <td class="border px-2 py-1">
                            <button wire:click="edit({{ $book->id }})" class="px-3 py-1 bg-blue-600 text-white rounded">Редактировать</button>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $books->links() }}
    </div>
</div>
