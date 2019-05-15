<html>
 <head>
  <title>Практика</title>
  <link href="css.css" rel="stylesheet" type="text/css">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta charset="utf-8">
  <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=4ff996ce-302c-43f5-9678-d88c5c3024f7" type="text/javascript"></script>
  <script src="js.js" type="text/javascript"></script>
 </head>
 <body>
  <div class="container">
   <div class="header">Визуализация маршрута</div>
   <div class="sidebar">
	<p><input v-model="Id" placeholder=" Введите Id"></p>

	<button v-on:click="Button">Отрисовать</button>
    <!--<p><a href="#">Отрисовать</a></p>-->
   </div>
   <div class="content">
   <!-- <h2>Визуализация маршрута</h2>-->

<div id="map"></div>


    <?php
    $servername = "localhost";
    $username = "user";
    $password = "Minecraft14";
    $dbname = "map_data";

    // Create connection
    try {
        $conn = new PDO("mysql:host=localhost;port=22; dbname=map_data", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully"; 
        }
    catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();
        }

        $insertId=$conn->lastInsertId();
        echo '<br>',$insertId;


/*


    $sql = "SELECT * FROM data;";
   
    $result = $conn->query("SELECT mtm_id FROM data;");

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<br> id: ". $row['mtm_id'].  "<br>";
        }
    } else {
        echo "<br>0 results";
    }
*/
    $conn->close();
    ?>
</body>
</html>