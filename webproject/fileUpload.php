<?php

include 'DB.php'; // Include your database connection
// Check if the form was submitted

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
        $_SESSION['signup_error'] = "Sorry, there was an error uploading your file.";
        return false; // Return false if the upload failed
    }

}

function getCategoryOrId($input, $conn) {
    // Check if the input is numeric or a string
    if (is_numeric($input)) {
        // Input is numeric, so retrieve the corresponding category
        $sql = "SELECT category FROM designcategory WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $input); // Assuming input is an integer (ID)
        $stmt->execute();
        $stmt->bind_result($category);
        $stmt->fetch();
        return $category;
    } else {
        // Input is a string, so retrieve the corresponding ID
        $sql = "SELECT id FROM designcategory WHERE category = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $input); // Assuming input is a string (category)
        $stmt->execute();
        $stmt->bind_result($id);
        $stmt->fetch();
        return $id;
    }
}

function getroomTypeOrId($input, $conn) {
    // Check if the input is numeric or a string
    if (is_numeric($input)) {
        // Input is numeric, so retrieve the corresponding category
        $sql = "SELECT type FROM roomtype WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $input); // Assuming input is an integer (ID)
        $stmt->execute();
        $stmt->bind_result($room);
        $stmt->fetch();
        return $room;
    } else {
        // Input is a string, so retrieve the corresponding ID
        $sql = "SELECT id FROM roomtype WHERE type = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $input); // Assuming input is a string (category)
        $stmt->execute();
        $stmt->bind_result($id);
        $stmt->fetch();
        return $id;
    }
}

function getClientNameById($clientId, $conn) {
    $sql = "SELECT firstName, lastName FROM client WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $clientId); // Assuming client ID is an integer
    $stmt->execute();
    $stmt->bind_result($firstName, $lastName);
    $stmt->fetch();
    return $firstName . " " . $lastName; // Corrected concatenation
}

function getConsultationByRequestID($requestID, $conn) {
    $sql = "SELECT consultation FROM designconsultation WHERE requestID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $requestID); // Assuming requestID is an integer
    $stmt->execute();
    $stmt->bind_result($consultation);
    $stmt->fetch();
    return $consultation;
}


?>

