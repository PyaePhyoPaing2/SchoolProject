<?php
//including the database connection file
include("db_conn.php");

//getting id of the data from url
$id = $_GET['id'];

$delete_file = mysqli_query($mysqli,"SELECT * FROM images WHERE id=$id");

$res = mysqli_fetch_array($delete_file);
unlink("uploads/".$res['image_url']);
//deleting the row from table
$result = mysqli_query($mysqli, "DELETE FROM images WHERE id=$id");

//redirecting to the display page (index.php in our case)
header("Location:edit.php");
?>

