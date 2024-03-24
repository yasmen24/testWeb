
<!DOCTYPE html>


<html lang="en">
		<head>
			<meta charset="utf-8">
			<title> Project Addition </title>
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
			
				<div class="container">
					
					
					<h1>Add a new project</h1>
					
					<form class="form" action="addProject.php" method="post" enctype="multipart/form-data">

						
						
						<div class="text">
							<label for="projectname">Project name:</label>
							<input type="text" name="projectname" placeholder="Enter your project name">
						</div>
						
						<div class="file">
							<label for="image">image of the project:</label>
							<input type="file" id="image" name="image">
						</div>
					 
					 
					
						<div class="menu">
						  <label for="DesignCategory">Choose the Design Category:</label><br>
						  <select id="DesignSelect" name="DesignSelect" >
							 <?php
                                                         $connection = mysqli_connect("localhost", "root", "root", "webproject");

                                                                // Check connection
                                                                   if (mysqli_connect_errno()) {
                                                                     die("Connection failed: " . mysqli_connect_error());
                                                                    }

                                                                      $sql='SELECT * FROM designcategory';
                                                                      $result= mysqli_query($connection, $sql);
                                                                         while($row= mysqli_fetch_assoc($result))
                                                                          {
                                                                          echo "<option value=".$row['ID'].">".$row['category']."</option>"; }
                                                            ?>
						  </select>
						</div>
						
						<div class="textholder">
						  <label for="Descriptiontext">Description:</label><br>
						  <textarea placeholder="Description of the design..." cols="30" rows="5" name="Descriptiontext"></textarea>
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