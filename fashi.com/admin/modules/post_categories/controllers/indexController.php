<?php
function construct()
{
    load_model("index");
}

function indexAction()
{
    $post_categories = get_post_categories();
    $data = array(
        "post_categories" => $post_categories,
    );
    load_view("index", $data);
}

function addPostCategoryAction()
{
    if (isset($_POST['btn-submit'])) {
        $post_category_name = $_POST['post_category_name'];
        $post_category_slug = $_POST['post_category_slug'];

        $data = array(
            "post_category_name" => $post_category_name,
            "post_category_slug" => $post_category_slug,
            "created_at" => date("y-m-d h-i-s", time()),
        );

        $check = add_post_categories($data);
        if ($check) {
            // redirect("?mod=post_categories&action=index");
            $post_category = get_post_category_by_id($check);
            echo json_encode($post_category);
        }
    }
}

function editPostCategoryAction(){
    $id = !empty($_GET['id']) ? $_GET['id'] : "";
    if(!empty($id)){
        $current_category = get_post_category_by_id($id);
        $post_categories = get_post_categories();
        $data = array(
            "current_category" => $current_category,
            "post_categories" => $post_categories,
        );
        load_view("editPostCategory", $data);
    } 
}

function updatePostCategoryAction(){
    if(!empty($_POST['btn-submit'])){
        $post_category_id = $_POST['post_category_id'];
        $post_category_name = $_POST['post_category_name'];
        $post_category_slug = $_POST['post_category_slug'];

        $data = array(
            "post_category_id" => $post_category_id,
            "post_category_name" => $post_category_name,
            "post_category_slug" => $post_category_slug,
            "updated_at" => date("y-m-d h-i-s", time()),
        );

        $check = update_post_categories($post_category_id, $data);

        if($check != 0){
            $current_post_category = get_post_category_by_id($post_category_id);
            echo json_encode($current_post_category);
        }
    }
}

function deletePostCategoryAction()
{
    if (isset($_POST['btn_submit'])) {
        $post_category_id = $_POST['post_category_id'];

        $check = delete_post_category($post_category_id);
        
        if ($check != 0) {
            echo json_encode("success");
        }else{
            echo json_encode("fail");
        }
    }
}
