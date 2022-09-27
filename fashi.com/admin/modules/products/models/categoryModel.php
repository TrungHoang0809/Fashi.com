<?php
    function get_categories(){
        return db_fetch_array("SELECT * FROM categories");
    }

    function get_category($category_id){
        return db_fetch_row("SELECT * FROM `categories` WHERE category_id = $category_id");
    }

    
?>