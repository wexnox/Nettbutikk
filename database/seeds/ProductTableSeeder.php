<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new \App\Product([
            'imagePath' => 'https://www.komplett.no/img/p/800/c3e07913-3f53-4ef7-3879-1bba994c2209.jpg',
            'title' => 'Skjermkort 1',
            'description' => 'Masse tekst',
            'pris' => 10000

        ]);
        $product->save();

        $product = new \App\Product([
            'imagePath' => 'https://www.komplett.no/img/p/800/c3e07913-3f53-4ef7-3879-1bba994c2209.jpg',
            'title' => 'Skjermkort 2',
            'description' => 'Masse tekst',
            'pris' => 10000

        ]);
        $product->save();

        $product = new \App\Product([
            'imagePath' => 'https://www.komplett.no/img/p/800/c3e07913-3f53-4ef7-3879-1bba994c2209.jpg',
            'title' => 'Skjermkort 3',
            'description' => 'Masse tekst',
            'pris' => 10000

        ]);
        $product->save();

        $product = new \App\Product([
            'imagePath' => 'https://www.komplett.no/img/p/800/c3e07913-3f53-4ef7-3879-1bba994c2209.jpg',
            'title' => 'Skjermkort 4',
            'description' => 'Masse tekst',
            'pris' => 10000

        ]);
        $product->save();

        $product = new \App\Product([
            'imagePath' => 'https://www.komplett.no/img/p/800/c3e07913-3f53-4ef7-3879-1bba994c2209.jpg',
            'title' => 'Skjermkort 5',
            'description' => 'Masse tekst',
            'pris' => 10000

        ]);
        $product->save();

        $product = new \App\Product([
            'imagePath' => 'https://www.komplett.no/img/p/800/c3e07913-3f53-4ef7-3879-1bba994c2209.jpg',
            'title' => 'Skjermkort 6',
            'description' => 'Masse tekst',
            'pris' => 10000

        ]);
        $product->save();
    }
}
