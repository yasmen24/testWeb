<?php

include 'DB.php'; // Include your database connection
// Check if the form was submitted
function uploadImageAndSaveFilename($conn, $tableName,$column) {
    if (isset($_POST["submit"])) {
        $target_dir = "uploads/"; // Directory where files will be stored
        $originalFilename = basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($originalFilename, PATHINFO_EXTENSION));

        // Generate a unique ID for this image. For example, use the user ID or another relevant ID
        $uniqueId = uniqid(); // This is an example. You might use a different ID based on your application logic.

        // Create a unique filename for the image
        $uniqueFilename = $uniqueId . '.' . $imageFileType;
        $target_file = $target_dir . $uniqueFilename;

        // Attempt to upload the file
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars($uniqueFilename) . " has been uploaded.";

            // Insert the unique filename into the database
           $stmt = $conn->prepare("INSERT INTO $tableName ($coulmn) VALUES (?)");
           $stmt->bind_param("s", $uniqueFilename);
           $stmt->execute();

            echo "File successfully saved to database.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "No file submitted.";
}}




function uploadImage($fileInputName) {
        $target_dir = "uploads/"; // Directory where files will be stored
        $originalFilename = basename($_FILES[$fileInputName]["name"]);
        $imageFileType = strtolower(pathinfo($originalFilename, PATHINFO_EXTENSION));

        // Generate a unique ID for this image. For example, use the user ID or another relevant ID
        $uniqueId = uniqid(); 

        // Create a unique filename for the image
        $uniqueFilename = $uniqueId . '.' . $imageFileType;
        $target_file = $target_dir . $uniqueFilename;

        // Attempt to upload the file
        if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $target_file)) {
            return $uniqueFilename; // Return the unique filename
        } else {
            echo "Sorry, there was an error uploading your file.";
            $_SESSION['signup_error']="Sorry, there was an error uploading your file.";
            return false; // Return false if the upload failed
        }

    }
    
?>