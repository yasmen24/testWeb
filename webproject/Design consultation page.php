<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Design Consultation Page</title>
    <link rel="stylesheet" href="Design consultation page.css">
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

        <h2>Design Consultation</h2>
		

        <!-- Display Client's Request Information -->
        <div class="client-info">
		    <p id="name"><strong>Client :Sara Ahmeed</strong></p>
            <p id="roomT"><strong>Room Type :Bedroom</strong></p>
            <p id="room"><strong>Room Dimensions:4x5m</strong></p>
            <p id="designC"><strong>Design Category :Modern</strong></p>
            <p id="colorP"><strong>Color Preferences:white, gray</strong></p>
			<p id="Date"><strong>Date :7/2/2024</strong></p>
        </div>

        <hr>

        <!-- Designer's Consultation Form -->
        <form id="designerConsultationForm" action="#" method="post">

            <h2>Consultation</h2>

            <label for="designDescription">Design Consultation:</label>
            <textarea id="designDescription" name="designDescription" rows="4" placeholder="Enter your design consultation here..." required></textarea>

            <label for="designImage">Design Image:</label>
            <input type="file" id="designImage" name="designImage" accept="image/*" required>

            <button id="button"type="button"   class="btn">Send</button>

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
    <script src="Design consultation page.js"></script>

</body>
</html>