<?php

use Illuminate\Database\Seeder;

class MaterialClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = App\Post::all();
        foreach($posts as $key => $value){
            factory(App\MaterialClass::class, 3)->create(['post_id' => $value['id']])->each(function ($materialClass) {
                $materialClass->materials()->createMany(
                    factory(App\Material::class, 3)->make()->toArray()
                );
            });
        }
    }
}
