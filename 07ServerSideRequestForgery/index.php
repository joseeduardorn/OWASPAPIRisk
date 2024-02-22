<?php
// Fetch URL content and display it
function fetchURL($url) {
    $content = file_get_contents($url); // Fetch URL content
    echo $content; // Output the fetched content
}

// Get the URL from the query parameter (in a real scenario, you'd want to validate and sanitize this input)
$url = $_GET['url'];

// Call the fetchURL function with the provided URL
fetchURL($url);
?>
