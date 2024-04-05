
    <?php
    session_start();
    include 'DB.php';
    include 'fileUpload.php';

    if(!isset($_SESSION['id'])){
      header('Location: login.php');
    exit();
    }
    $designerID = $_SESSION['id'];

    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $projectname = $_POST["projectname"];
        $category = $_POST["category"];
        $description = $_POST["Descriptiontext"];

        // Handle file upload
        $target_dir = "uploads/"; // Directory where images will be stored
        $image=uniqid() . "_" . basename($_FILES["file"]["name"]);
        
//        $target_file = $target_dir . uniqid() . "_" . basename($_FILES["file"]["name"]);
           $target_file = $target_dir. $image;

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["file"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                // Insert data into database

                $sql = "INSERT INTO designportfolioproject (designerID, projectName, projectImgFileName, description, designCategoryID) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                if (!$stmt) {
                    // Error handling if preparation fails
                    echo "Error preparing SQL statement: " . $conn->error;
                    exit();
                }

                // Assuming designerID and designCategoryID are known and provided
                //$designerID = 1; // Sample designer ID
                $stmt_category = $conn->prepare("SELECT id FROM DesignCategory WHERE category = ?");
                $stmt_category->bind_param("s", $category);
                $stmt_category->execute();
                $result = $stmt_category->get_result();
                if ($row = $result->fetch_assoc()) {
                    $designCategoryID = $row['id'];
                } else {
                    // Handle if category ID is not found
                    echo "Error: Category ID not found.";
                    exit();
                }

                $stmt->bind_param("isssi", $designerID, $projectname, $image, $description, $designCategoryID);
                if (!$stmt) {
                    // Error handling if binding parameters fails
                    echo "Error binding parameters: " . $stmt->error;
                    exit();
                }

                // Execute the prepared statement
                if ($stmt->execute()) {
                    // Success
                    echo "The file " . htmlspecialchars(basename($_FILES["file"]["name"])) . " has been uploaded.";
                    // Redirect to designer's homepage
                    header("Location: DesignerHomepage.php");
                    exit();
                } else {
                    // Error handling if execution fails
                    echo "Error executing prepared statement: " . $stmt->error;
                    exit();
                }

                // Close the prepared statement
                $stmt->close();

            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    
    
    ?>
