<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map Project </title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <link rel="stylesheet" href="style.css" />
    <style>

    </style>

</head>

<body>
    <!-- if https or http have error -->
    <?php if (isset($_GET['error'])) : ?>
        <p><?php echo $_GET['error']; ?></p>
    <?php endif ?>
    <div class="wrap">
        <div id="map"></div>
    </div>
    <div id="ShowContent">
        <form class="form-space" action="upload.php" method="post" enctype="multipart/form-data">
            
            <div class="form-control"><label style="color:red;font-weight:bold">latitude </label>
                <input type="text" id="latitude" placeholder="latitude" name="lat" readonly>
            </div>
            <div class="form-control"><label style="color:red;font-weight:bold">longitude</label>
                <input type="text" id="longitude" placeholder="longitude" name="lng"  readonly>
            </div>
            <div class="form-control">
                <label>Date :</label>
                <input type="date" name="date" />
            </div>
            <!-- <div class="form-control">
                <label>Month :</label>
                <input type="month" name="lastMonth" min="1900-01" max="2030-12" />
            </div> -->
            <div class="form-control">
                <label> Time :</label>
                <input type="time" name="time" />
            </div>
            <div class="form-control">
                <label> Text :</label>
                <input type="text" name="text" size="20" maxlength="255" required />
            </div>
            <div class="form-control">
                <label> Photo :</label>
                <input type="file" name="my_image" required />
            </div>
            <input type="submit" name="Submit" value="Add" /> &emsp; <input type="Reset" /> &emsp;
            <button type="button" onclick="RemoveFunction()">Close</button>
            <!--- view data save -- --19/01 fix no need to show again -->
            <div id="dataAdd">
                <p> Successfully ! Data is already save . </p>
                <button type="button" onclick="BackMainPage()">Close</button>
            </div>
        </form>
    </div>

    <!-- map js liberary -->
    <script  defer src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script defer src="javascript.js"></script>
</body>

</html>