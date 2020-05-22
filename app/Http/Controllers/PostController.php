<?php

namespace App\Http\Controllers;

use App\Post;
use App\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->input('selected_material')){
            $selectedMaterial = $request->input('selected_material');
            $posts = Post::with('materialClasses.materials')->whereHas('materialClasses.materials', function($q) use ($selectedMaterial){
                 $q->whereIn('name', $selectedMaterial); 
            })->paginate(12);
        } else {
            $posts = Post::paginate(12);
            $selectedMaterial = null;
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
        return 'create';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        
        $posts = Post::with('materialClasses.materials')->simplePaginate(10);
        $selectedItems = $request->input('selected_material');
        if($selectedItems){
            // $notExistMaterials = $post->with('materialClasses.materials')->find($post->id);
            $arr = Arr::pluck($post->materialClasses, 'id');
            $data = Material::select('name')->whereIn('material_class_id', $arr)->groupBy('name')->get();
            $materialList = Arr::pluck($data, 'name');
            foreach ($selectedItems as $key => $value) {
                $key = array_search($value, $materialList);
                array_splice($materialList, $key, 1);
            }
        } else {
            $materialList = null;
        }
        
        return view('posts.show', compact('posts', 'post', 'recentList', 'materialList'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function coupang($word){
        date_default_timezone_set("GMT+0");
        $datetime = date("ymd").'T'.date("His").'Z';
        $method = "POST";
        $path = "/v2/providers/affiliate_open_api/apis/openapi/v1/deeplink";
        $message = $datetime.$method.str_replace("?", "", $path);
        $ACCESS_KEY = "5f4fdb1c-8f62-4077-a86b-b14a947c99d7";
        $SECRET_KEY = "42fffbad486940fffbd4db89aa6ffb504312d3d1";
        $algorithm = "HmacSHA256";
        $signature = hash_hmac('sha256', $message, $SECRET_KEY);
        // print($message."\n".$SECRET_KEY."\n".$signature."\n");
        $authorization  = "CEA algorithm=HmacSHA256, access-key=".$ACCESS_KEY.", signed-date=".$datetime.", signature=".$signature;
        $url = 'https://api-gateway.coupang.com'.$path;
        $strjson='
            {
                "coupangUrls": [
                    "https://www.coupang.com/np/search?component=&q='.$word.'&channel=user"
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
}
