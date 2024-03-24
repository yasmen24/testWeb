<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update project page</title>
    <link rel="stylesheet" href="Updatepage.css">
    <link rel="stylesheet" href="basics.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

    <header id="Home-header">

        <div class="logo-title">

            <img src="image/logo.jpeg" alt="design mate Logo" id="logo">

            <span></span>

        </div>
        <?php

        $connection = mysqli_connect("localhost", "root", "root", "webproject");

        // Check connection
        if (mysqli_connect_errno()) {
            die("Connection failed: " . mysqli_connect_error());
        }
        else {
           if(isset($_GET['id'])) {
               $projectid =$_GET['id'];
               $sql = "SELECT * FROM designportfolioprojec wHERE Id=$projectid";
               $result = mysqli_query($connection, $sql);
               if (isset($result)) {
                   $row =mysqli_fetch_assoc($result);
                   $projn = $row['projectname'];
                   $image = $row['projectImgFIleName'];
                   $description =$row['description'];
                   $category =$row['designCategoryID ']; }
                   
             } } 
           
        ?>

    </header>    
    <section>
        <form action="UpdatePage.php" method="post" name="ProjectUpdateForm" enctype="multipart/form-data"  >
        <h1> Edit Project </h1>
        
                <!-- Hidden input field to store project ID -->
                <input type="hidden" name="projectId" value="<?php echo $projectId ?>">
                
            <!--project name-->
            <div class="Pname">
                <label for="ProjectName" >Project Name:</label>
                <input type="text" id="ProjectName"name='ProjectName' value="<?php echo $projn ?> "<br>
            </div>
            
            <!--project logo-->
            <div class="Plogo">
                <label for="image">Insert logo brand:</label>
                <input type="file" id="image" name="image" <?php echo $image ?> ><br>
            </div>

            <!--drop down menue-->
            <div class="Pmenue">
            <label for="drop-downMenue">Select Category:</label>
                        <select name="drop-downMenue" class="drop-downMenue">
                            <option value="Minimalist" <?php if($category == "Minimalist") echo "selected"; ?>> Minimalist</option>
                            <option value="Modern" <?php if($category == "Modern") echo "selected"; ?> >Modern</option>
                            <option value="Country" <?php if($category == "Country") echo "selected"; ?> >Country</option>
                            <option value="Coastal" <?php if($category == "Coastal") echo "selected"; ?>>Coastal</option>
                            <option value="Bohemian" <?php if($category == "Bohemian") echo "selected"; ?>>Bohemian</option>
                           
                        </select><br>
                    </div>        
            <!--description (text area)-->
            <div class="Pdescription">
            <textarea  name='desc' placeholder="design description..." cols="30%" rows="5%"  ><?php echo $description ?></textarea><br>
            </div>
                <!--submit button-->

           <input type="submit" id="btn" name="btn" value="Submit" />

       
        </form>
        
    </section>
 

    <script src="UpdatePage.js"></script>
    <footer id="Home-footer">

        <!-- Multimedia -->

        <div class="multimedia" >

            <br>
       <div class="icons">
            <i class="fa-solid fa-envelope">   </i>

            <i class="fa-solid fa-phone">   </i>
            <i class="fa-brands fa-twitter icons">   </i>
            <i class="fa-brands fa-instagram">   </i></div>
<p>© 2024 - DESIGN MATE ALL RIGHTS RESERVED. | 55 RUE GABRIEL LIPPMANN, L-6947, NIEDERANVEN, LUXEMBOURG</p>

        </div>
    </footer>
</body>

</html>
   
   <?php

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    
    $projn = $_POST['ProjectName'];
    $image = $_POST['image'];
    $description =$_POST['desc'];
    $category =$_POST['drop-downMenue'];
   

    // Update project in the database
  
    $sql = "UPDATE designportoflioproject SET projectname = ?, projectImgFIleName = ?,description= ?,designCategoryID = ?, WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $projn, $image, $description, $category , $projectId);
   

        header("Location: DesignerHomepage.php");
            exit();
        
}

?>
