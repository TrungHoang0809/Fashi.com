<?php
function construct()
{
    load_model("index");
}

function indexAction()
{
    $categories = get_categories();
    $data = array(
        'categories' => $categories,
    );
    load_view('index', $data);
}

function addAction()
{
    $category_name = $_POST['category_name'];
    $category_slug = $_POST['category_slug'];

    $data = array(
        "category_name" => $category_name,
        "category_slug" => $category_slug,
        "created_at" => date("Y-m-d h:i:s", time()),
    );

    $check = insert_category($data);
    if ($check != 0) {
        $category = get_category($check);
        echo json_encode($category);
    }
    else{
        echo json_encode("Vui long nhap noi dung");
    }
}

function editAction()
{
    $id = !empty($_GET['id']) ? $_GET['id'] : "";
    if ($id) {
        $categories = get_categories();
        $edit_category =  get_category($id);
        $data = array(
            'categories' => $categories,
            'edit_category' => $edit_category,
        );
        load_view("edit", $data);
    }
}

function updateAction(){
    if (isset($_POST['btn-submit'])) {
        $category_name = $_POST['category_name'];
        $category_slug = $_POST['category_slug'];
        $category_id = $_POST['category_id'];

        $data = array(
            "category_name" => $category_name,
            "category_slug" => $category_slug,
            "updated_at" => date("Y-m-d h:i:s", time()),
        );
        $check = update_category($data, $category_id);

        if ($check == 1) {
            $category = get_category($category_id);
            echo json_encode($category);
        }else{
            echo json_encode("vui long nhap du lieu!");
        }
    }
}

function deleteAction(){
    if(isset($_POST['btn_submit'])){
        $category_id = $_POST['category_id'];
        $check = delete_category($category_id);
        if($check != 0){
            echo "success";
        }
    }
}
