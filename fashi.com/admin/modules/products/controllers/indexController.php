<?php
function construct()
{
    load_model("index");
    load_model("category");
}

function indexAction()
{
    $products = get_products_join_category();
    $data = array(
        "products" => $products,
    );
    load_view('index', $data);
}

function addProductAction()
{

    if (!empty($_POST)) {
        $product_name = !empty($_POST["product_name"]) ? $_POST["product_name"] : "";
        $product_code = !empty($_POST["product_code"]) ? $_POST["product_code"] : "";
        $price = !empty($_POST["price"]) ? $_POST["price"] : "";
        $category_id = !empty($_POST["category"]) ? $_POST["category"] : "";
        $status = !empty($_POST["status"]) ? $_POST["status"] : "";

        //img
        $upload_dir = 'public/uploads/images/product/';
        $image_name = time() . '_' . basename($_FILES['avatar']['name']);
        $upload_file = $upload_dir . $image_name;

        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $upload_file)) {
            $avatar = $image_name;
        } else {
            $avatar = "";
        }

        $data = array(
            'category_id' => $category_id,
            'product_name' => $product_name,
            'product_code' => $product_code,
            'price' => $price,
            'status' => $status,
            'image' => $avatar,
            'created_at' => date("Y-m-d h:i:s", time()),
        );

        if (add_product($data)) {
            redirect("?mod=products&action=index");
        }
    }


    $categories = get_categories();
    $data = array(
        "categories" => $categories,
    );
    load_view("addProduct", $data);
}

function editProductAction()
{
    $product_id = !empty($_GET['id']) ? $_GET['id'] : '';
    if (!empty($product_id)) {
        $product = get_product_by_product_id($product_id);
        $categories = get_categories();
        $current_category = get_category($product['category_id']);
        $data = array(
            "categories" => $categories,
            "current_category" => $current_category,
            "product" => $product,
        );
    }
    load_view('editProduct', $data);
}

function updateProductAction()
{
    if (!empty($_POST)) {
        $current_product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_code = $_POST['product_code'];
        $price = $_POST['price'];
        $category_id = $_POST['category_id'];
        $status = $_POST['status'];
        $product_desc = $_POST['product_desc'];

        $product_data = array(
            "category_id" => $category_id,
            "product_name" => $product_name,
            "product_code" => $product_code,
            "price" => $price,
            "product_desc" => $product_desc,
            "status" => $status,
            "updated_at" => date("Y-m-d h:i:s", time()),
        );

        $where = "product_id = '{$current_product_id}' ";

        if (empty($_FILES['product-img']['name'])) {
            $check = db_update("products", $product_data, $where);
            if ($check) {
                redirect("?mod=products&action=index");
            }
        } else {
            $upload_dir = 'public/uploads/images/product/';
            $image_name = time() . '_' . basename($_FILES['product-img']['name']);
            $upload_file = $upload_dir . $image_name;

            if (move_uploaded_file($_FILES['product-img']['tmp_name'], $upload_file)) {
                $product_img_name = $image_name;
            } else {
                $product_img_name = "";
            }

            $product_data['image'] = $product_img_name;
            $check = db_update("products", $product_data, $where);
            if ($check) {
                redirect("?mod=products&action=index");
            }
        }

    }
}

function deleteProductAction()
{
    $product_id = !empty($_POST['product_id']) ? $_POST['product_id'] : "";
    if($product_id){
        $check = db_delete("products", "product_id = '${product_id}' ");
        if($check){
            echo "success!";
            // redirect("?mod=products&action=index");
        }
    }
}
