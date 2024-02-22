<?php
// Assume these variables contain user role information
$userRole = "user"; // User role (could be "user" or "admin")

// Function to delete a user account (vulnerable to Broken Function Level Authorization)
function deleteUserAccount($userId) {
    global $userRole;
    
    // Check if the user is an admin before allowing the deletion
    if ($userRole === "admin") {
        // Delete user account (this is where the actual deletion would occur)
        echo "Admin: User account $userId has been deleted successfully.<br>";
    } else {
        // User does not have permission to delete the account
        echo "User: You do not have permission to delete user accounts.<br>";
    }
}

// Simulate different users attempting to delete accounts
// In a secure application, the user's role would be properly authenticated and authorized

// Example 1: User with ID 123 attempts to delete their own account (should be denied)
$userRole = "user"; // Simulate a regular user
echo "User ID 123 attempting to delete their own account: ";
deleteUserAccount(123); // This function call should be denied for regular users

// Example 2: User with ID 456 attempts to delete another user's account (should be denied)
$userRole = "user"; // Simulate a regular user
echo "User ID 456 attempting to delete another user's account: ";
deleteUserAccount(789); // This function call should be denied for regular users

// Example 3: Admin with ID 999 attempts to delete a user account (should be allowed)
$userRole = "admin"; // Simulate an admin user
echo "Admin ID 999 attempting to delete a user account: ";
deleteUserAccount(789); // This function call should be allowed for admins
?>
