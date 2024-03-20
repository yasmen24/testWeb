<!DOCTYPE html>
<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title> Designer Homepage </title>
			<link rel="stylesheet" href="Designer.css">
			<link rel="stylesheet" href="basics.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
			<script src="Designerjs.js"></script>
		</head>
		
		<body>
			<header id="Home-header">

				<div class="logo-title">
		
					<img src="image/logo.jpeg" alt="design mate Logo" id="logo">
		
					<span></span>
		
				</div>
			</header>

			<section id="userInfo">
				<div id="tableHeadr-1">
					<h3 id="welcomeText">Welcome Ahmad</h3>
					<a href="index.php" id="logout">Log-out</a>
				</div>


				<div id="designerInfo">
					<ul >
                        <li>First Name:<span> Ahmad</span></li>
                        <li>Last Name:<span> Hassan</span></li>
                        <li>Email Address:<span> Ahmadhassan2@gmail.com</span></li>
                    </ul>
				</div>
			
			</section>
		<section id="2tables">
			<section id="table1">
				<div id="tableHeadr-2">
					<h1>Design Portfolio</h1>
					<a href="ProjectAdditionPage.php" id="logout">Add New Project</a>
				</div>
			
			
				<table class="table1">
				<thead>
					<tr>
						<th>Project Name</th>
						<th>Image</th>
						<th>Design Category</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody>	
					<tr>
						<td>bedroom</td>
						<td><img src="image/bedroom.jpg" alt="Minimalist bedroom"></td>
						<td>Minimalist</td>
						<td class="des">A simple bedroom with clean lines, highlighted by a white bed.</td>
						<td><a href="UpdatePage.php">Edit</a></td>
						<td><a href="">Delete</a></td>
					</tr>
					
					<tr>
						<td>living room</td>
						<td><img src="image/livingroom.jpg" alt="Modern living room"></td>
						<td>Modern</td>
						<td class="des">A modern living room features sleek design,and a neutral color palette.</td>
						<td><a href="UpdatePage.php">Edit</a></td>
						<td><a href="">Delete</a></td>
					</tr>
				</tbody>
				</table>
			</section>
			
			<section id="table2">
			<h1>Design Consultation Requests</h1>
			
			<table class="table2">
			<thead>
				<tr>
					<th>Client</th>
					<th>Room</th>
					<th>Dimensions</th>
					<th>Design Category</th>
					<th>Color Preferences</th>
					<th>Date</th>
				</tr>
			</thead>	
				<tbody>
				<tr>
					<td>Noura Ali</td>
					<td>Dining Room</td>
					<td>3x5m</td>
					<td>classic</td>
					<td>brown and beige</td>
					<td>1/1/2024</td>
					<td><a href="Design consultation page.php">Provide Consultation</a></td>
					<td><a href="">Decline Consultation</a></td>
				</tr>
				
				<tr>
					<td>Sara Ibrahim</td>
					<td>Home Office</td>
					<td>3x4m</td>
					<td>Modern</td>
					<td>black and white</td>
					<td>12/1/2024</td>
					<td><a href="Design consultation page.php">Provide Consultation</a></td>
					<td><a href="">Decline Consultation</a></td>
				</tr>
				</tbody>
			</table>
			</section>
		</section>	
			
			<footer id="Home-footer">

				<!--try11 Multimedia -->
		
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
		</body>
</html>
