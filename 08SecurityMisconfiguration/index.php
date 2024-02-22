<?php
// This PHP file is vulnerable to security misconfiguration

// Database configuration
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'my_misconfiguration';

// Connect to the database
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to fetch user data from the database
function getUserData($user_id) {
    global $conn;
    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

// Assume user input for user ID
$user_id = $_GET['user_id'];

// Fetch user data
$user_data = getUserData($user_id);

// Display user data
echo "User ID: " . $user_data['id'] . "<br>";
echo "First Name: " . $user_data['first_name'] . "<br>";
echo "Last Name: " . $user_data['last_name'] . "<br>";

// Close database connection
mysqli_close($conn);
?>
