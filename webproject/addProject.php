
<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if designer ID is set in the session
    if (isset($_SESSION['user_id'])) {
        $designerID = $_SESSION['user_id'];
        $pName = $_POST['projectname'];
        $description = $_POST['Descriptiontext'];
        $category = $_POST['DesignSelect'];

        // Generate unique filename for the uploaded image
        $imageFileName = $_FILES["image"]["name"];
        $extension = pathinfo($imageFileName, PATHINFO_EXTENSION);
        $filenewname = $pName . "_" . uniqid() . "." . $extension;
        $folder = "images/" . $filenewname;

        // Move uploaded file to desired location
        move_uploaded_file($_FILES["image"]["tmp_name"], $folder);

        // Retrieve category ID
        $queryCat = "SELECT id FROM DesignCategory WHERE category='$category'";
        $result = mysqli_query($conn, $queryCat);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $categoryID = $row['id'];

            // Insert project into database
            $sql = "INSERT INTO DesignPortoflioProject (designerID, projectName, projectImgFileName, description, designCategoryID) 
                    VALUES ($designerID, '$pName', '$filenewname', '$description', $categoryID)";
            if (mysqli_query($conn, $sql)) {
                header("Location: DesignerHomepage.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Error: Category not found";
        }
    } else {
        echo "Designer ID not found in session.";
    }
}
?>