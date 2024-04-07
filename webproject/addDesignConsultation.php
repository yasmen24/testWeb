
<?php
    session_start();
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Include necessary files and database connection
        include_once 'DB.php';
        include_once 'fileUpload.php';

        // Check if the requestID is set in the session
        if(isset($_SESSION['requestID'])) {
            // Get requestID from session
            $requestID = $_SESSION['requestID'];
            // Get form data
            $designDescription = $_POST['designDescription'];
            
            
//            $designImage=$_POST['designImage'];
            $image=uploadImage('designImage');
            echo $image;
            // You may want to handle file upload here and get the file path
            
            // Update request status in the database
            $updateStatusQuery = "UPDATE designconsultationrequest SET statusID = 5 WHERE id = $requestID";
            mysqli_query($conn, $updateStatusQuery);
            echo $requestID;
            // Insert new design consultation into the database
            // Assuming you have a table named 'designconsultation' with appropriate fields
                 $insertConsultationQuery = "INSERT INTO designconsultation (requestID, consultation,consultationImgFileName) VALUES ('$requestID', '$designDescription','$image')";

            mysqli_query($conn, $insertConsultationQuery);
            
            //Redirect to designer's homepage
         header("Location: DesignerHomepage.php");
          exit;
        } else {
            // If requestID is not set in session, redirect back to the consultation page
//            header("Location: consultation_page.php");
//            exit;
        }
    } else {
        // If the form is not submitted, redirect back to the consultation page
//        header("Location: consultation_page.php");
//       exit;
    }
?>

