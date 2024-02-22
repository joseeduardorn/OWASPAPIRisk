<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["xmlFile"])) {
    // File upload directory
    $uploadDirectory = "uploads/";

    // Get the uploaded file's name and temporary location
    $fileName = $_FILES["xmlFile"]["name"];
    $fileTmp = $_FILES["xmlFile"]["tmp_name"];

    // Set the destination path for the uploaded file
    $destination = $uploadDirectory . $fileName;

    // Move the uploaded file to the destination directory
    if (move_uploaded_file($fileTmp, $destination)) {
        echo "File uploaded successfully.";
    } else {
        echo "Error uploading file.";
    }
} else {
    // If the form was not submitted or file is not set, redirect back to the form page
    header("Location: index.html");
    exit;
}
?>
