<?php
session_start();

// Simulated user credentials (in real-world scenario, these would come from a database)
$valid_username = 'admin';
$valid_password = 'password123';

// Function to check if the user is logged in
function is_logged_in() {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

// Function to authenticate user
function authenticate($username, $password) {
    global $valid_username, $valid_password;

    // Check if provided credentials match valid credentials
    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        return true;
    } else {
        return false;
    }
}

// Function to log out
function logout() {
    session_unset();
    session_destroy();
}

// Check if form is submitted for authentication
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Attempt authentication
    if (authenticate($username, $password)) {
        echo "Login successful. Welcome, $username!";
    } else {
        echo "Invalid username or password.";
    }
}

// Check if logout action is requested
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    logout();
    echo "You have been logged out.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>

<?php if (!is_logged_in()): ?>
    <h2>Login</h2>
    <form method="post" action="">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" name="submit" value="Login">
    </form>
<?php else: ?>
    <p>Welcome, <?php echo $_SESSION['username']; ?>! You are logged in.</p>
    <a href="?action=logout">Logout</a>
<?php endif; ?>

</body>
</html>
