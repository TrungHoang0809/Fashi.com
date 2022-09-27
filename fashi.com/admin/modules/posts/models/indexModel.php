<?php 
    function get_all_posts(){
        $posts = db_fetch_array("SELECT * FROM posts");
        return $posts;
    }

    function get_post_by_id($post_id){
        
        $post = db_fetch_row("SELECT * FROM posts WHERE post_id = {$post_id}");
        return $post;
    }

    function get_post_by_category($category_id){

    }

    function add_post($data){
        return db_insert("posts", $data);
    }

    function get_post_categories(){
        $post_categories = db_fetch_array("SELECT * FROM post_categories");
        return $post_categories;
    }

    function get_post_category_by_id($id){
        $post_category = db_fetch_row("SELECT * FROM post_categories WHERE post_category_id = {$id} ");
        return $post_category;
    }
?>