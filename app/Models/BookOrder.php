<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookOrder extends Model
{
    protected $fillable = [
        'user_id', 'book_id', 'type', 'start_date', 'end_date', 'price'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
