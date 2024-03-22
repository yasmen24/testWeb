<?php
session_start();

// Include database connection
include 'DB.php';

// Function to hash passwords
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Function to redirect to homepage based on user type
function redirectToHomepage($userType) {
    if ($userType === 'designer') {
        header('Location: designer_home.php');
    } elseif ($userType === 'client') {
        header('Location: client_home.php');
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
        

        // Check if email is unique
        $stmt = $conn->prepare('SELECT COUNT(*) AS count FROM Designer WHERE emailAddress = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        if ($result['count'] > 0) {
            $_SESSION['signup_error'] = 'Email address already exists. Please use a different one.';
            header('Location: signup_page.php');
            exit();
        }

        // Insert designer into database
        $stmt = "INSERT INTO Designer (firstName, lastName, emailAddress, password, brandName) VALUES('$firstName','$lastName','$email','$password','$brandName') ";
        mysqli_query($conn, $stmt);

        // Store user type and ID in session variables
        $_SESSION['user_type'] = 'designer';
        $_SESSION['user_id'] = $stmt->insert_id;

        // Redirect to designer homepage
        redirectToHomepage('designer');
    }

    // Check if form was submitted for a client
    if (isset($_POST['clientSignup'])) {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $password = hashPassword($_POST['password']);
        // Other form fields...

        // Check if email is unique
        $stmt = $conn->prepare('SELECT COUNT(*) AS count FROM Client WHERE emailAddress = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        if ($result['count'] > 0) {
            $_SESSION['signup_error'] = 'Email address already exists. Please use a different one.';
            header('Location: signup_page.php');
            exit();
        }

        // Insert client into database
        $stmt = $conn->prepare('INSERT INTO Client (firstName, lastName, emailAddress, password) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('ssss', $firstName, $lastName, $email, $password);
        $stmt->execute();

        // Store user type and ID in session variables
        $_SESSION['user_type'] = 'client';
        $_SESSION['user_id'] = $stmt->insert_id;

        // Redirect to client homepage
        redirectToHomepage('client');
    }
}
?>
