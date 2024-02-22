<?php
// Improved PHP code with security enhancements

// Load database credentials from a configuration file
include 'config.php';

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
    // Log the error securely
    error_log("Connection failed: " . mysqli_connect_error());
    // Show a generic error message to users
    die("Oops! Something went wrong. Please try again later.");
}

// Function to fetch user data from the database using prepared statements
function getUserData($conn, $user_id) {
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

// Check if user_id parameter is provided and is a positive integer
if (isset($_GET['user_id']) && ctype_digit($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    // Fetch user data
    $user_data = getUserData($conn, $user_id);
    if ($user_data) {
        // Display user data
        echo "User ID: " . $user_data['id'] . "<br>";
        echo "First Name: " . $user_data['first_name'] . "<br>";
        echo "Last Name: " . $user_data['last_name'] . "<br>";
    } else {
        echo "User not found.";
    }
} else {
    echo "Invalid user ID.";
}

// Close database connection
mysqli_close($conn);
?>
