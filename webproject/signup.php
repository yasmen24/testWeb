<?php
session_start();

// Check if there is a login error message in the session
if (isset($_SESSION['signup_error'])) {
    $signup_error = $_SESSION['signup_error'];
    // Clear the session variable to avoid displaying the same error message again
    unset($_SESSION['signup_error']);
} else {
    $signup_error = null; // Initialize the variable if there is no error message
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="basics.css">
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script>
    <title>DesignConnect - Sign Up</title>
</head>
<body>

    <div id="container">
        <!-- Header -->
        <header id="Home-header">
            <div class="logo-title">
                <img src="image/logo.jpeg" alt="design mate Logo" id="logo">
                <span></span>
            </div>
            <div class="navbar">
            </div>
        </header>

        <!-- Display login error message if it exists -->
    <?php if (!empty($signup_error)): ?>
        <p><?php echo $signup_error; ?></p>
    <?php endif; ?>
        
        
        <div class="signup-page">
            <h2>Create an Account</h2>
            <p>Select your user type:</p>
            <input type="radio" name="userType" value="designer" id="designerRadio">
            <label for="designerRadio">Designer</label>
            <input type="radio" name="userType" value="client" id="clientRadio">
            <label for="clientRadio">Client</label>

            <div id="designerForm" class="user-form">
                <!-- Designer form elements -->
               <form action="signhandler.php" method="POST" enctype="multipart/form-data" id="designerSignUpForm">
                    <label for="firstName">First Name:</label>
                    <input type="text" id="firstName" name="firstName" required>

                    <label for="lastName">Last Name:</label>
                    <input type="text" id="lastName" name="lastName" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>

                    <label for="brandName">Brand Name:</label>
                    <input type="text" id="brandName" name="brandName" required>

                    <label for="logo">Logo:</label>
                    <input type="file" id="logo" name="logo" accept="image/*" required>

                    <label for="specialities">Specialities:</label>
                    <input type="checkbox" id="modern" name="specialities[]" value="modern">
                    <label for="modern">Modern</label>
                    <input type="checkbox" id="country" name="specialities[]" value="country">
                    <label for="country">Country</label>
                    <!-- Add more checkboxes for other specialities -->

                    <input type="submit" name="designerSignup" value="Sign Up">
                </form>
            </div>

            <div id="clientForm" class="user-form" style="display:none;">
                <!-- Client form elements -->
                <form action="signhandler.php" method="POST" id="clientSignUpForm">
                    <label for="firstName">First Name:</label>
                    <input type="text" id="firstName" name="firstName" required>

                    <label for="lastName">Last Name:</label>
                    <input type="text" id="lastName" name="lastName" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>

                    <input type="submit" name="clientSignup" value="Sign Up">
                </form>
            </div>
        </div>

        <!-- Footer -->
        <footer id="Home-footer">
            <!-- Multimedia -->
            <div class="multimedia" >
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
    </div>

</body>
</html>
