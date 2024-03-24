<?php
session_start();

// Include database connection
include 'DB.php';

// Function to verify hashed passwords
function verifyPassword($password, $hashedPassword) {
    return password_verify($password, $hashedPassword);
}

// Function to redirect to homepage based on user type
function redirectToHomepage($userType) {
    if ($userType === 'designer') {
        header('Location: DesignerHomepage.php');
    } elseif ($userType === 'client') {
        header('Location: clinet.php');
    }
    exit();
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userType = $_POST['userType'];

    // Query database to retrieve user information
    if ($userType === 'designer') {
        $stmt = $conn->prepare('SELECT id, password FROM designer WHERE emailAddress = ?');
    } elseif ($userType === 'client') {
        $stmt = $conn->prepare('SELECT id, password FROM client WHERE emailAddress = ?');
    }

    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        // Verify password
        if (verifyPassword($password, $hashedPassword)) {
            // Password is correct, set session variables and redirect to homepage
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_type'] = $userType;
            redirectToHomepage("clinet");
        } else {
            // Incorrect password
            $_SESSION['login_error'] = 'Incorrect email or password.';
            header('Location: login.php');
            exit();
        }
    } else {
        // User not found
        $_SESSION['login_error'] = 'User not found.';
        header('Location: login.php');
        exit();
    }
}
?>
