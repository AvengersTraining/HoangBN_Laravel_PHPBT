<?php

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        Post::chunk(1000, function ($posts) use ($users) {
            foreach ($posts as $post) {
                factory(Comment::class, 2)->create([
                    'user_id' => $users->random()->id,
                    'post_id' => $post->id,
                ])->each(function ($parentComment) use ($users, $post) {
                    factory(Comment::class, 1)->create([
                        'user_id' => $users->random()->id,
                        'post_id' => $post->id,
                        'parent_comment_id' => $parentComment->id,
                    ]);
                });
            }
        });
    }
}
