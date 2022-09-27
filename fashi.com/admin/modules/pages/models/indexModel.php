<?php  
    function get_pages(){
        return $pages = db_fetch_array("SELECT * FROM pages");
    }

    function add_page($data){
        return db_insert("pages", $data);
    }

    function get_page_by_id($id){
        $page = db_fetch_row("SELECT * FROM pages WHERE id = {$id} ");
        return $page;
    }

    function update_page($id, $data){
        return db_update("pages", $data, "id = {$id}");
    }

    function delete_page($id){
       return  db_delete("pages", "id = {$id}");
    }
?>