<?php
session_start();

// Check if there is a login error message in the session
if (isset($_SESSION['project_error'])) {
    $project_error = $_SESSION['project_error'];
    // Clear the session variable to avoid displaying the same error message again
    unset($_SESSION['project_error']);
} else {
    $project_error = null; // Initialize the variable if there is no error message
}
?>
<!DOCTYPE html>
<html lang="en">
		<head>
			<meta charset="utf-8">
			<title> Project Addition </title>
                            <style>
      
.error {
    color: white;
    font-size: 14px;
    margin-top: 5px;
    text-align: center;
    background-color: #ff000052; /* Corrected color code */
    padding: 10px; /* Adding padding for better visibility */
    width: 50%;
    margin: 0 auto; /* Center horizontally */
    display: block; /* Ensure it takes up the specified width */
}
   </style>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="stylesheet" href="DesignerAdd.css">
			<link rel="stylesheet" href="basics.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		</head>
		
		<body>
			<header id="Home-header">

				<div class="logo-title">
		
					<img src="image/logo.jpeg" alt="design mate Logo" id="logo">
		
					<span></span>
		
				</div>
			</header>
			<?php if (!empty($project_error)): ?>
        <p class="error"><?php echo $project_error; ?></p>
    <?php endif; ?>
				<div class="container">
					
					
					<h1>Add a new project</h1>
					
					<form class="form" action="addProject.php" method="post" enctype="multipart/form-data">

						
						
						<div class="text">
							<label for="projectname">Project name:</label>
							<input type="text" name="projectname" placeholder="Enter your project name">
						</div>
						
						<div class="file">
							<label for="image">image of the project:</label>;
							<input type="file" id="image" name="file">
						</div>
					 
					 
					
						<div class="menu">
						  <label for="DesignCategory">Choose the Design Category:</label><br>
						  <select id="DesignSelect" name="category" >
							 <option name="category" value="">select category</option>
            <option name="category" value="modern">modern</option>
            <option name="category" value="country">country</option>
            <option name="category" value="Coastal">Coastal</option>
            <option name="category" value="Bohemian">Bohemian</option>

						  </select>
						</div>
						
						<div class="textholder">
						  <label for="Descriptiontext">Description:</label><br>
                                                  <textarea placeholder="Description of the design..." cols="30" rows="5" name="Descriptiontext" required></textarea>
						</div>
						
						
						<input type="submit" id="btn" name="btn" value="Submit" />

						
						
				    </form>

				</div>
                  
				
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
				<script src="ProjectAdditionPage.js"></script>
	  
		</body>
</html>