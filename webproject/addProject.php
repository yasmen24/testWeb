
<?php

$connection = mysqli_connect("localhost", "root", "root", "webproject");

// Check connection
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}


        
        $pName = $_POST['projectname'];
        $description = $_POST['Descriptiontext'];
        $category = $_POST['DesignSelect'];

        // Prepare the query to insert data
        $queryCat = "SELECT id FROM designcategory WHERE category='$category'";
        $result = mysqli_query($connection, $queryCat);
        $row = mysqli_fetch_assoc($result);
        $categoryID = $row['id'];

        // Generate unique filename for the uploaded image
        $path_parts = pathinfo($_FILES["image"]["name"]);
        $extension = $path_parts['extension'];
        $filenewname = $pName . "_" . uniqid() . "." . $extension;
        $folder = "images/" . $filenewname;

       
         // Insert data into database
         $sql = "INSERT INTO designportoflioproject ( projectName, projectImgFIleName, description, designCategoryID) VALUES ($pName, $filenewname, $description, $categoryID)";
         mysqli_query($connection, $sql);
         
          header("Location: DesignerHomepage.php");
            exit();
        

?>