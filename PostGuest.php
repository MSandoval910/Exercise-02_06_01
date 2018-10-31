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
           input, textarea {
               border-radius: 10px;
           }
           body {
               background: rgb(71, 122, 204);
           }
        
        </style>
        <?php
        // entry point
        // data submited? Yes - process, No - display form
        if (isset($_POST['submit'])) {
            $name = stripslashes($_POST['name']);
            $email = stripslashes($_POST['email']);
            $message = stripslashes($_POST['message']);
            $name = str_replace("-", "-", $name);
            $email = str_replace("-", "-", $email);
            $message= str_replace("-", "-", $message);
            $existingNames = array();
            if (file_exists("Guests.txt") && filesize("Guests.txt") > 0) {
                $messageArray = file("Guests.txt");
                $count = count($messageArray);
                for ($i = 0; $i < $count; $i++) {
                    $currMsg = explode("-", $messageArray[$i]);
                    $existingNames[] = $currMsg[0];
                }
               
            }
            if (in_array($name, $existingNames)) {
                echo "<p>The name <em>\"$name\"</em> you entered already exists!<br>\n";
                echo "Please enter a new subject and try again.<br>\n";
                echo "Your message was not saved.</p>";
                $name = "";
            }
            else {
            $messageRecord = "$name-$email-$message\n";
            $fileHandle = fopen("Guests.txt", "ab");
            if (!$fileHandle) {
                echo "there was an error saving your message!\n";
            }
            else {
                fwrite($fileHandle, $messageRecord)
;                fclose($fileHandle);
                echo "Your message has been saved.\n";
                $name = "";
                $message = "";
            }
        }
    }
        else {
            $name = "";
            $email = "";
            $message = "";
        }
        ?>
        <!-- HTML form -->
        <h1 style="color: white;">Post Guest Message</h1>
        <hr>
        <form action="PostGuest.php" method="post">
           <span style="font-weight: bold;">Name: <input style="text-align: center;" type="text" name="name" placeholder="Name" value="<?php echo $name; ?>"></span>
            <span style="font-weight: bold">E-mail: <input style="text-align: center;" type="text" name="email" placeholder="E-Mail" value="<?php echo $email; ?>"></span><br>
            <textarea style="text-align: center;" name="message" rows="6" cols="80" style="margin: 15px 5px 5px" placeholder="Submit a Message"><?php echo $message; ?></textarea><br>
            <input type="reset" name="reset" value="Reset Form">
            <input type="submit" name="submit" value="Post Message">
        </form>
        <hr>

        <p>
            <a style="color: white; text-decoration: none;" href="GuestBook.php">View Messages</a>
        </p>

	</body>
</html>