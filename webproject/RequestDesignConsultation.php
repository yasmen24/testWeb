
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Design Consultation</title>
     <link rel="stylesheet" href="Request design consultation.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="basics.css">
           <style>
      
.error {
    color: white;
    font-size: 14px;
    margin-top: 5px;
    text-align: center;
    background-color: #d96565c2; /* Corrected color code */
    padding: 10px; /* Adding padding for better visibility */
    width: 50%;
    margin: 0 auto; /* Center horizontally */
    display: block; /* Ensure it takes up the specified width */
}
   </style>
</head>

  <header id="Home-header">

            <div class="logo-title">
    
                <img src="image/logo.jpeg" alt="design mate Logo" id="logo">
    
                <span></span>
    
            </div>
        </header>

<body>
    <h2>Request Design Consultation</h2>
    
    <!-- Display form errors if any -->
    <?php
    session_start();

    if (isset($_SESSION['form_errors']) && !empty($_SESSION['form_errors'])) {
        echo '<div class="error">';
        foreach ($_SESSION['form_errors'] as $error) {
            echo $error . '<br>';
        }
        echo '</div>';
        unset($_SESSION['form_errors']); // Clear session errors
    }
    ?>
    
    <form id="consultationForm" action="addRequest.php" method="POST">
        <!-- Your form fields -->
        <?php 
            if(isset($_GET['designerId'])) {
                $designerId = $_GET['designerId'];
                echo "<input type='hidden' name='designerID' value='".$designerId."'>"; // hidden designerID variable 
            } 
            else {
//                echo "Designer ID is not available!";
            }
        ?>
        <label for="roomType">Room Type:</label>
        <select id="roomType" name="roomType">
            <option value="Living Room" selected>Living Room</option>
            <option value="bedroom">Bedroom</option>
            <option value="kitchen">Kitchen</option>
            <option value="Dining Room">Dining Room</option>
        </select><br>

        <label for="width">Room Width (meters):</label>
        <input type="text" id="width" name="width" placeholder="Enter width" required><br>

        <label for="length">Room Length (meters):</label>
        <input type="text" id="length" name="length" placeholder="Enter length" required><br>

        <label for="designCategory">Design Category:</label>
        <select id="designCategory" name="designCategory">
               <option value="Minimalist" >Minimalist</option>
                <option value="Modern" selected >Modern</option>
                <option value="Country" >Country</option>
                <option value="Coastal" >Coastal</option>
                <option value="Bohemian">Bohemian</option>                  
        </select><br>
        <label for="colorPreferences">Color Preferences:</label>
        <input type="text" id="colorPreferences" name="colorPreferences" placeholder="Enter color preferences"><br>
        <input type="submit" id="btn" value="Submit" >
    </form>
    <footer id="Home-footer">
        
              
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

























<!--<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Request Design Consultation</title>
        <link rel="stylesheet" href="Request design consultation.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="basics.css">
    </head>
    <body>
        <header id="Home-header">
            <div class="logo-title">
                <img src="image/logo.jpeg" alt="design mate Logo" id="logo">
                <span></span>
            </div>
        </header>
        
        <h2>Request Design Consultation</h2>

        
         PHP code to display validation errors if any 
    <?php
    // Check if there are any form validation errors stored in the session
//    if (isset($_SESSION['form_errors']) && !empty($_SESSION['form_errors'])) {
//        echo '<div style="color: red;">';
//        foreach ($_SESSION['form_errors'] as $error) {
//            echo $error . '<br>';
//        }
//        echo '</div>';
//        // Clear the session variable after displaying errors
//        unset($_SESSION['form_errors']);
//    }
    ?>
        <form id="consultationForm" action="addRequest.php" method="POST">

             Getting the designerId from Clinet.php to insert into designconsultationrequest so that the request is sent to the designer who the designerID belongs to 
        <?php 
//            if(isset($_GET['designerId'])) {
//                $designerId = $_GET['designerId'];
//                echo "<input type='hidden' name='designerID' value='".$designerId."'>"; // hidden designerID variable 
//            } 
//            else {
//                echo "Designer ID is not available!";}
        ?>
            
        <label for="roomType">Room Type:</label>
        <select id="roomType" name="roomType">
            <option value="livingRoom">Living Room</option>
            <option value="bedroom">Bedroom</option>
            <option value="kitchen">Kitchen</option>
            <option value="Dining Room">Dining Room</option>

             Add more room types as needed 
        </select><br>

        <label for="width">Room Width (meters):</label>
        <input type="text" id="width" name="width" placeholder="Enter width" required><br>

        <label for="length">Room Length (meters):</label>
        <input type="text" id="length" name="length" placeholder="Enter length" required><br>

        <label for="designCategory">Design Category:</label>
        <select id="designCategory" name="designCategory">
               <option value="Minimalist" >Minimalist</option>
                <option value="Modern" >Modern</option>
                <option value="Country" >Country</option>
                <option value="Coastal" >Coastal</option>
                <option value="Bohemian">Bohemian</option>                  
        </select><br>
        <label for="colorPreferences">Color Preferences:</label>
        <input type="text" id="colorPreferences" name="colorPreferences" placeholder="Enter color preferences"><br>
        <input type="submit" id="btn" value="Submit" >
        </form>
        
         Getting clientID to insert into the database table designerconsultationrequest for the designer to send the consultation to the appropriate client 
        <?php 
//            if(isset($_GET['clientId'])) {
//                $clientId = $_GET['clientId'];} 
//            else {
//                echo "Client ID is not available!";}
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
</html>-->