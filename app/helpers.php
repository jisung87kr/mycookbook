<?php
if (!function_exists('postHasTag')){
    function postHasTaxonomy($post, $taxonomy){
        $result = $post->taxonomies->where ('taxonomy', $taxonomy);
        return count($result) == 0 ? false : true;
    }
}
?>