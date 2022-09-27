<?php
function get_products()
{
    $products = db_fetch_array("SELECT * FROM products");
    return $products;
}

function add_product($data)
{
    return db_insert('products', $data);
}

function get_products_join_category()
{
    $products = db_fetch_array("SELECT * FROM products 
                                LEFT JOIN categories ON products.category_id = categories.category_id");
    return $products;
}

function get_product_by_product_id($id){
    $product = db_fetch_row("SELECT * FROM products WHERE product_id = $id");
    return $product;
}
