<?php 
    function construct(){
        load_model("index");
        load_model("postCategories");
    }

    function indexAction(){
        $posts = get_all_posts();
        $data = array(
            "posts" => $posts,
        );
        load_view("index", $data);
    }

    function addPostAction(){
        if(isset($_POST['btn-submit'])){
            $title = $_POST['post_title'];
            $post_content = $_POST['product_desc'];
            $status = $_POST['status'];
            
            $post_categories_ids = $_POST['post_category'];
            $post_categories_ids_string = implode("|", $post_categories_ids);

            if(isset($_FILES['post-img-cover'])){
                $upload_dir = 'public/uploads/images/post/';
                $image_name = time() . '_' . basename($_FILES['post-img-cover']['name']);
                $upload_file = $upload_dir . $image_name;

                if (move_uploaded_file($_FILES['post-img-cover']['tmp_name'], $upload_file)) {
                    $post_img_name = $image_name;
                } else {
                    $post_img_name = "";
                }
            }

            $data = array(
                "post_category_id" => $post_categories_ids_string,
                "post_title" => $title,
                "post_content" => $post_content,
                "post_img_cover" => $post_img_name,
                "post_status" => $status,
                "created_at" => date("y-m-d h-m-i", time()),
            );

            $check = add_post($data);
            if($check){
                redirect("?mod=posts&action=index");
            }
        }
        $post_categories = get_all_post_categories();
        $data = array(
            "post_categories" => $post_categories,
        );
        load_view("addPost", $data);
    }

    function editPostAction(){
        global $conn;
        
        if(empty($_GET['id'])){
            load_view("404");
        }
        else{
            $post_id = mysqli_real_escape_string($conn, $_GET['id']);
            $post = get_post_by_id($post_id);

            if(is_array($post)){
                $data = array(
                    "post" => $post,
                );
                
                load_view("editPost", $data);
            }else{
                load_view("404");
                
           }
        }
    }

    function updatePostAction(){

    }

    function deletePostAction(){
       
    }
