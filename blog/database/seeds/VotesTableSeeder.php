<?php

use App\Post;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userIds = User::all('id')->pluck('id');
        Post::chunk(1000, function ($posts) use ($userIds) {
            $insertData = [];
            foreach ($posts as $post) {
                foreach ($userIds->random(2) as $userId) {
                    $insertData[] = [
                        'post_id' => $post->id,
                        'user_id' => $userId,
                        'type' => rand(0, 1),
                        'created_at' => $now = now(),
                        'updated_at' => $now,
                    ];
                }
            }

            DB::table('votes')->insert($insertData);
        });
    }
}
