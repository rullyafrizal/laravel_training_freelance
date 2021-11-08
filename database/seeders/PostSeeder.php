<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');
        $users = User::all();

        $users->each(function($user) use ($faker) {
            Post::create([
                'title' => $faker->sentence,
                'content' => $faker->text(),
                'user_id' => $user->id,
            ]);
        });

    }
}
