<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
            ['name' => 'Айзек Азимов'],
            ['name' => 'Агата Кристи'],
            ['name' => 'Стивен Хокинг'],
            ['name' => 'Артур Конан Дойл'],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}
