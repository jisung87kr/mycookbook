<?php

namespace App\Http\Controllers;

use App\Post;
use App\Material;
use App\PostMeta;
use App\Recipe;
use App\Term;
use App\Taxonomy;
use App\Attachment;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(Request $request)
    {
        if($request->input('selected_material')){
            $selectedMaterial = $request->input('selected_material');
            $posts = Post::with('materialClasses.materialUnits.material', 'taxonomies')->whereHas('materialClasses.materialUnits.material', function($q) use ($selectedMaterial){
                 $q->whereIn('name', $selectedMaterial); 
            })->latest()->paginate(12);
        } else {
            $posts = Post::with('materialClasses.materialUnits.material', 'taxonomies')->latest()->paginate(12);
            $selectedMaterial = null;
        }

        if($request->input('taxonomy')){
            $taxonomy = $request->input('taxonomy');
            $posts = Post::with('materialClasses.materialUnits.material', 'taxonomies')->whereHas('taxonomies.term', function($q) use ($taxonomy){
                 $q->where('slug', $taxonomy);
            })->latest()->paginate(12);
        }
        
        $materials = Material::select(DB::raw('name, count(*) as cnt'))->groupBy('name')->orderBy('cnt', 'desc')->get();
        return view('posts.index', compact('posts', 'materials', 'selectedMaterial'))->with('selected_material', $selectedMaterial);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post;
        $category = Taxonomy::with('term')->where('taxonomy', 'category')->get();
        return view('posts.create', compact('post', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\FormRequestPost $request)
    {
        // ddd($request->all(), is_array($request->recipe[0]['file']));
        // ddd($request->all());
        $validated = $request->validated();
        $post = $request->user()->posts()->create($validated);
        $this->storeFile($post, $request->thumbnail);
        $this->storeMeta($post, $request);
        $this->storeTaxonomies($post, $request);
        $this->storeMaterial($post, $request);
        $this->storeRecipe($post, $request);
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, Request $request)
    {
        $recentPosts = $request->session()->get('recent_posts');
        if(!empty($recentPosts)) {
            if(false !== $key = array_search($post->id, $recentPosts)){
                $request->session()->pull('recent_posts.'.$key, $post->id);
            }
            $request->session()->push('recent_posts', $post->id);
        } else {
            $request->session()->put('recent_posts', [ $post->id ]);
        }

        $recentArr = $request->session()->get('recent_posts');
        $data = [];
        for($i=0; $i<10; $i++){
            $val = array_pop($recentArr);
            if(!empty($val)){
                array_push($data, $val);
            }
        }
        
        $recentList = [];
        foreach($data as $value){
            $row = Post::find($value);
            array_push($recentList, $row);
        }
        
        $posts = Post::with('materialClasses.materialUnits.material')->simplePaginate(10);
        $selectedItems = $request->input('selected_material');
        $materialList = null;

        if($selectedItems){
            $materialList = \App\MaterialClass::where('post_id', $post->id)
            ->leftJoin('material_relationships', 'material_classes.id', '=', 'material_class_id')
            ->leftJoin('material_units', 'material_units.id', '=', 'material_unit_id')
            ->leftjoin('materials', 'material_units.material_id', '=', 'materials.id')
            ->whereNotIn('name', $selectedItems)
            ->get();
        } else {
            $materialList = null;
        }

        $comments = $post->comments()->with('comments')->where('parent', null)->latest()->get();
        return view('posts.show', compact('posts', 'post', 'recentList', 'materialList', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $category = Taxonomy::with('term')->where('taxonomy', 'category')->get();
        return view('posts.edit', compact('post', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\FormRequestPost $request, Post $post)
    {
        // ddd($request->recipe);
        $validated = $request->validated();
        $post->update($validated);
        $this->updateMeta($request);
        $this->storeTaxonomies($post, $request);
        $this->storeMaterial($post, $request);
        $this->storeRecipe($post, $request);
        return redirect()->route('posts.show', $post->id);
    }

    public function updateMeta($request){
        PostMeta::find($request->meta['id'])->update([
            'value' => $request->meta['__video']
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // taxonomy delete
        $post->taxonomies()->delete();
        // material delete
        foreach($post->materialClasses as $key => $materialClass){
            $materialClass->materialUnits()->delete();
        }
        $post->materialClasses()->delete();
        // recipe delete
        foreach($post->recipes as $key => $recipe){
            $this->deleteRecipe($recipe);
        }
        // post delete
        $post->delete();
        return redirect()->route('posts.index');
    }

    public function coupang($word){
        return $word;
        date_default_timezone_set("GMT+0");
        $datetime = date("ymd").'T'.date("His").'Z';
        $method = "POST";
        $path = "/v2/providers/affiliate_open_api/apis/openapi/v1/deeplink";
        $message = $datetime.$method.str_replace("?", "", $path);
        $ACCESS_KEY = "";
        $SECRET_KEY = "";
        $algorithm = "HmacSHA256";
        $signature = hash_hmac('sha256', $message, $SECRET_KEY);
        // print($message."\n".$SECRET_KEY."\n".$signature."\n");
        $authorization  = "CEA algorithm=HmacSHA256, access-key=".$ACCESS_KEY.", signed-date=".$datetime.", signature=".$signature;
        $url = 'https://api-gateway.coupang.com'.$path;
        $strjson='
            {
                "coupangUrls": [
                    "https://www.coupang.com/np/search?component=&q='.$word.'&channel=user",
                ]
            }
        ';

        $curl = curl_init();        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:  application/json;charset=UTF-8", "Authorization:".$authorization));        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $strjson);
        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);
        $data = json_decode($result);
        return $data->data[0]->shortenUrl;
    }

    public function storeMeta($post, $request){
        if(isset($request->meta)){
            foreach($request->meta as $key => $val){
                $post->postMetas()->create([
                    'key' => $key,
                    'value' => $val
                ]);
            }
        } else {
            ddd('meta가 존재하지 않습니다');
        }
    }

    public function getPostMeta($post, $key){
        $meta = PostMeta::where([
            'post_id' => $post->id,
            'key' => $key
        ])->first();
        return $meta;
    }

    public function storeTaxonomies($post, $request){
        $termIds = [];
        if(isset($request->taxonomy['tag'])){
            $tagArr = explode(',', $request->taxonomy['tag']);
            foreach($tagArr as $key => $val){
                $data = [
                    'taxonomy' => 'tag',
                    'description' => null,
                    'parent' => 0,
                    'count' => 0
                ];
                $term = Term::where('name', $val)->first();
                if(!$term){
                    $term = Term::create([
                        'name' => $val,
                        'slug' => $val
                    ]);
                }
                $data['id'] = $term->id;
                array_push($termIds, $data['id']);
                $this->storeTaxonomy($post, $data);
            }
        }
        // ddd($termIds);
        if(isset($request->taxonomy['category'])){
            $taxonomyIds = array_merge($termIds, $request->taxonomy['category']);
        } else {
            $taxonomyIds = $termIds;
        }
        $result = $post->taxonomies()->sync($taxonomyIds);
        Taxonomy::whereIn('id', $result['attached'])->increment('count');
        Taxonomy::whereIn('id', $result['detached'])->decrement('count');
        // ddd($result);
        
    }

    public function storeTaxonomy($post, $term){
        if(!Taxonomy::find($term['id'])){
            // Taxonomy::find($term['id'])->increment('count');
            Taxonomy::create([
                'term_id' => $term['id'],
                'taxonomy' => $term['taxonomy'],
                'description' => $term['description'],
                'parent' => $term['parent'],
                'count' => 0
            ]);
        }
    }

    public function storeMaterial($post, $request){
        if(isset($request->material)){
            if(!$post->materialClasses->isEmpty()){
                foreach($post->materialClasses as $key => $materialClass){
                    $materialClass->materialUnits()->delete();
                }
                $post->materialClasses()->delete();
            }
            
            foreach($request->material as $key => $val){
                $materialClass = $post->materialClasses()->create([
                   'title' => $val['title']
                ]);
                
                $unitIds = [];
                foreach($val['item'] as $k => $v){
                    $findMaterial = Material::where('name', $v['name'])->first();
                    if(!$findMaterial){
                        $material = Material::create([
                            'name' => $v['name'],
                            'slug' => $v['name'],
                            'link' => 'link~~'
                        ]);
                    } else {
                        $material = $findMaterial;
                    }

                    $unit = $material->materialUnits()->create([
                        'unit' => $v['unit']
                    ]);

                    $unitIds[] = $unit->id;
                }

                $materialClass->materialUnits()->sync($unitIds);
            }
        } else {
            ddd('material class가 존재하지 않습니다.');
        }
    }

    public function storeRecipe($post, $request){
        // ddd(Arr::pluck($request->recipe, 'id'));
        if(isset($request->recipe)){
            $i=1;
            $ids = [];
            foreach($request->recipe as $key => $val){
                if(isset($val['id'])){
                    $recipeId = $val['id'];
                    Recipe::find($val['id'])->update([
                        'step' => $i,
                        'content' => $val['content']
                    ]);
                    // 파일삭제 리스트가 있으면 삭제
                    if(isset($val['file_delete'])){
                        foreach($val['file_delete'] as $j => $v){
                            $del_file = Attachment::find($v);
                            $this->deleteFile($del_file);
                        }
                    }
                } else {
                    $recipe = $post->recipes()->create([
                        'step' => $i,
                        'content' => $val['content']
                    ]);
                    $recipeId = $recipe->id;
                }
                if(isset($val['file'])){
                    $this->storeFile(Recipe::find($recipeId), $val['file']);
                }

                array_push($ids, $recipeId);
                $i++;
            }

            // 레시피 동기화, 새로등록되거나 수정된 아이디를 제외한 레시피 삭제
            // ddd($post->recipes->whereNotIn('id', $ids));
            $delete_recipes = $post->recipes->whereNotIn('id', $ids);
            foreach($delete_recipes as $k => $delete_recipe){
                $this->deleteRecipe($delete_recipe);
            }
        }
    }

    public function deleteRecipe(Recipe $recipe){
        $recipe->delete();
        foreach($recipe->attachments as $key => $file){
            $this->deleteFile($file);
        }
    }

    public function storeFile($model, $file){
        if(is_null($file)){
            return false;
        }
        if(is_array($file)){
            foreach($file as $key => $val){
                $this->saveFile($model, $val);    
            }
        } else {
            $this->saveFile($model, $file);
        }
    }

    public function saveFile($model, $file){
        $stored = $file->store('images', 'public');
        $model->attachments()->create([
            'fname' => $file->getClientOriginalName(),
            'path' => $stored,
            'mime' => $file->getClientMimeType(),
            'byte' => $file->getSize()
        ]);
    }

    public function deleteFile(Attachment $file){
        Storage::disk('public')->delete($file->path);
        $file->delete();
    }
}
