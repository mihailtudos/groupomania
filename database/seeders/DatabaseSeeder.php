<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $admin = User::factory(['email' => 'admin@admin.com'])->create();
         User::factory(10)->create();
         Post::factory(10)->create();
    }
}
