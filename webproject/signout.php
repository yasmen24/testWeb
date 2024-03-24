<?php
// Start the session
session_start();

// If designer ID is set in session, unset it
if(isset($_SESSION['designerID'])) {
    unset($_SESSION['designerID']);
}

// Destroy the session
session_destroy();

// Redirect to the home page
header("Location: index.php");
exit;
?>
