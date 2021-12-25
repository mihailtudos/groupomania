<?php

namespace Database\Seeders;

use App\Models\Comment;
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
         for($i = 0; $i < 10; $i++) {
             $user = User::factory()->create();
             $post = Post::factory([
                 'user_id' => $user->id
             ])->create();
             Comment::factory([
                 'user_id' => $user->id,
                 'post_id' => $post->id
             ])->create();
         }
    }
}
