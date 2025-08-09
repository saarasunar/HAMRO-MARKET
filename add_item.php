<?php
session_start();
include('conn_db.php');

// Check if user is logged in
if (!isset($_SESSION["cid"])) {
    header("location: cust_login.php");
    exit(1);
}

// Get POST data
$f_id = isset($_POST['f_id']) ? $_POST['f_id'] : null;
$s_id = isset($_POST['s_id']) ? $_POST['s_id'] : null;
$c_id = $_SESSION['cid'];
$amount = $_POST['amount'];
$request = $mysqli->real_escape_string($_POST['request']); // Escaping the request string for safety

// Check if f_id is provided
if (is_null($f_id)) {
    die("Error: f_id is missing.");
}

// Query to get available stock (f_qty) from the database
$query = "SELECT f_qty FROM category WHERE f_id = {$f_id}";
$result = $mysqli->query($query);

// Check if the query was successful
if ($result && $result->num_rows > 0) {
    $category = $result->fetch_array();
    $available_qty = $category['f_qty'];
    
    // Check if the selected quantity is less than or equal to available quantity
    if ($amount > $available_qty) {
        die("Error: Insufficient stock. Only {$available_qty} items are available.");
    }

    // Check if the item is already in the cart
    $cartsearch = "SELECT ct_amount FROM cart WHERE c_id = {$c_id} AND f_id = {$f_id} AND s_id = {$s_id}";
    $cartsearch_result = $mysqli->query($cartsearch);

    if ($cartsearch_result->num_rows == 0) {
        // Item is not in the cart, insert it
        $insert_query = "INSERT INTO cart (c_id, s_id, f_id, ct_amount, ct_note) 
                         VALUES ({$c_id}, {$s_id}, {$f_id}, {$amount}, '{$request}')";
        $atc_result = $mysqli->query($insert_query);
    } else {
        // Item already exists, update the quantity
        $cartsearch_arr = $cartsearch_result->fetch_array();
        $incart_amount = $cartsearch_arr['ct_amount'];
        $new_amount = $incart_amount + $amount;
        $update_query = "UPDATE cart SET ct_amount = {$new_amount} 
                         WHERE c_id = {$c_id} AND f_id = {$f_id} AND s_id = {$s_id}";
        $atc_result = $mysqli->query($update_query);
    }

    if ($atc_result) {
        // Redirect to cart with success message
        header("location: shop_menu.php?s_id={$s_id}&atc=1");
        exit(1);
    } else {
        // Redirect with error message
        header("location: shop_menu.php?s_id={$s_id}&atc=0");
        exit(1);
    }
} else {
    die("Error: Unable to fetch stock information.");
}
?>
