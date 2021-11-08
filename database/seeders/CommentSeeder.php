<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');
        $posts = Post::all();

        $posts->each(function($post) use ($faker) {
           Comment::create([
               'comment' => $faker->text(50),
               'post_id' => $post->id,
           ]);
        });
    }
}
