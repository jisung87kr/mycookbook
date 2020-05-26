<?php

use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for($i=0; $i<40; $i++){
            $taxonomy = $faker->randomElement(['category', 'tag']);
            $name = $faker->word;
            $sameTax = App\Taxonomy::where('taxonomy', $taxonomy)->get();
            $exist = null;
            foreach($sameTax as $item){
                if($item->term->name === $name){
                    $exist = true;
                    break;
                }
            }

            if(!$exist){
                $term = factory(App\Term::class)->create(['name' => $name]);
                $term->taxonomy()->save(
                    factory(App\Taxonomy::class)->make([
                        'term_id' => $term->id,
                        'taxonomy' => $taxonomy
                        ])
                );
            }
        }

        $taxonomies = App\Taxonomy::all();
        $taxIds = $taxonomies->pluck('id')->toArray();
        foreach ($taxonomies as $key => $item) {
            if($key > 7 && $item->taxonomy == 'category'){
                $item->update(['parent' => $faker->randomElement($taxIds)]);
            }
        }

        $posts = App\Post::all()->each(function($post) use ($taxonomies, $faker){
            $arr = $faker->randomElements($taxonomies->pluck('id')->toArray(), rand(1, 5));
            foreach($arr as $val){
                App\Taxonomy::find($val)->increment('count');
            }
            $post->taxonomies()->sync($arr);
        });

    }
}
