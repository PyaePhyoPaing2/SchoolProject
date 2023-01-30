<!------ add.php ------->
<html>

<head>
    <title>Add Data Page </title>
</head>

<body>

    <?php

    //including the database connection file
    include "db_conn.php"; // connection  database  file 

    //  if => add data and submit && photo upload as a file 
    // if (isset($_POST['Submit']) && isset($_FILES['my_image'])) {
    if (isset($_POST['Submit'])) {
        // id was auto increasement 
        $lat = mysqli_real_escape_string($mysqli, $_POST['lat']);
        $lng = mysqli_real_escape_string($mysqli, $_POST['lng']);
        $date = mysqli_real_escape_string($mysqli, $_POST['date']);
        $time = mysqli_real_escape_string($mysqli, $_POST['time']);
        $text = mysqli_real_escape_string($mysqli, $_POST['text']);

        // checking empty fields
        if (empty($lat) || empty($lng) || empty($date)  || empty($time)  || empty($text)) {

            if (empty($lat)) {
                echo "<font color='red'>lat field is empty.</font><br/>";
            }

            if (empty($lng)) {
                echo "<font color='red'>lng field is empty.</font><br/>";
            }

            if (empty($date)) {
                echo "<font color='red'>Date field is empty.</font><br/>";
            }
            if (empty($time)) {
                echo "<font color='red'>Time field is empty.</font><br/>";
            }
            if (empty($text)) {
                echo "<font color='red'>Text field is empty.</font><br/>";
            }

            //link to the previous page
            echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
        } else {
            // if all the fields are filled (not empty)  => next step  to check images type,data => if fine ,upload images to database

            //  if ($_FILES['my_image']) {
            echo "<pre>";
            print_r($_FILES['my_image']); // check image details 
            echo "</pre>";
            //  }
            /**Array
(
    [name] => ppp.png
    [full_path] => ppp.png
    [type] => image/png
    [tmp_name] => C:\xampp\tmp\php5F1A.tmp
    [error] => 0
    [size] => 204865
)                        
                check finished => fine 01/19                   */

            // image upload -->
            $img_name = $_FILES['my_image']['name'];
            $img_size = $_FILES['my_image']['size'];
            $tmp_name = $_FILES['my_image']['tmp_name'];
            $error = $_FILES['my_image']['error'];
            // line 62 error = 0
            if ($error == 0) {
                if ($img_size > 6000000) { // image size can`t upload over 6.0MB => give Error message  for dataBase storage 
                    $errorMessage = "<font color='red'>File is too large . Can't upload over 6.0MB . Please , choice another Pictures .";
                    header("location:index.php?error=$errorMessage");
                } else {
                    $img_extension = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_extension_lc = strtolower($img_extension);

                    $allowed_extensions = array("jpg", "jpeg", "png", "JPG"); //can  upload types of image 


                    if (in_array($img_extension_lc, $allowed_extensions)) {
                        $new_img_name = uniqid("IMG-", true) . "." . $img_extension_lc;
                        $img_upload_path = 'uploads/' . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path); //C:\xampp\tmp\php5F1A.tmp => photo_path move to => uploads/image 

                        // insert into database 
                        // database Query Object = sql  at	lng	date	time	text	image_url	
                        $sql = "INSERT INTO images(lat,lng,date,time,text,image_url)
                        VALUES('$lat','$lng','$date','$time','$text','$new_img_name')";
                        mysqli_query($mysqli, $sql);
                        // after insert data to table > show 
                        header("location:edit.php");
                    } else {
                        // if file type is not image type =>  
                        $errorMessage = "<font color='red'>You can't upload files of this type .";
                        header("location:index.php?error=$errorMessage");
                    }
                    echo " test fine  image is under 6kb";
                }
            } else {
                // error != 0 if Unknow Error happen when uploading image files 
                $errorMessage = "<font color='red'>Unknow Error Occurred !  Please , Reload page Or check your Internet Sever .</br> Please. Contact Us .";
                header("location:error.php?error=$errorMessage");
            }


            //insert data to database	
            // $result = mysqli_query($mysqli, "INSERT INTO users(name,age,email) VALUES('$name','$age','$email')");

            //display success message

            echo "<br/><font color='green'>Data added successfully.";
            echo "<br/><a href='index.php'>View Result</a>";
        }
    } else {
        //  if  submit button get error 
        // header("location:index.php");
        echo "<p> Error</p>";
    }
    ?>
</body>

</html>