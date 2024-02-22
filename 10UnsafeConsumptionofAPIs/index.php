<?php
// Assume the user-supplied parameter
$username = $_GET['username'];

// Construct the API URL with the user-supplied parameter
$apiUrl = "http://localhost/OWASP10APIRisk/10UnsafeConsumptionofAPIs/username.php?username=$username";

// Fetch user data from the external API
$response = file_get_contents($apiUrl);

// Display the user data (unsafe consumption)
echo $response;
?>
