<?php
session_start();

// Include database connection
include 'DB.php';
// here i have to include the photos file

// Function to hash passwords
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Function to redirect to homepage based on user type
function redirectToHomepage($userType) {
    if ($userType === 'client') {
        header('Location: Clinet.php');
    } elseif ($userType === 'designer') {
        header('Location: DesignerHomepage.php');
    }
    exit();
}

// Handle sign-up form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if form was submitted for a designer
    if (isset($_POST['designerSignup'])) {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $password = hashPassword($_POST['password']);
        $brandName = $_POST['brandName'];
        $selectedSpecialties = $_POST['specialities'];
        
       
       $uniqueImage= uploadImage('logo');
        if($uniqueImage !=false){
        
        // Check if email is unique
        $sql = "SELECT * FROM designer WHERE emailAddress='$email'";
        
        $result = mysqli_query($conn, $sql);
        
        while ($row = mysqli_fetch_assoc($result)){
            
            $_SESSION['signup_error'] = 'Email address already exists. Please use a different one.';
            header('Location: signup.php');
            exit();
        }
        // Insert designer into database
        $sql = "INSERT INTO designer (firstName, lastName, emailAddress, password, brandName,logoImgFileName) VALUES('$firstName','$lastName','$email','$password','$brandName','$uniqueImage')";
        
        if (mysqli_query($conn, $sql)) {

            // Get the inserted designer's ID
            $designerId = $conn->insert_id;

            // Insert selected specialties into designerspeciality table
            foreach ($selectedSpecialties as $specialtyId) {
               
                $stmt ="INSERT INTO designerspeciality (designerID, designCategoryID) VALUES ('$designerId', '$specialtyId')";
               
               mysqli_query($conn, $stmt);
                
            }
            
            
            // Store user type and ID in session variables
            $_SESSION['userType'] = 'designer';
            $_SESSION['id'] = $designerId;

            // Redirect to designer homepage
            redirectToHomepage('designer');
        } else {
            $_SESSION['signup_error'] = 'Error occurred. Please try again later.';
            header('Location: signup.php');
            exit();
        }
   
    }else{   $_SESSION['signup_error']="Sorry, there was an error uploading your file.";}
    }
    // Check if form was submitted for a client
    if (isset($_POST['clientSignup'])) {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $password = hashPassword($_POST['password']);
        
        // Check if email is unique
        $sql = "SELECT * FROM client WHERE emailAddress='$email'";
        $result = mysqli_query($conn, $sql);
        
        while($row= mysqli_fetch_assoc($result)){
            $_SESSION['signup_error'] = 'Email address already exists. Please use a different one.';
           
            header('Location: signup.php');
            exit();
        }
        // Insert client into database
        $stmt ="INSERT INTO client (firstName, lastName, emailAddress, password) VALUES ('$firstName','$lastName','$email','$password')";
        
        if (mysqli_query($conn, $stmt)){
            
            
            // Store user type and ID in session variables
            $_SESSION['userType'] = 'client';
            $_SESSION['id'] = $conn->insert_id;
            
            // Redirect to client homepage
            redirectToHomepage('client');
        } else {
            $_SESSION['signup_error'] = 'Error occurred. Please try again later.';
            header('Location: signup.php');
            exit();
        }
}}
    ///this function is give a unique names for file 
function uploadImage($fileInputName) {
        $target_dir = "uploads/"; // Directory where files will be stored
        $originalFilename = basename($_FILES[$fileInputName]["name"]);
        $imageFileType = strtolower(pathinfo($originalFilename, PATHINFO_EXTENSION));

        // Generate a unique ID for this image. For example, use the user ID or another relevant ID
        $uniqueId = uniqid(); 

        // Create a unique filename for the image
        $uniqueFilename = $uniqueId . '.' . $imageFileType;
        $target_file = $target_dir . $uniqueFilename;

        // Attempt to upload the file
        if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $target_file)) {
            return $uniqueFilename; // Return the unique filename
        } else {
            echo "Sorry, there was an error uploading your file.";
            $_SESSION['signup_error']="Sorry, there was an error uploading your file.";
            return false; // Return false if the upload failed
        }

    }
