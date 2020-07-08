<?php

use App\Tag;
use App\User;
use Illuminate\Database\Seeder;

class UserTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::all();

        User::all()->each(function ($user) use ($tags) {
            $user->tags()->attach($tags->random()->id);
        });
    }
}
