<?php 
    function get_categories(){
        $categories = db_fetch_array("SELECT * FROM categories");
        return $categories;
    }

    function insert_category($data){
        return db_insert("categories", $data);
    }

    function get_category($id){
        if(!empty($id)){
            $category = db_fetch_row("SELECT * FROM categories WHERE category_id = '{$id}'");
            return $category;
        }
    }

    function update_category($data, $id){
        return db_update("categories", $data, "category_id = {$id}");
    }

    function delete_category($id){
        return db_delete("categories", "category_id = {$id}");
    }
?>