<!doctype html>

<html>
	<head>
		<title>Post Guest</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0">
		<script src="modernizr.custom.65897.js"></script>
	</head>

	<body>
       <style>
           form {
                border-radius: 25px;
                background: rgb(224, 186, 53);
                padding: 20px; 
                width: 900px;
                height: 150px; 
           }
           textarea {
               border-radius: 10px;
           }
           
           body {
               background: rgb(71, 122, 204);
           }
        
        </style>
        <?php
        
        ?>
        <!-- HTML form -->
        <h1 style="color: white;">Order Form</h1>
        <hr>
        <form action="PostOrders.php" method="post">
           <span style="font-weight: bold">Name: <input type="text" name="name" placeholder="Name"></span>
            <span style="font-weight: bold">E-mail: <input type="text" name="email"></span><br>
            <textarea name="message" rows="6" cols="80" style="margin: 10px 15px 15px"></textarea><br>
            <input type="reset" name="reset" value="Reset Form">
            <input type="submit" name="submit" value="Post Message">
        </form>
        <hr>

        <p>
            <a style="color:white;" href="GuestBook.php">View Orders</a>
        </p>

	</body>
</html>