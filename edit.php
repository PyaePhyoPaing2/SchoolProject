<?php
//including the database connection file
include_once("db_conn.php");

//$id = $_GET['id']; => bugs warning fixed 01/22 

//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($mysqli, "SELECT * FROM images ORDER BY id DESC"); // using mysqli_query instead
?>

<html>

<head>
    <title>Homepage</title>
</head>

<body>
    <a href="index.html">Add New Data</a><br /><br />

    <table width='80%' border=0>

        <tr bgcolor='#CCCCCC'>
            <td>Date</td>
            <td>Time</td>
            <td>Text</td>
            <td>Photo</td>
        </tr>
        <?php
        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
        while ($res = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $res['date'] . "</td>";
            echo "<td>" . $res['time'] . "</td>";
            echo "<td>" . $res['text'] . "</td>";
            // echo "<td>" . $res['image_url'] . "</td>";   => new image name at database 
        ?>
                <!-- src =" file_path/new image name locate at database  -->
            <td><img src="uploads/<?= $res['image_url']  ?>" width="20%" height="20%"></td>
        <?php
            echo "<td><a href=\"show.php\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
        }
        ?>
    </table>
</body>

</html>