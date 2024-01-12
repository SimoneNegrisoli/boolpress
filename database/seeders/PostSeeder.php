<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = config('db.posts');
        foreach ($posts as $post) {
            $newPost = new Post();

            $newPost->user_id = 1;
            $newPost->title = $post['title'];
            $newPost->slug = Str::slug($post['title'], '-');
            $newPost->image = $post['image'];
            $newPost->body = $post['body'];
            $newPost->save();
        }
    }
}
