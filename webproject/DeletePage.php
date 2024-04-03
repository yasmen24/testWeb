<?php

    // Enable error reporting and logging
    error_reporting(E_ALL);
    ini_set('log_errors', '1');
    ini_set('display_errors', '1');

    // Establish database connection
    $connection = mysqli_connect("localhost", "root", "root", "webproject", 3306);
    if(mysqli_connect_error()) {
        echo '<p>Sorry, cannot connect to the database.</p>';
        die(mysqli_connect_error());
    } else {
    // Check if project ID is provided in the URL
    if(isset($_GET['projectId'])) {
        // Get project ID from URL
        $projectId = $_GET['projectId'];

        // Construct SQL query to delete the project (ensure table name is correct)
        $sql = "DELETE FROM designportfolioproject WHERE id = ?";

        // Prepare the SQL statement
        $stmt = mysqli_prepare($connection, $sql);
        
        // Check if the statement is prepared successfully
        if($stmt) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "i", $projectId);

            // Execute the SQL query
            if(mysqli_stmt_execute($stmt)) {
                // Project deleted successfully, redirect to designer's homepage
                header("Location: DesignerHomepage.php");
                exit();
            } else {
                // Error occurred while executing the prepared statement
                echo "Error deleting project: " . mysqli_stmt_error($stmt);
            }

            // Close statement
            mysqli_stmt_close($stmt);
        } else {
            // Error occurred while preparing the statement
            echo "Error preparing statement: " . mysqli_error($connection);
        }
    } else {
        // Project ID not provided in URL
        echo "Project ID not specified.";
    }
}
?>
