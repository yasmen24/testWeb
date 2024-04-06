<?php


 include_once 'DB.php';
 include_once'fileUpload.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST')

{
    // Retrieve form data
    $id=$_POST['projectId'];
    $projn = $_POST['ProjectName'];
    $description =$_POST['desc'];
     $category=  getCategoryOrId($_POST['drop-downMenue'], $conn);
    // Update project in the database
  
       if(!empty($_FILES['image']["name"])) {
    $image = uploadImage('image');
 
    $sql = "UPDATE designportfolioproject SET projectName = ?, projectImgFileName = ?, description = ?, designCategoryID = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisi", $projn, $image, $description, $category, $id);
    $stmt->execute();
} else {
    $sql = "UPDATE designportfolioproject SET projectName = ?, description = ?, designCategoryID = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $projn, $description, $category, $id); 
    $stmt->execute(); 
}

        header("Location:DesignerHomepage.php");
        exit();


                    
}else{ header("Location:index.php");
        exit();
}




