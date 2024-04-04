<?php
// Include DB.php
include 'DB.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve all the form input from RequestDesignConsultation.php
    $clientID = $_GET['clientId']; 
    $designerID = $_POST['designerID'];
    $roomType = $_POST['roomType']; 
    $designCategory = $_POST['designCategory']; 
    $width = $_POST['width'];
    $length = $_POST['length'];
    $colorPreferences = $_POST['colorPreferences'];

    // Retrieve roomTypeID based on room type
    $sqlRoomType = "SELECT id FROM roomtype WHERE type = ?";
    $stmtRoomType = $conn->prepare($sqlRoomType);
    $stmtRoomType->bind_param("s", $roomType);
    $stmtRoomType->execute();
    $resultRoomType = $stmtRoomType->get_result();
    $rowRoomType = $resultRoomType->fetch_assoc();
    $roomTypeID = $rowRoomType['id'];
    $stmtRoomType->close();

    // Retrieve designCategoryID based on design category
    $sqlDesignCategory = "SELECT id FROM DesignCategory WHERE category = ?";
    $stmtDesignCategory = $conn->prepare($sqlDesignCategory);
    $stmtDesignCategory->bind_param("s", $designCategory);
    $stmtDesignCategory->execute();
    $resultDesignCategory = $stmtDesignCategory->get_result();
    $rowDesignCategory = $resultDesignCategory->fetch_assoc();
    $designCategoryID = $rowDesignCategory['id'];
    $stmtDesignCategory->close();

    // Inserting the data retrieved from the form in RequestDesignConsultation.php
    $sql = "INSERT INTO designconsultationrequest (clientID, designerID, roomTypeID, designCategoryID, roomWidth, roomLength, colorPreferences, date, statusID)
        VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), 1)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters
    $stmt->bind_param("iiiiidd", $clientID, $designerID, $roomTypeID, $designCategoryID, $width, $length, $colorPreferences);

    // Execute the statement
    $stmt->execute();

    // Checking if the insertion was successful
    if ($stmt->affected_rows > 0) {
        // Retrieve the auto-generated requestID
        $requestID = $stmt->insert_id;
        echo "New request inserted with requestID: " . $requestID;
    } else {
        echo "Error inserting request: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
    // Close the connection
    $conn->close();

    // Redirect to Clinet.php after completing the database operation
    header('Location: Clinet.php');
} else {
    echo "Error entering data into the database";
    // Redirect to Clinet.php after encountering an error
    header('Location: Clinet.php');
}
?>
