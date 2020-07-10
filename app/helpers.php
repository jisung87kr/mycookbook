<?php
if (!function_exists('postHasTag')){
    function postHasTaxonomy($post, $taxonomy){
        $result = $post->taxonomies->where ('taxonomy', $taxonomy);
        return count($result) == 0 ? false : true;
    }
}

if(!function_exists('getPostMeta')){
    function getPostMeta($post, $key){
        if(!$post){
            return false;
        }

        return $post->postMetas()->where('key', $key)->latest()->first();
    }
}

if(!function_exists('getPostMetas')){
    function getPostMetas($post, $key){
        if(!$post){
            return false;
        }

        return $post->postMetas()->where('key', $key)->latest();
    }
}

if(!function_exists('getPostTag')){
    function getPostTag($post){
        $taxonomy = $post->taxonomies()->with('term')->where('taxonomy', 'tag')->get();
        $tagName = [];
        foreach($taxonomy as $key => $val){
            array_push($tagName, $val->term->name);
        }
        return implode(',', $tagName);
    }
}
?>