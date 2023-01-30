<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main View </title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <link rel="stylesheet" href="style.css" />

    <style>
    #map {
        width: 100%;
        height: 500px;
        border-radius: 10px;
    }

    .imgdiv {
        width: 150px;
        word-wrap: break-word;
    }

    .imgdiv img:hover {
        -ms-transform: scale(1.5);
        /* IE 9 */
        -webkit-transform: scale(1.5);
        /* Safari 3-8 */
        transform: scale(2);
    }
    </style>
</head>

<body>
    <div class="wrap">
        <div id="map"></div>
    </div>
    <?php
    //including the database connection file
    include_once("db_conn.php");


    // $query = mysql_query("SELECT * FROM table");
    $result = mysqli_query($mysqli, "SELECT * FROM images ORDER BY id DESC");
    // while ($car = mysql_fetch_assoc($query)) {
        $location = array();
    while ($res = mysqli_fetch_array($result)) {
    //   foreach(mysqli_fetch_array($result)as $res){
   // $rows = mysqli_fetch_array($result);
    //if ($rows) {
       
      //  print_r($rows);
      //  foreach ($rows as $res) {


          /*  echo "<p>" . $res['id'] . "</p>"; // bugs && error need to fix  ********** 01/21
            echo "<p>" . $res['lat'] . "</p>";
            echo "<p>" . $res['lng'] . "</p>";
            echo "<p>" . $res['date'] . "</p>";
            echo "<p>" . $res['time'] . "</p>";
            echo "<p>" . $res['text'] . "</p>"; */

            array_push($location, array(
                'mlat' => $res['lat'], 'mlng' => $res['lng'], 'mdate' => $res['date'],
                'mtime' => $res['time'], 'mtext' => $res['text'], 'mimg' => $res['image_url'],
            ));
            /* = [

            $mlat = $res['lat'],
            $mlng = $res['lng'],
            $mdate = $res['date'],
            $mtime = $res['time'],
            $mtext = $res['text'],
            $mimg = $res['image_url'],
        ]; */
            // $locationArray [] = [$location] ;
        }
    

    ?>
    <!-- map js liberary -->
    <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js"></script>
    <script>
    let mapOptions = {
        center: [35.7092461, 139.7520614],
        zoom: 17
    }
    let map = new L.map('map', mapOptions);

    let layer = new L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png');
    map.addLayer(layer);

    var windowlocation =
    <?php echo json_encode($location); ?>; // php data to js data using json  **********************

    //variable 
    console.log(windowlocation); //



    let popupOption = {
        "closeButton": false // remove x button beside  at content
    }
    // check marker 

    // let marker = null; // if marker is already pin => delete it 
    windowlocation.forEach(element => {
        marker = new L.Marker([element['mlat'], element['mlng']]).addTo(map)
            //mouse hover and 
            .bindPopup('<div class="imgdiv"><p>Date : ' + element['mdate'] +
             '</p><img src="uploads/' + element['mimg'] + '" width="150px"><p id ="cmt">' +
              element['mtext'] + '</p></div>')
        .openPopup(); // add multi pin any where 
    });



    //<img src="' + element.src + '" width="200" height="200" alt="' + element.title + '">
    </script>


</body>

</html>