<?php

use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 100)->create()->each(function ($user) {
            factory(Post::class, 100)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
