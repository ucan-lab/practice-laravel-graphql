<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Post;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        factory(User::class, 50)->create()->each(function ($user) {
            factory(Post::class, 10)->create(['user_id' => $user->id]);
        });
    }
}
