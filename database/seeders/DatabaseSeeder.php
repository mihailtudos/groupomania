<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Department;
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
        $departments = ['HR', 'Accounting', 'Security', 'IT', 'Outbound', 'Inbound', 'Public'];
        foreach ($departments as $department) {
            Department::create([
                'name' => $department
            ]);
        };

         $admin = User::factory(['email' => 'admin@admin.com', 'department_id' => 1])->create();

         for($i = 0; $i < 10; $i++) {
             $user = User::factory()->create();
             $post = Post::factory([
                 'user_id' => $user->id,
                 'channel_id' => $user->department->id
             ])->create();
             Comment::factory([
                 'user_id' => $user->id,
                 'post_id' => $post->id
             ])->create();
         }

         $public = Department::where('name', 'public')->first();

         Post::create([
             'excerpt' => '<p>@memebers, the management wants to invite you to the all hands meeting</p>',
             'user_id' => $admin->id,
             'channel_id' => $public->id,
             'likes' => json_encode([]),
             'dislikes' => json_encode([]),
         ]);

        Post::create([
            'excerpt' => '<p>Happy New Year</p>',
            'body' => '<p>Happy New Year</p>',
            'image' => '/images/announcements/new_year.webp',
            'user_id' => $admin->id,
            'channel_id' => $public->id,
            'likes' => json_encode([]),
            'dislikes' => json_encode([]),
        ]);
    }
}
