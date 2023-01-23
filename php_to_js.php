<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map Project </title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <link rel="stylesheet" href="style.css" />

</head>

<body>

    <script>
    let mapOptions = {
        center: [35.7092461, 139.7520614],
        zoom: 13
    }
    let map = new L.map('map', mapOptions);

    let layer = new L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png');
    map.addLayer(layer);
    //
    let locations = [

        <?php
            //including the database connection file
            include_once("db_conn.php");

            // $query = mysql_query("SELECT * FROM cars");
            $result = mysqli_query($mysqli, "SELECT * FROM images ORDER BY id DESC");
            // while ($car = mysql_fetch_assoc($query)) {
            while ($res = mysqli_fetch_array($result)) {
                // $car_name = $car["name"];
                // echo "'$car_name',";
                {
                    /*echo "<p>" . $res['id'] . "</p>"; bugs && error need to fix  ********** 01/21
        echo "<p>" . $res['lat'] . "</p>";
        echo "<p>" . $res['lng'] . "</p>";
        echo "<p>" . $res['date'] . "</p>";
        echo "<p>" . $res['time'] . "</p>";
        echo "<p>" . $res['text'] . "</p>"; */
                    $location_lat =  $res['lat'];
                    $location_lng =  $res['lng'];
                    $location_img =  $res['image_url'];
                }
            }  ?>
    ];





    //variable 
    let popupOption = {
        "closeButton": false // remove x button beside  at content
    }

    let Drag = {
        "draggable": true // no need 
    }
    map.on('click', function(e) {
        alert(e.latlng);
    });

    // loop 
    locations.forEach(element => {
        new L.Marker([element.lat, element.long]).addTo(map)
            //mouse hover and 
            .on("mouseover", event => {
                event.target.bindPopup('<div class="card"><img src="' + element.src +
                        '" width="200" height="200" alt="' + element.title + '"></div>', popupOption)
                    .openPopup();
            })
            .on("mouseout", event => {
                event.target.closePopup();
            })
            .on("click", event => {
                event.target.bindPopup(Drag).openPopup();
            })

    });
    </script>
    <div class="wrap">

        <div id="map"></div>
    </div>
    <!-- map js liberary -->

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
</body>

</html>