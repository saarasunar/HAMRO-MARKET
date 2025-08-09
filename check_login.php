<?php
include('conn_db.php');

// Retrieve the username and password from the form
$username = $_POST["username"];
$pwd = $_POST["pwd"];

// Query to check if the username and password match
$query = "SELECT c_id, c_username, c_firstname, c_lastname FROM customer 
          WHERE c_username = '$username' AND c_pwd = '$pwd' LIMIT 1";
$result = $mysqli->query($query);

if ($result->num_rows == 1) {
    // Fetch the matching user details
    $row = $result->fetch_array();

    // Check if the username is 'admin'
    if (strtolower($row["c_username"]) === 'admin') {
        ?>
        <script>
            alert("Admin cannot log in from the customer login page. Please use the admin login page.");
            window.location.href = 'admin/admin_login.php'; // Redirect to admin login
        </script>
        <?php
        exit;
    }

    // If not admin, proceed with customer login
    session_start();
    $_SESSION["cid"] = $row["c_id"];
    $_SESSION["firstname"] = $row["c_firstname"];
    $_SESSION["lastname"] = $row["c_lastname"];
    $_SESSION["utype"] = "customer";

    header("location: index.php"); // Redirect to the customer dashboard
    exit(1);
} else {
    // Invalid username or password
    ?>
    <script>
        alert("You entered wrong username and/or password!");
        history.back(); // Go back to the login page
    </script>
    <?php
}
?>
