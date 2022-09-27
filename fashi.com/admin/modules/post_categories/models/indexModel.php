<?php  
    function get_post_categories(){
        $post_categories = db_fetch_array("SELECT * FROM post_categories");
        return $post_categories;
    }

    function get_post_category_by_id($id){
        $post_category = db_fetch_row("SELECT * FROM post_categories WHERE post_category_id = {$id} ");
        return $post_category;
    }

    function add_post_categories($data){
        return db_insert("post_categories", $data);
    }

    function update_post_categories($id, $data){
        return db_update("post_categories", $data, "post_category_id = {$id}");
    }

    function delete_post_category($id){
        return db_delete("post_categories", "post_category_id = {$id}");
    }
?>