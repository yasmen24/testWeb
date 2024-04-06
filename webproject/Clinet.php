<?php
include_once'DB.php';
include_once 'fileUpload.php';
include 'session_check.php';
 
$clientId=$_SESSION['id'];

function fetchDesigners($category = null) {
    global $conn; // Use the connection from the global scope
    // Updated SQL query with proper GROUP BY clause
    $sql = "SELECT 
                d.id, 
                d.brandName, 
                d.logoImgFileName, 
                GROUP_CONCAT(c.category SEPARATOR ', ') AS specialties 
            FROM 
                Designer d
                JOIN DesignerSpeciality ds ON d.id = ds.designerID
                JOIN DesignCategory c ON ds.designCategoryID = c.id";
    
    if ($category) {
        // Append WHERE clause for filtering by category
        $sql .= " WHERE c.category = ? GROUP BY d.id, d.brandName, d.logoImgFileName LIMIT 0, 25";
        $stmt = $conn->prepare($sql);
        // Bind the category parameter
        $stmt->bind_param("s", $category);
    } else {
        // Append GROUP BY clause without filtering
        $sql .= " GROUP BY d.id, d.brandName, d.logoImgFileName LIMIT 0, 25";
        $stmt = $conn->prepare($sql);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    $designers = $result->fetch_all(MYSQLI_ASSOC);
    
    $stmt->close();
    return $designers;
}

// Retrieve selected category from POST request, if applicable
$selectedCategory = isset($_POST['downMenue']) ? $_POST['downMenue'] : null;
// Fetch designers based on the selected category or fetch all if no category is selected
$designers = fetchDesigners($selectedCategory);



/////consultaion table
function fetchConsultationRequests($clientId) {
    global $conn;
    $sql = "SELECT 
                dcr.id, d.brandName, d.logoImgFileName, rt.type AS roomType, 
                CONCAT(dcr.roomWidth, 'x', dcr.roomLength) AS dimensions, 
                dc.category, dcr.colorPreferences, dcr.date, 
                rs.status, dcns.consultation, dcns.consultationImgFileName
            FROM 
                DesignConsultationRequest dcr
                JOIN Designer d ON dcr.designerID = d.id
                JOIN RoomType rt ON dcr.roomTypeID = rt.id
                JOIN DesignCategory dc ON dcr.designCategoryID = dc.id
                JOIN RequestStatus rs ON dcr.statusID = rs.id
                LEFT JOIN DesignConsultation dcns ON dcr.id = dcns.requestID
            WHERE 
                dcr.clientID = ?
            ORDER BY 
                dcr.date DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $clientId);
    $stmt->execute();
    $result = $stmt->get_result();
    $requests = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $requests;
}

$consultationRequests = fetchConsultationRequests($clientId);

//clinet info 
$sql = "SELECT * FROM client WHERE `id`=".$clientId; 
               $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);

?>



<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Clinet homepage</title>
        <link rel="stylesheet" href="Clinet.css">
        <link rel="stylesheet" href="basics.css">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="Clinet.js"></script>
    </head>

    <body>
        <header id="Home-header">

            <div class="logo-title">
    
                <img src="image/logo.jpeg" alt="design mate Logo" id="logo">
    
                <span></span>
    
            </div>
        </header>
        <!--***********************************************************************-->

         <!--welcome messsage &user info-->
        <section id="userInfoSection">
                <div id="welcome">
                        <h3 class="name"> Welcome :<?php echo $row['firstName']?></h3>
                       <a href="signout.php" >Sign out</a>
                </div>

                <div id="userInfoBox">
                      <ul >
                        <li>Client Name:<span> <?php echo getClientNameById($row['id'], $conn)?></span></li>
                        <li>Email Address:<span> <?php echo $row['emailAddress']?></span></li>
                    </ul>
                </div>
        </section>
        <!--************************************************************************-->
        <!-- interior design table part -->
        <section id="interiordesignPart">

            <div id="tableHeadr-1">
                <h2>Interior design </h2>
                <form  action="Clinet.php" method="post">
                <div id="interiorFilter">
                        <label for="drop-downMenue">Select Category: </label>
                        <select name="downMenue" id="drop-downMenue">
                            <option value="Modern">Modern</option>
                            <option value="Country">Country</option>
                            <option value="Coastal">Coastal</option>
                            <option value="Bohemian">Bohemian</option>
                        </select>
                        <button type="submit" id="Filter" name='Filter' >Filter</button>
                </div>
                </form>
            </div>
        <!--************************************************************************-->
            <table class="table1">
               
                <!--row 1 (table header)-->
                <thead class="table1">

                <tr>
                    <th  >Designer</th>
                    <th >Specialty</th>
                </tr>
                </thead>
               <!--row 2(data)-->
               <tr>
                 <?php foreach ($designers as $designer): ?>
             <tr>
            <td>
                <a href="OneDesigner.php?designerId=<?php echo $designer['id'];?>">
                    <img src="<?php echo "uploads/".$designer['logoImgFileName']; ?>" alt="Logo">
                    <?php echo "<br>".$designer['brandName'];  ?>
                </a>
            </td>
            <td><?php echo $designer['specialties']; ?></td>
            <td><a href="RequestDesignConsultation.php?designerId=<?php echo $designer['id']; ?>">Request Design Consultation</a></td>
        </tr>
        <?php endforeach; ?>
              </tr>
              
            
          
            </table>
     
  <?php if (empty($consultationRequests)): ?>
    <section id="ConsultaionPart">
        <h2>Previous Design Consultation Requests</h2>
        <strong style='font-size: 40px; color:#801e00; padding: 20px;'>No previous design consultation requests found.</strong>
    </section>
<?php else: ?>
    <?php foreach ($consultationRequests as $request): ?>
        <section id="ConsultaionPart">
            <h2>Previous Design Consultation Requests</h2>
            <table class="Table2">
                <thead>
                    <tr>
                        <th>Designer</th>
                        <th>Room</th>
                        <th>Dimensions</th>
                        <th>Design Category</th>
                        <th>Color Preferences</th>
                        <th>Request Date</th>
                        <th>Request Status</th>
                        <th>Consultation</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <img src="<?php echo "uploads/" . $request['logoImgFileName']; ?>" alt="[Logo]">
                            <br>
                            <?php echo htmlspecialchars($request['brandName']); ?>
                        </td>
                        <td><?php echo htmlspecialchars($request['roomType']); ?></td>
                        <td><?php echo htmlspecialchars($request['dimensions']); ?></td>
                        <td><?php echo htmlspecialchars($request['category']); ?></td>
                        <td><?php echo htmlspecialchars($request['colorPreferences']); ?></td>
                        <td><?php echo htmlspecialchars($request['date']); ?></td>
                        <td><?php echo htmlspecialchars($request['status']); ?></td>
                        <td>
                            <?php if ($request['status'] === 'consultation provided' && !empty($request['consultation'])): ?>
                                <?php if (!empty($request['consultationImgFileName'])): ?>
                                    <img src="<?php echo "uploads/" . $request['consultationImgFileName']; ?>" alt="[image:Consultation Image]">
                                <?php endif; ?>
                                <div><?php echo htmlspecialchars($request['consultation']); ?></div>
                            <?php else: ?>
                                No consultation provided or not approved yet.
                            <?php endif; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    <?php endforeach; ?>
<?php endif; ?>


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
