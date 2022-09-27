<?php
function get_all_post_categories(){
    $post_categories = db_fetch_array("SELECT * FROM post_categories");
    return $post_categories;
}

// function get_post_category_by($id){
//     $post_category = db_fetch_row("SELECT * FROM post_categories WHERE post_category_id = {$id} ");
//     return $post_category;
// }
