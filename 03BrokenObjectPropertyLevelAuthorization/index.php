<?php

session_start();

class User {
    public $username;
    public $role;

    public function __construct($username, $role) {
        $this->username = $username;
        $this->role = $role;
    }

    public function isAdmin() {
        return $this->role === 'admin';
    }
}

class Database {
    private $users = [];

    public function __construct() {
        // Dummy data for demonstration purposes
        $this->users[] = new User('user1', 'user');
        $this->users[] = new User('user2', 'admin');
    }

    public function getUserByUsername($username) {
        foreach ($this->users as $user) {
            if ($user->username === $username) {
                return $user;
            }
        }
        return null;
    }
}

class UserController {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function displayUserInfo($username) {
        $loggedInUser = $this->getLoggedInUser();

        if (!$loggedInUser) {
            echo "You are not logged in.";
            return;
        }

        $user = $this->db->getUserByUsername($username);

        if (!$user) {
            echo "User not found";
            return;
        }

        if ($loggedInUser->isAdmin() || $loggedInUser->username === $username) {
            echo "Username: " . $user->username . "<br>";
            echo "Role: " . $user->role . "<br>";
            // Assuming only admin can see this sensitive information
            if ($user->isAdmin()) {
                echo "Sensitive information: Only visible to admins<br>";
            }
        } else {
            echo "You are not authorized to view this user's information.";
        }
    }

    private function getLoggedInUser() {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        return null;
    }
}

$db = new Database();
$controller = new UserController($db);

// Simulate user login
$_SESSION['user'] = new User('user2', 'admin');


// Example usage
$username = 'user1'; // The logged-in user tries to access their own information
$controller->displayUserInfo($username);
?>
