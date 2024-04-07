<?php 
    /*Checks the designer id that is sent in the query string, retrieves all the projects that the
    designer has in the designer’s design portfolio and displays them in a table that includes 4
    columns: the project name, image, design category, and description*/
    session_start();

    if(!isset($_SESSION['id'])){ //If the designerID is not set onto session variable, we go back to Clinet.php to set it again
        header("Location: index.php");
        exit;
    }

    include_once 'DB.php';
    include_once 'fileUpload.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Designer Homepage</title>
        <link rel="stylesheet" href="Designer.css">
        <link rel="stylesheet" href="basics.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="Designerjs.js"></script>
    </head>    

    <body>
        <?php
            echo "<header id='Home-header'>";
                echo "<div class='logo-title'>";
                    echo '<img src="image/logo.jpeg" alt="design mate Logo" id="logo">';
                echo '</div>';
            echo "</header>";
            echo "<section id='userInfo'>";
                echo "<div id='tableHeadr-1'>";
                    echo "<h3 id='welcomeText'>Designer portfolio</h3>";
                    echo "<a href='index.php' id='logout'>Log-out</a>";
                echo "</div>";

                $designerID = $_GET['designerId'];
                $sql = "SELECT * FROM `designer` WHERE `id`=".$designerID;
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                echo "<div id='designerInfo'>";
                    echo "<ul>";  
                    echo "<li>brand Name:<span> ".$row['brandName']."</span></li>";
                        echo "<li>Designer Full Name:<span>".$row['firstName']."  ".$row['lastName']." </span></li>";
                        echo "<li>Email Address:<span> ".$row['emailAddress']."</span></li>";
                  
                    echo "</ul>";
                echo "</div>";             
            echo "</section>";  

            echo "<section id='table1'>";
                echo "<div id='tableHeadr-2'>";
                echo "</div>";    
                echo "<table class='table1' >";
                    $sql = "SELECT * FROM `designportfolioproject` WHERE `designerID`=".$designerID;
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0) {
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th>Project Name</th>";
                                echo "<th>Image</th>";
                                echo "<th>Design Category</th>";
                                echo "<th>Description</th>";
                            echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";    
                        while ($row = mysqli_fetch_assoc($result)){
                            echo "<tr>";
                                echo "<td style='width:fit-content;'>".$row['projectName']."</td>";
                                echo "<td style='width:20%'><img src='uploads/".$row['projectImgFileName']."' alt='IMAGE DESCRIPTION: Modern living room' style='width:50%; ' ></td>";
                                echo "<td style='width:fit-content;'>".getCategoryOrId($row['designCategoryID'], $conn)."</td>";
                                echo "<td class='des' style='width:fit-content;'>".$row['description']."</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                    } else {
                        // No data retrieved
                        echo "<div style='text-align: center;'><strong style='font-size: 40px; color:#801e00;border: 2px solid black; padding: 20px;'>No projects have been uploaded.</strong></div>";
                    }
                echo "</table>";
            echo "</section>";
        ?>
        <footer id="Home-footer">
            Multimedia 
            <div class="multimedia">
                <br>
                <div class="icons">
                    <i class="fa-solid fa-envelope">   </i>
                    <i class="fa-solid fa-phone">   </i>
                    <i class="fa-brands fa-twitter icons">   </i>
                    <i class="fa-brands fa-instagram">   </i>
                </div>
                <p>© 2024 - DESIGN MATE ALL RIGHTS RESERVED. | 55 RUE GABRIEL LIPPMANN, L-6947, NIEDERANVEN, LUXEMBOURG</p>    
            </div>
        </footer>
    </body>
</html>