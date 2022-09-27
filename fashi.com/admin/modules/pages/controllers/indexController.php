<?php 
    function construct(){
        load_model("index");
    }

    function indexAction(){
        $pages = get_pages();
        $data = array("pages" => $pages);
        load_view("index", $data);
    }

    function addAction(){
        if(isset($_POST['btn-submit'])){
            $page_title = $_POST['page_title'];
            $page_content = $_POST['page_content'];
            $status = $_POST['status'];

            $data = array(
                "page_title" => $page_title,
                "page_content" => $page_content,
                "page_status" => $status,
                "created_at" => date("Y-m-d h-i-s", time()),    
            );

            $check = add_page($data);
            
            if($check){
                redirect("?mod=pages&action=index");
            }
        }
        load_view("add");
    }

    function editAction(){
        $page_id = !empty($_GET['id']) ? $_GET['id'] : "";
        if(!empty($page_id)){
            $edit_page = get_page_by_id($page_id);
            $data = array(
                'page_id' => $page_id,
                'edit_page' => $edit_page,
            );

            load_view("edit", $data);
        }
    }

    function updateAction(){
        if(isset($_POST['btn-submit'])){
            $page_title = $_POST['page_title'];
            $page_content = $_POST['page_content'];
            $page_status = $_POST['status'];
            $page_id = $_POST['page_id'];
            
            $data = array(
                "page_title" => $page_title,
                "page_content" => $page_content,
                "page_status" => $page_status,
                "updated_at" => date("Y-m-d h-i-s", time()),    
            );

            $check = update_page($page_id, $data);

            if($check != 0){
                redirect("?mod=pages&action=index");
            }
        }
    }

    function deleteAction(){
        if(isset($_POST['btn_submit'])){
            $page_id = $_POST["page_id"];
            $check = delete_page($page_id);
            if($check != 0){
                echo "success";
            }
        }
    }
?>