<p>Здравствуйте, {{ $order->user->name }}!</p>
<p>Срок аренды книги <strong>{{ $order->book->title }}</strong> истекает
    {{ \Illuminate\Support\Carbon::parse($order->end_date)->format('d.m.Y') }}.</p>
<p>Пожалуйста, верните книгу вовремя или продлите аренду.</p>
