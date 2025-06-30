<div class="space-y-4">
    <h2 class="text-xl font-bold">Оформление заказа: {{ $book->title }}</h2>
    <div>
        <label>
            <input type="radio" wire:model="type" value="rent"> Аренда
        </label>
        <label class="ml-4">
            <input type="radio" wire:model="type" value="buy"> Покупка
        </label>
    </div>

    @if($type === 'rent')
        <div>
            <label>Срок аренды:</label>
            <select wire:model="period" class="ml-2">
                <option value="2_weeks">2 недели</option>
                <option value="1_month">1 месяц</option>
                <option value="3_months">3 месяца</option>
            </select>
        </div>
    @endif

    <div>
        <strong>Стоимость: {{ $price }} ₽</strong>
    </div>

    <button wire:click="order" class="px-4 py-2 bg-blue-600 text-white rounded">Оформить</button>

    @if(session()->has('success'))
        <div class="text-green-600 mt-2">{{ session('success') }}</div>
    @endif
</div>
