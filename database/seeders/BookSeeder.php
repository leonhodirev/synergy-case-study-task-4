<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryIds = Category::pluck('id')->all();
        $authorIds = Author::pluck('id')->all();

        if (empty($categoryIds) || empty($authorIds)) {
            $this->command->warn('Нет категорий или авторов для создания книг!');
            return;
        }

        $titles = [
            'Путешествие во времени',
            'Тайна старого замка',
            'Краткая история времени',
            'Шерлок Холмс: Возвращение',
            'Звёздные дали',
            'Мир будущего',
            'Наука для всех',
            'Последний детектив',
            'Великие открытия',
            'Город на холме',
        ];

        // Пример генерации 20 книг
        for ($i = 0; $i < 20; $i++) {
            Book::create([
                'title' => $titles[array_rand($titles)] . ' #' . ($i + 1),
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'author_id' => $authorIds[array_rand($authorIds)],
                'year' => rand(1980, 2025),
                'price' => rand(100, 1000) + rand(0, 99) / 100,
                'status' => collect(['новая', 'б/у', 'распродажа'])->random(),
                'is_available' => (bool)rand(0, 1),
            ]);
        }
    }
}
