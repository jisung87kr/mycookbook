<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 30)->create()->each(function ($user) {
            $user->posts()->createMany(
                factory(App\Post::class, 5)->make()->toArray()
            );
        });

        $faker = Faker\Factory::create();
        $users = App\User::all();
        $posts = App\Post::all();

        $posts->each(function($post) use ($faker, $users){
            $post->comments()->createMany(
                factory(App\Comment::class, 5)->make([
                    'user_id' => $faker->randomElement($users->pluck('id')),
                ])->toArray()
            );
        });

        $comments = App\Comment::all();
        $comments->each(function($comment) use ($faker, $comments, $users) {
            for ($i=0; $i < 5; $i++) { 
                $comment->comments()->create([
                    'user_id' => $faker->randomElement($users->pluck('id')),
                    'parent' => $faker->randomElement($comments->where('commentable_id', $comment->commentable_id)->pluck('id')),
                    'comment' => $faker->paragraph($nbSentences = 10, $variableNbSentences = true),
                    'created_at' => now(),
                    'updated_at' => now(),
                    'commentable_type' => $comment->commentable_type,
                    'commentable_id' => $comment->commentable_id
                ]);
            }
        });

        // $users->each(function($user) use ($faker, $posts){
        //     factory(App\Comment::class, 5)->create([
        //         'user_id' => $user->id,
        //         'parent' => 0,
        //         'commentable_id' => $faker->randomElement($posts->pluck('id')),
        //         'commentable_type' => 'App\post'
        //     ]);
        // });
    } 
}