<?php
include "header.php";

/* DB CONNECT — pas aan naar jouw setup */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Settings
// host, user and password settings
$host = "localhost";
$user = "logger";
$password = "paswoord";
$database = "temperatures";

//Tot hoeveel uur terug wil je de data tonen wanneer dit php opgevraagd wordt va                                                                                                                                                             nuit browser
$hours = 24;

// make connection to database
$connectdb = mysqli_connect($host,$user,$password)
or die ("Cannot reach database");

// select db
mysqli_select_db($connectdb,$database)
or die ("Cannot select database");

// sql command that selects all entires from current time and X hours backwards
$sql="SELECT * FROM temperaturedata WHERE dateandtime >= (NOW() - INTERVAL $hour                                                                                                                                                             s HOUR) order by dateandtime desc";

//NOTE: If you want to show all entries from current date in web page uncomment                                                                                                                                                              line below by removing //
//$sql="select * from temperaturedata where date(dateandtime) = curdate();";

// set query to variable
$temperatures = mysqli_query($connectdb,$sql);

// create content to web page
?>

<html>
<head>
        <title>Klastemperatuur van Raspi25</title>
</head>
<body>

  <h3>Temperatuur en vochtigheid - data </h3>
    <br>
        <table width="800" border="1" cellpadding="1" cellspacing="1" align="cen                                                                                                                                                             ter">
                        <tr>
                        <th>Datum</th>
                        <th>Sensor</th>
                        <th>Temperatuur</th>
                        <th>Vochtigheid</th>
                        <tr>

                        <?php
                                // loop all the results that were read from data                                                                                                                                                             base and "draw" to web page
                                while($temperature=mysqli_fetch_assoc($temperatu                                                                                                                                                             res)){
                                echo "<tr>";
                                echo "<td>".$temperature['dateandtime']."</td>";
                                echo "<td>".$temperature['sensor']."</td>";
                                echo "<td>".$temperature['temperature']."</td>";
                                echo "<td>".$temperature['humidity']."</td>";
                                echo "<tr>";
                                }
                        ?>
                </table>

</body>
</html>
