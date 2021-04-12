<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = ['Hakkımızda','Kariyer','Vizyonumuz','Misyonumuz'];
        $count = 0;
        foreach ($pages as $page) {
            $count++;   
            DB::table('pages')->insert([
                'title' => $page,
                'slug' => Str::slug($page),
                'content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                Nostrum assumenda eos, ut totam non odio officia ducimus molestias quis voluptatibus fuga,
                itaque minima veniam laborum voluptatum magni perferendis inventore in.',
                'image' => 'https://egeosgb.com.tr/wp-content/uploads/2016/11/orionthemes-placeholder-image-1.png',
                'order' => $count,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }    }
}
