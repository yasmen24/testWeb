<?php
    session_start();

    $connection = mysqli_connect("localhost", "root", "root", "webproject");
    $error = mysqli_connect_error();
    if ($error != null) {
        echo '<p> cant connect to DB<br>';
    } 
    else{


    if (!isset($_SESSION['id'])) {
            echo("<script>alert('You are not logged in, please login or sign up first");
            echo("<script>window.location = 'index.php';</script>");
            exit();
    }
    
    if(!isset($_SESSION['userType']) || $_SESSION['userType']=="client") {
        echo 'You do not have access to this page';
        echo("<script>window.location = 'Clinet.php';</script>"); //page doesnt exist yet
    }

  
    $designerID = $_SESSION['id'];
    $sql = "SELECT id, firstName, lastName, emailAddress, brandName FROM Designer WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $designerID);
    $stmt->execute();
    $stmt->bind_result($designerID, $firstName, $lastName, $emailAddress, $brandName);
    $stmt->fetch();
            //echo "<script>alert(".$designerID.");</script>";

    // Close statement
    $stmt->close();
    }
?>


<!DOCTYPE html>
<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title> Designer Homepage </title>
			<link rel="stylesheet" href="Designer.css">
			<link rel="stylesheet" href="basics.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
			<script src="Designerjs.js"></script>
		</head>
		
		<body>
			<header id="Home-header">

				<div class="logo-title">
		
					<img src="image/logo.jpeg" alt="design mate Logo" id="logo">
		
					<span></span>
		
				</div>
			</header>
                   

			<section id="userInfo">
				<div id="tableHeadr-1">
                                        <h3 id="welcomeText">welcome <?php echo $firstName;?> !</h3>                                   
                                    <a href="index.php" id="logout">Log-out</a>
                                </div>



				<div id="designerInfo">
                                    
                                    <ul>
                                        <li>First Name: <span><?php echo $firstName;?></span></li>
                                        <li>Last Name: <span><?php echo $lastName;?></span></li>
                                        <li>Email Address: <span><?php echo $emailAddress;?></span></li>
                                       <!-- <li>Phone: <span>{$designer['phone']}</span></li> -->
                                        <li>Brand Name: <span><?php echo $brandName;?></span></li>
                                        <li>Logo: <span>
                                            <?php
                                            $sqlimg= "SELECT logoImgFileName FROM Designer WHERE id=$designerID";
                                            if($resultsimg = mysqli_query($connection, $sqlimg)){
                                                while ($rowimg = mysqli_fetch_assoc($resultsimg)) {
                                                    echo '<img src="images/'.$rowimg["projectImgFileName"].'" alt="designer\'s logo" width="100" height="100" style="border: solid" >';
                                                   //echo '<img src="images/GoldenDunes_65fd29d76fd66.jpeg" alt="designer\'s logo" width="100" height="100" style="border: solid" >';
                                                   //echo '<img src="images/'.$row["projectImgFileName"].'" style="height: 250px; width: 500px;" >';
                                                
                                                    //{$designer['logoImgFileName']}
                                                }
                                            }
                                            ?></span></li>
                                        <li>Specialist in: <span>
                                            <?php
                                                $sql1= "SELECT d.*, dc.category_name 
                                                        FROM designers d 
                                                        INNER JOIN DesignCategory dc ON d.category_id = dc.category_id
                                                        WHERE d.id = '$designerID'";
                                                if($results1 = mysqli_query($connection, $sql1)){
                                                    while ($row = mysqli_fetch_assoc($results1)) {
                                                        echo"<option name='".$row['category']."' value='".$row['category']."'>".$row['category']."</option>";
                                                    }
                                                }
                                            ?></span></li>
                                    </ul>
                                    
				</div>
			
			</section>
                    
                    
                        <section id="2tables">
                                <section id="table1">
                                        <div id="tableHeadr-2">
                                                <h1>Design Portfolio</h1>
                                                <a href="ProjectAdditionPage.php" id="logout">Add New Project</a>
                                        </div>

                                        <table class="table1">
                                            <thead>
                                                <tr>
                                                    <th>Project Name</th>
                                                    <th>Image</th>
                                                    <th>Design Category</th>
                                                    <th>Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <?php
                                                    // Prepare SQL statement to fetch projects from the designer's portfolio along with design category
                                                    /* $designerID = $_SESSION['designerID'];
                                                    $sql = "SELECT p.*, dc.category
                                                        FROM DesignPortoflioProject p 
                                                        INNER JOIN DesignCategory dc ON p.designCategoryID = dc.id
                                                        WHERE p.designerID = $designerID";
                                                    */
                                                    // Execute SQL statement
                                                   
                                                        $sql = "SELECT p.*, dc.category
                                                                FROM DesignPortoflioProject p 
                                                                INNER JOIN DesignCategory dc ON p.designCategoryID = dc.id
                                                                WHERE p.designerID = ?";

                                                        // Prepare and bind parameters for the query
                                                        $stmt = $connection->prepare($sql);
                                                        $stmt->bind_param("i", $designerID);
                                                        $stmt->execute();
                                                        $result = $stmt->get_result();

                                                        // Check if projects exist
                                                        if ($result->num_rows > 0) {
                                                            // Loop through each project and display them in the table
                                                            while ($row = $result->fetch_assoc()) {
                                                                echo '<tr>';
                                                                echo '<td>' . $row["projectName"] . '</td>';
                                                                echo '<td><img src="images/' . $row["projectImgFileName"] . '" style="height: 250px; width: 500px;" ></td>';
                                                                
                                                                $sql2= 'SELECT category FROM DesignCategory WHERE id IN (SELECT designCategoryID FROM DesignPortoflioProject WHERE projectName = "'.$row["projectName"].'")';
                                    
                                                                if($results2 = mysqli_query($connection, $sql2)){
                                                                    while ($row2 = mysqli_fetch_assoc($results2)) {
                                                                        echo '<td>'.$row2['category'].' </td>';
                                                                    }
                                                                } 
                                                                echo '<td>' . $row['category'] . '</td>';
                                                                echo '<td>' . $row['description'] . '</td>';
                                                                echo '</tr>';
                                                            }
                                                        } else {
                                                            // No projects found
                                                            echo '<tr><td colspan="4">No projects found.</td></tr>';
                                                        }
                                                        ?>
                                                    
                                            </tbody>
                                        </table>
                        </section>
			
                            <section id="table2">
                            <h1>Design Consultation Requests</h1>

                            <table class="table2">
                                    <thead>
                                            <tr>
                                                <th>Client</th>
                                                <th>Room</th>
                                                <th>Dimensions</th>
                                                <th>Design Category</th>
                                                <th>Color Preferences</th>
                                                <th>Date</th>
                                            </tr>
                                    </thead>	
                                    
                                    <tbody>
                                    <?php
                                        $sql3 = 'SELECT * FROM DesignConsultationRequest WHERE designerID = '.$designerID.' AND statusID=1';
                                        if($results3 = mysqli_query($connection, $sql3)){
                                            while ($row = mysqli_fetch_assoc($results3)) {
                                                $id = $row['id'];
                                                $cName = 'SELECT firstName AS f, lastName AS l FROM Client WHERE id = '.$row['clientID'].'';
                                                $rType = 'SELECT type FROM RoomType WHERE id = '.$row['roomTypeID'].'';
                                                $dCategory = 'SELECT category FROM DesignCategory WHERE id= '.$row['designCategoryID'].'';

                                                mysqli_query($connection, $cName);
                                                mysqli_query($connection, $rType);
                                                mysqli_query($connection, $dCategory);

                                                echo"<tr>";

                                                    if($resultsName = mysqli_query($connection, $cName)){
                                                        while ($rowName = mysqli_fetch_assoc($resultsName)){
                                                            echo'<td>'.$rowName['f'].' '.$rowName['l'].'</td>'; // client name
                                                    }}
                                                    if($resultsType = mysqli_query($connection, $rType)){
                                                        while ($rowType = mysqli_fetch_assoc($resultsType)){
                                                            echo'<td>'.$rowType["type"].'</td>'; // room type
                                                    }}
                                                    echo'<td>'.$row["roomWidth"].'x'.$row["roomLength"].'m</td>'; //done                                        
                                                    if($resultsCate = mysqli_query($connection, $dCategory)){
                                                        while ($rowCate = mysqli_fetch_assoc($resultsCate)){
                                                            echo'<td>'.$rowCate["category"].'</td>'; // Design Category
                                                    }}
                                                    echo'<td>'.$row["colorPreferences"].'</td>'; //done
                                                    echo'<td>'.$row["date"].'</td>';


                                                    echo'<th><a href="Design consultation page.php?requestID='.$id.'">Provide Consultation</a></th>';
                                                    echo'<th><a href="DeclineConsultation.php?requestID='.$id.'">Decline Consultation</a></th>';
                                                    echo"</tr>";
                                            }
                                        }                            
                                    ?>
                                </tbody>
                                </table>
                            </section>
                        </section>	
			
			<footer id="Home-footer">
                                <div class="multimedia" ><br>
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

