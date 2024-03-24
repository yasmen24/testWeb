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
                            <?php
                            session_start();

                            // Check if designer ID is set in the session
                            if(isset($_SESSION['user_id'])) {
                                // Database connection parameters
                                $servername = "localhost";
                                $username = "root";
                                $password = "root";
                                $dbname = "WebProject";

                                // Create connection
                                $conn = mysqli_connect($servername, $username, $password, $dbname);

                                // Check connection
                                if (!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                }

                                // Prepare SQL statement to fetch designer information
                                $designerID = $_SESSION['user_id'];
                                $sql = "SELECT d.*, dc.category_name 
                                    FROM designers d 
                                    INNER JOIN DesignCategory dc ON d.category_id = dc.category_id
                                    WHERE d.id = $designerID";

                                // Execute SQL statement
                                $result = mysqli_query($conn, $sql);

                                // Check if designer exists
                                if(mysqli_num_rows($result) > 0) {
                                    // Fetch designer's information
                                    $designer = mysqli_fetch_assoc($result);

                                     
                                    // Display the designer's information
                                   /* echo "<h1>Welcome, {$designer['firstName']}!</h1>";
                                    echo "<p>Email: {$designer['emailAddress']}</p>";
                                    echo "<p>Phone: {$designer['logoImgFileName']}</p>";
                                    echo "<p>Brand Name: {$designer['brandName']}</p>";
                                    echo "<p>Logo: {$designer['logoImgFileName']}</p>";
                                    echo "<p>Specialist in: {$designer['category_name']} design</p>";
                                 */   
                                } else {
                                    // Designer not found, handle the situation accordingly
                                    echo "Designer not found.";
                                }

                                // Close connection
                                mysqli_close($conn);
                            } else {
                                // Designer ID not set in session, handle the situation accordingly
                                echo "Designer ID not found in session.";
                            }
                            ?>

                            
				<div id="tableHeadr-1">
                                    <?php if(isset($designer['firstName'])) { ?>
                                        <h3 id="welcomeText">Welcome, <?php echo $designer['firstName']; ?>!</h3>
                                    <?php } ?>
                                    <a href="signout.php" id="logout">Sign out</a>
                                </div>



				<div id="designerInfo">
                                    <?php
                                    echo "<ul>";
                                    echo "<li>Email Address: <span>{$designer['emailAddress']}</span></li>";
                                    echo "<li>Phone: <span>{$designer['phone']}</span></li>";
                                    echo "<li>Brand Name: <span>{$designer['brandName']}</span></li>";
                                    echo "<li>Logo: <span>{$designer['logoImgFileName']}</span></li>";
                                    echo "<li>Specialist in: <span>{$designer['category_name']}  design</span></li>";
                                    echo "</ul>";
                                    ?>
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
                                                // PHP code to retrieve projects from the designer's portfolio and display them in the table
                                                session_start();

                                                // Check if designer ID is set in the session
                                                if(isset($_SESSION['user_id'])) {
                                                    $servername = "localhost"; 
                                                    $username = "root";
                                                    $password = "root";
                                                    $dbname = "WebProject";

                                                    $conn = mysqli_connect($servername, $username, $password, $dbname);

                                                    // Check connection
                                                    if (!$conn) {
                                                        die("Connection failed: " . mysqli_connect_error());
                                                    }

                                                    // Prepare SQL statement to fetch projects from the designer's portfolio along with design category
                                                    $designerID = $_SESSION['user_id'];
                                                    $sql = "SELECT p.*, dc.category
                                                        FROM DesignPortoflioProject p 
                                                        INNER JOIN DesignCategory dc ON p.designCategoryID = dc.id
                                                        WHERE p.user_id = $designerID";

                                                    // Execute SQL statement
                                                    $result = mysqli_query($conn, $sql);

                                                    // Check if projects exist
                                                    if(mysqli_num_rows($result) > 0) {
                                                        // Loop through each project and display them in the table
                                                        while($row = mysqli_fetch_assoc($result)) {
                                                            echo "<tr>";
                                                            echo "<td>{$row['projectName']}</td>";
                                                            echo "<td><img src='image/{$row['projectImgFileName']}' alt='{$row['projectName']}'></td>";
                                                            echo "<td>{$row['category']}</td>"; 
                                                            echo "<td>{$row['description']}</td>";
                                                            echo "<td><a href='UpdatePage.php?project_id={$row['id']}'>Edit</a></td>"; 
                                                            echo "<td><a href='DeleteProject.php?project_id={$row['id']}'>Delete</a></td>"; 
                                                            echo "</tr>";
                                                        }
                                                    } else {
                                                        // No projects found
                                                        echo "<tr><td colspan='6'>No projects found.</td></tr>";
                                                    }

                                                    // Close connection
                                                    mysqli_close($conn);
                                                } else {
                                                    // Designer ID not set in session
                                                    echo "<tr><td colspan='6'>Designer ID not found in session.</td></tr>";
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
                                    // PHP code to retrieve pending design consultation requests for the designer and display them in the table
                                    session_start();

                                    // Check if designer ID is set in the session
                                    if(isset($_SESSION['user_id'])) {
                                                    $servername = "localhost"; 
                                                    $username = "root";
                                                    $password = "root";
                                                    $dbname = "WebProject";

                                                    $conn = mysqli_connect($servername, $username, $password, $dbname);

                                        // Check connection
                                        if (!$conn) {
                                            die("Connection failed: " . mysqli_connect_error());
                                        }

                                        // Prepare SQL statement to fetch pending design consultation requests for the designer
                                        $designerID = $_SESSION['user_id'];
                                        $sql = "SELECT cr.*, c.firstName AS clientFirstName, c.lastName AS clientLastName, rt.type AS roomType, dc.category AS designCategory, rs.status
                                                FROM DesignConsultationRequest cr 
                                                INNER JOIN Client c ON cr.clientID = c.id
                                                INNER JOIN RoomType rt ON cr.roomTypeID = rt.id
                                                INNER JOIN DesignCategory dc ON cr.designCategoryID = dc.id
                                                INNER JOIN RequestStatus rs ON cr.statusID = rs.id
                                                WHERE cr.user_id = $designerID AND rs.status = 'pending'";

                                        // Execute SQL statement
                                        $result = mysqli_query($conn, $sql);

                                        // Check if there are pending requests
                                        if(mysqli_num_rows($result) > 0) {
                                            // Loop through each pending request and display them in the table
                                            while($row = mysqli_fetch_assoc($result)) {
                                                echo "<tr>";
                                                echo "<td>{$row['clientFirstName']} {$row['clientLastName']}</td>";
                                                echo "<td>{$row['roomType']}</td>";
                                                echo "<td>{$row['roomWidth']}m x {$row['roomLength']}m</td>";
                                                echo "<td>{$row['designCategory']}</td>";
                                                echo "<td>{$row['colorPreferences']}</td>";
                                                echo "<td>{$row['date']}</td>";
                                                echo "<td><a href='Design consultation page.php?request_id={$row['id']}'>Provide Consultation</a></td>";
                                                echo "<td><a href='DeclineConsultation.php?request_id={$row['id']}'>Decline Consultation</a></td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            // No pending requests found
                                            echo "<tr><td colspan='8'>No pending consultation requests found.</td></tr>";
                                        }

                                        // Close connection
                                        mysqli_close($conn);
                                    } else {
                                        // Designer ID not set in session
                                        echo "<tr><td colspan='8'>Designer ID not found in session.</td></tr>";
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
