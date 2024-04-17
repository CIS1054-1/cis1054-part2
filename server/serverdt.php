<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date Time</title>
    <link rel="stylesheet" href="../style/main.css">
</head>
<body>
    <main>
        <div class="text-box">
            <?php
/**
* This fuction return the current date and time
*
* @author Carlos Alvarez & Gioele Giunta
* @version 1.0
* @since 2023-04-12
*/

date_default_timezone_get();
$date = strtoupper(date('m/d/y h:i:s a T', time()));
echo "<h1>" . $date . "</h1>";
?> 
<p>(Current date and time)</p>
        </div>
        <img src="../img/clock.png">
    </main>
    <footer>
        <p>&copy; 2024 Gioele Giunta & Carlos Alvarez</p>
    </footer>
</body>
</html>
