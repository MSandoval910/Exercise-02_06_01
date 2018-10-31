<!doctype html>

<html>
	<head>
		<title>Guest Book</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0">
		<script src="modernizr.custom.65897.js"></script>
	</head>

	<body>
   <style>
           body {
               background: rgb(71, 122, 204);
           }
       h1,h2,h3,h4,h5,h6 {
           color: aliceblue;
           
       }
        
        </style>
    <!-- HTML Form  -->
       <h1>Guest Book</h1>
        <?php
             if (isset($_GET['action'])) {
          if (file_exists("Guests.txt") && filesize("Guests.txt") != 0) {
                $guestsArray = file("Guests.txt");
              switch ($_GET['action']) {
                  case 'Delete First':
                      array_shift($guestsArray);
                      break;
                  case 'Delete Last':
                      array_pop($guestsArray);
                      break;
                       case 'Sort Ascending':
                        sort($guestsArray);
                      break;
                      case 'Sort Decending':
                        rsort($guestsArray);
                      break;
                  case 'Delete Message':
                      array_splice($guestsArray, $_GET['message'],1);
                      $index = $_GET['message'];
                      unset($guestsArray[$index]);
                      break;
                      
                      case 'Remove Duplicates':
                      $guestsArray = array_unique($guestsArray);
                      $guestsArray = array_values($guestsArray);
                      break;
              }
              if (count($guestsArray) > 0) {
                  $newMessages = implode($guestsArray);
                  $fileHandle = fopen("Guests.txt", "wb");
                  if (!$fileHandle) {
                    echo "There was an error updating the message file.";
                  }
                  else {
                      fwrite($fileHandle, $newMessages);
                      fclose($fileHandle);
                  }
              }
              else {
               unlink("Guests.txt");   
                }
            }  
        } 
        if (!file_exists("Guests.txt") || filesize("Guests.txt") == 0) {
            echo "<p>There are no Guests listed.</p>\n";
        }
        else {
            $guestsArray = file("Guests.txt");
            echo "<table style=\"background-color: lightgray\"border=\"1\"width=\"100%\">\n";
            $count = count($guestsArray);
            for ($i = 0; $i < $count; $i++) {
                $currMsg = explode("-", $guestsArray[$i]);
                $keyMessageArray[$currMsg[0]] = $currMsg[1] . "-" . $currMsg[2];
            }
            $index = 1;
            $key = key($keyMessageArray);
            foreach ($keyMessageArray as $message) {
                $currMsg = explode("-", $message);
                echo "<tr>\n";
                echo "<td width=\"5%\" style=\"text-align: center; font-weight: bold\">" . $index . "</td>\n";
                echo "<td width=\"95%\"><span style=\"font-weight: bold\">Name: </span>" . htmlentities($key) . "<br>\n";
                echo "<span style=\"font-weight: bold\">E-Mail:</span>" . htmlentities($currMsg[0]) . "<br>\n";
                echo "<span style=\"text-decoration: none; font-weight: bold\">Message:</span><br>\n" . htmlentities($currMsg[1]) . "</td>\n";
                echo "<td width=\"10%\" style=\"text-align: center\">" . "<a href='GuestBook.php?" . "action=Delete%20Message&" . "message=" . ($index - 1) . "'>" . "Delete This Message</a></td>\n";
                echo "</tr>\n";
                ++$index;
                next($keyMessageArray);
                $key = key($keyMessageArray);
            }
            echo "</table>";
        }
        ?>
        <p>
            <a style="text-decoration: none; color: white;" href="PostGuest.php">Guests New Post Message</a><br>
            <a style="text-decoration: none; color: white;" href="GuestBook.php">Sort Subjects A-Z</a><br>
            <a style="text-decoration: none; color: white;" href="GuestBook.php?action=Sort%20Decending">Sort Subjects Z-A</a><br>
            <a style="text-decoration: none; color: white;" href="GuestBook.php?action=Delete%20First">Delete First Message</a><br>
            <a style="text-decoration: none; color: white;" href="GuestBook.php?action=Delete%20First">Delete Last Message</a><br>
<!--            <a href="MessageBoard.php?action=Remove%20Duplicates">Remove Duplicates</a><br>-->
        </p>
	</body>
</html>