<?php
// Suppress warnings
error_reporting(E_ERROR | E_PARSE);

class User {
    public $id;
    public $username;
    public $isAdmin;

    public function __construct($id, $username, $isAdmin = false) {
        $this->id = $id;
        $this->username = $username;
        $this->isAdmin = $isAdmin;
    }

    public function isAdmin() {
        return $this->isAdmin;
    }
}

class Database {
    private $users = array();

    public function __construct() {
        // For demonstration purposes, we hardcode some users here
        $this->users[] = new User(1, "admin", true);
        $this->users[] = new User(2, "user1", false);
        $this->users[] = new User(3, "user2", false);
    }

    public function getUserById($id) {
        foreach ($this->users as $user) {
            if ($user->id == $id) {
                return $user;
            }
        }
        return null;
    }
}

class Authorization {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function canEditProfile($userId, $requestingUserId) {
        $user = $this->db->getUserById($userId);
        $requestingUser = $this->db->getUserById($requestingUserId);

        if (!$user || !$requestingUser) {
            return false;
        }

        // Check if the requesting user is an admin or the owner of the profile
        if ($requestingUser->isAdmin() || $user->id == $requestingUser->id) {
            return true;
        }

        return false;
    }
}

// Usage
$db = new Database(); // database 
$auth = new Authorization($db);

// Check if userId parameter is provided
if (!isset($_GET['userId'])) {
    echo "User ID is missing.";
    exit;
}

$userId = $_GET['userId']; // Insecure, should be sanitized

// Check if $_SESSION is set
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$requestingUserId = $userId;//isset($_SESSION['userId']) ? $_SESSION['userId'] : null;

if ($auth->canEditProfile($userId, $requestingUserId)) {
    echo "User can edit the profile.";
} else {
    echo "User cannot edit the profile.";
}
?>
