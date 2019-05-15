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

            if(isset($_POST['subject'])){
                $iddb = $_POST['subject'];
                $stmt = $conn->query('select h_lat, h_lon, w_lat, w_lon from data where mtm_id = '. $iddb .' ;');
                
                foreach ($stmt as $row)
                {
                    $h_lat=$row['h_lat'];
                    $h_lon=$row['h_lon'];
                    $w_lat=$row['w_lat'];
                    $w_lon=$row['w_lon'];
                    echo "\n" .$h_lat;
                    echo "\n" .$h_lon;
                    echo "\n" .$w_lat;
                    echo "\n" .$w_lon. "\n";
                    
                   /* echo "\n" .$row['h_lat'] . "\n";
                    echo "\n" .$row['h_lon'] . "\n";
                    echo "\n" .$row['w_lat'] . "\n";
                    echo "\n" .$row['w_lon'] . "\n";*/
                }
            }
              
           
        /*$conn->close();*/
        
        ?>

<html>
    <head>
        <title>Практика</title>
        <link href="css.css" rel="stylesheet" type="text/css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta charset="utf-8">
        <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=4ff996ce-302c-43f5-9678-d88c5c3024f7" type="text/javascript"></script>
        <script>
                            function init () {
                        /**
                         * Создаем мультимаршрут.
                         * Первым аргументом передаем модель либо объект описания модели.
                         * Вторым аргументом передаем опции отображения мультимаршрута.
                         * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/multiRouter.MultiRoute.xml
                         * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/multiRouter.MultiRouteModel.xml
                         */
                        var hlat = "<?php echo $h_lat;?>";
                        var hlon = "<?php echo $h_lon;?>";
                        var wlat = "<?php echo $w_lat;?>";
                        var wlon = "<?php echo $w_lon;?>";
                        var multiRoute = new ymaps.multiRouter.MultiRoute({
                            // Описание опорных точек мультимаршрута.
                            referencePoints: [
                                [hlat, hlon],
                                [wlat, wlon]
                            ],
                            // Параметры маршрутизации.
                            params: {
                                // Ограничение на максимальное количество маршрутов, возвращаемое маршрутизатором.
                                results: 2
                            }
                        }, {
                            // Автоматически устанавливать границы карты так, чтобы маршрут был виден целиком.
                            boundsAutoApply: true
                        });

                        // Создаем кнопки для управления мультимаршрутом.
                        var trafficButton = new ymaps.control.Button({
                                data: { content: "Учитывать пробки" },
                                options: { selectOnClick: true }
                            }),
                            viaPointButton = new ymaps.control.Button({
                                data: { content: "Добавить транзитную точку" },
                                options: { selectOnClick: true }
                            });

                        // Объявляем обработчики для кнопок.
                        trafficButton.events.add('select', function () {
                            /**
                             * Задаем параметры маршрутизации для модели мультимаршрута.
                             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/multiRouter.MultiRouteModel.xml#setParams
                             */
                            multiRoute.model.setParams({ avoidTrafficJams: true }, true);
                        });

                        trafficButton.events.add('deselect', function () {
                            multiRoute.model.setParams({ avoidTrafficJams: false }, true);
                        });

                        viaPointButton.events.add('select', function () {
                            var referencePoints = multiRoute.model.getReferencePoints();
                            referencePoints.splice(1, 0, "Москва, ул. Солянка, 7");
                            /**
                             * Добавляем транзитную точку в модель мультимаршрута.
                             * Обратите внимание, что транзитные точки могут находится только
                             * между двумя путевыми точками, т.е. не могут быть крайними точками маршрута.
                             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/multiRouter.MultiRouteModel.xml#setReferencePoints
                             */
                            multiRoute.model.setReferencePoints(referencePoints, [1]);
                        });

                        viaPointButton.events.add('deselect', function () {
                            var referencePoints = multiRoute.model.getReferencePoints();
                            referencePoints.splice(1, 1);
                            multiRoute.model.setReferencePoints(referencePoints, []);
                        });

                        // Создаем карту с добавленными на нее кнопками.
                        var myMap = new ymaps.Map('map', {
                            center: [60.750625, 37.626],
                            zoom: 7,
                            controls: [trafficButton, viaPointButton]
                        }, {
                            buttonMaxWidth: 300
                        });

                        // Добавляем мультимаршрут на карту.
                        myMap.geoObjects.add(multiRoute);
                    }

                    ymaps.ready(init);
        </script>
        <!--<script src="js.js" type="text/javascript"></script>-->
    </head>
    <body>
        <div class="container">
        <div class="header">Визуализация маршрута</div>
    <div class="sidebar">
        <form name="form" action="" method="post">
            <input type="number" name="subject" id="subject" placeholder=" Введите Id">
            <button type="submit" formmethod="post">Отрисовать</button>
        </form>
        <!--<p><a href="#">Отрисовать</a></p>-->
    </div>
    <div class="content">
    <!-- <h2>Визуализация маршрута</h2>-->

    <div id="map"></div>


        
    </body>
</html>