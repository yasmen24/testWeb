<?php
include_once 'DB.php'; // Include your database connection file

// Check if the category parameter is set
if (isset($_GET['category'])) {
    $category = $_GET['category'];

    // Fetch designers from the database based on the selected category
    $sql = "SELECT 
                d.id, 
                d.brandName, 
                d.logoImgFileName, 
                GROUP_CONCAT(c.category SEPARATOR ', ') AS specialties 
            FROM 
                Designer d
                JOIN DesignerSpeciality ds ON d.id = ds.designerID
                JOIN DesignCategory c ON ds.designCategoryID = c.id
            WHERE 
                c.category = ?
            GROUP BY 
                d.id, d.brandName, d.logoImgFileName
            LIMIT 
                0, 25";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    $designers = $result->fetch_all(MYSQLI_ASSOC);

    // Close the prepared statement
    $stmt->close();

    // Return the JSON response
    header('Content-Type: application/json');
    echo json_encode($designers);
} else {
    // If the category parameter is not set, return an error response
    http_response_code(400); // Bad Request
    echo json_encode(array("message" => "Category parameter is missing."));
}
?>