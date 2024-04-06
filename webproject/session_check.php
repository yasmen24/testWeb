<?php

session_start();

// Check if the user is not logged in
if (!isset($_SESSION['id'])) { 
    header('Location: login.php'); // Redirect to the login page
    exit();
}

// Check if the user type is not set or is invalid
if (!isset($_SESSION['userType']) || ($_SESSION['userType'] !== 'designer' && $_SESSION['userType'] !== 'client')) {
    header('Location: index.php'); // Redirect to the home page
    exit();
}

// If the user is a designer, but trying to access the client page, or vice versa, redirect to the appropriate homepage
if ($_SESSION['userType'] === 'designer' && basename($_SERVER['PHP_SELF']) !== 'DesignerHomepage.php') {
    header('Location: DesignerHomepage.php'); // Redirect to the designer homepage
    exit();
} elseif ($_SESSION['userType'] === 'client' && basename($_SERVER['PHP_SELF']) !== 'Clinet.php') {
    header('Location: Clinet.php'); // Redirect to the client homepage
    exit();
}
?>
