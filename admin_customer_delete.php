<?php
session_start();
if ($_SESSION["utype"] != "ADMIN") {
    header("location: ../restricted.php");
    exit(1);
}
include ('../conn_db.php');

// Get the customer ID from the request
$c_id = $_GET["c_id"];

// Check if the account to be deleted is an admin account
$check_query = "SELECT c_type FROM customer WHERE c_id = '{$c_id}';";
$check_result = $mysqli->query($check_query);

if ($check_result && $check_result->num_rows > 0) {
    $row = $check_result->fetch_assoc();
    if ($row['c_type'] == 'ADM') {
        // Admin account detected, redirect with error message
        header("location: admin_customer_list.php?del_cst=admin");
        exit(1);
    }
}

// Proceed to delete the customer account if not an admin
$delete_query = "DELETE FROM customer WHERE c_id = '{$c_id}';";
$delete_result = $mysqli->query($delete_query);

if ($delete_result) {
    header("location: admin_customer_list.php?del_cst=1");
} else {
    header("location: admin_customer_list.php?del_cst=0");
}
?>
