
<?php
include_once 'DB.php';
include_once'fileUpload.php';

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    // Retrieve all the form input from RequestDesignConsultation.php
    $clientID = $_SESSION['id'];
   
    $designerID = $_POST['designerID'];
  $roomType = $_POST['roomType']; 

    $designCategoryID =getCategoryOrId( $_POST['designCategory'], $conn); 
    $width = $_POST['width'];
    $length = $_POST['length'];
    $colorPreferences = $_POST['colorPreferences'];
    // Retrieve roomTypeID based on room type
$roomTypeID= getroomTypeOrId($_POST['roomType'],$conn);
if (empty($designerID) || empty($roomType) || empty($designCategoryID) || empty($width) || empty($length) || empty($colorPreferences)) {
        $errors[] = "All fields are required.";
    }
    
    if (!is_numeric($width) || !is_numeric($length) ) {
        $errors[] = "Width and Length must be numeric.";
    }
    
    // If validation failed, redirect back to form with errors
    if (!empty($errors)) {
        $_SESSION['form_errors'] = $errors;
        header('Location: RequestDesignConsultation.php'); // Adjust to your form's actual URL
        exit;
    }
$statusID=1;
 ////here will insert the string as numric
$sql = "INSERT INTO designconsultationrequest 
            (clientID, designerID, roomTypeID, designCategoryID, roomWidth, roomLength, date, statusID, colorPreferences) 
        VALUES (?, ?, ?, ?, ?, ?, NOW(), ?, ?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}
// Use a default or placeholder value for colorPreferences
if (!$stmt->bind_param("iiiiiddi", $clientID, $designerID, $roomTypeID, $designCategoryID, $width, $length, $statusID,$colorPreferences )) {
    die("Error binding parameters: " . $stmt->error);
}

if ($stmt->execute()) {
    echo "Success! The record has been added.";
     $requestID = $stmt->insert_id;
        $stmt->close();
        $sqlUpdate = "UPDATE designconsultationrequest SET colorPreferences=? WHERE id=?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        if (!$stmtUpdate) {
            die("Error preparing update statement: " . $conn->error);
        }
        if (!$stmtUpdate->bind_param("si", $colorPreferences, $requestID)) {
            die("Error binding parameters for update: " . $stmtUpdate->error);
        }
        if ($stmtUpdate->execute()) {
            header('Location: Clinet.php');
            echo "Color preferences updated successfully.";
        } else {
            echo "Error updating color preferences: " . $stmtUpdate->error;
        }
        $stmtUpdate->close();
    
} else {
    echo "Error executing statement: " . $stmt->error;
}




}else{
    
     $_SESSION['form_errors'] = ['Invalid request method.'];
    header('Location: RequestDesignConsultation.php');
    exit();
}





//Redirect or further processing
// Remember to use output buffering or ensure no output before this if redirection is intended
// header('Location: Client.php');




//    // Checking if the insertion was successful
//    if ($stmt->affected_rows > 0) {
//        // Retrieve the auto-generated requestID
//        $requestID = $stmt->insert_id;
//        echo "New request inserted with requestID: " . $requestID;
//    } else {
//        echo "Error inserting request: " . $stmt->error;
//    }
//
//    // Close the statement
//    $stmt->close();
//    // Close the connection
//    $conn->close();
//
//    // Redirect to Clinet.php after completing the database operation
////    header('Location: Clinet.php');
//} else {
//    echo "Error entering data into the database";
//    // Redirect to Clinet.php after encountering an error
////    header('Location: Clinet.php');
//}

//    $sqlRoomType = "SELECT id FROM roomtype WHERE type = ?";
//    $stmtRoomType = $conn->prepare($sqlRoomType);
//    $stmtRoomType->bind_param("s", $roomType);
//    $stmtRoomType->execute();
//    $resultRoomType = $stmtRoomType->get_result();
//    $rowRoomType = $resultRoomType->fetch_assoc();
//    $roomTypeID = $rowRoomType['id'];
//    $stmtRoomType->close();

//    // Retrieve designCategoryID based on design category
//    $sqlDesignCategory = "SELECT id FROM DesignCategory WHERE category = ?";
//    $stmtDesignCategory = $conn->prepare($sqlDesignCategory);
//    $stmtDesignCategory->bind_param("s", $designCategory);
//    $stmtDesignCategory->execute();
//    $resultDesignCategory = $stmtDesignCategory->get_result();
//    $rowDesignCategory = $resultDesignCategory->fetch_assoc();
//    $designCategoryID = $rowDesignCategory['id'];
//    $stmtDesignCategory->close();

    // Inserting the data retrieved from the form in RequestDesignConsultation.php
//  
//   
// Assuming all the variables ($clientID, $designerID, $roomTypeID, $designCategoryID, $width, $length, $colorPreferences, $statusID) are defined earlier in your script



