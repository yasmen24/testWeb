<?php


 include 'DB.php';
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



include 'fileUpload.php';
 
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

