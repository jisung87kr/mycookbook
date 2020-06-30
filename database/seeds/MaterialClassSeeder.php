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
        $faker = Faker\Factory::create();
        $materials = factory(App\Material::class, 50)->create()->each(function($material){
            $material->materialUnits()->save(factory(App\MaterialUnit::class)->make());
        });
        $unitIds = App\MaterialUnit::all()->pluck("id")->toArray();

        $posts = App\Post::all()->each(function($post) use ($faker, $unitIds){
            factory(App\MaterialClass::class, 3)->create(['post_id' => $post->id])->each(function($materialClass) use ($faker, $unitIds){
                $materialClass->materialUnits()->sync($faker->randomElements($unitIds, rand(1, 5)));
            });

            for($i=1; $i<rand(3, 6); $i++){
                factory(App\Recipe::class)->create([
                    'post_id' => $post->id,
                    'step' => $i
                ]);
            }
        });
        // foreach($posts as $key => $value){
        //     factory(App\MaterialClass::class, 3)->create(['post_id' => $value['id']])->each(function ($materialClass) {
        //         $materialClass->materials()->createMany(
        //             factory(App\Material::class, 3)->make()->toArray()
        //         );
        //     });


        //     for($i=1; $i<rand(3, 6); $i++){
        //         factory(App\Recipe::class)->create([
        //             'post_id' => $value['id'],
        //             'step' => $i
        //         ]);
        //     }
        // }
    }
}
