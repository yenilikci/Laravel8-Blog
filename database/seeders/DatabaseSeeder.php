<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Article;
use App\Models\Contact;
use Illuminate\Database\Seeder;
use Pages;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call(CategorySeeder::class);
       $this->call(ArticleSeeder::class);
       $this->call(PageSeeder::class);
       $this->call(ContactSeeder::class);
       $this->call(AdminSeeder::class);
    }
}
