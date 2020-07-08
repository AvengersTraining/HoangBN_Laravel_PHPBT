<?php

use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::all();

        Post::chunk(1000, function ($posts) use ($tags) {
            foreach ($posts as $post) {
                $post->tags()->attach($tags->random()->id);
            }
        });
    }
}
