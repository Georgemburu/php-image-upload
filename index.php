<h1>File Upload</h1>
<form enctype="multipart/form-data" method="post" action="index.php">
<input type="file" name="file"><br><br>
<input type="submit" name="upload-btn" value="upload">
</form>
<?php
if(isset($_POST['upload-btn'])){
    $pic_name = $_FILES['file']['name'];
    $pic_type = $_FILES['file']['type'];
    $pic_error = $_FILES['file']['error'];
    $pic_tempname = $_FILES['file']['tmp_name'];
    $pic_size = $_FILES['file']['size'];

    $pic_extentionname = strtolower(substr($pic_name,strpos($pic_name,'.')+1));
    echo $pic_type;

    
    if(empty($pic_name)){
        echo 'please choose a file to upload';
        exit();
    }else {
        if($pic_extentionname === 'jpg' || $pic_extentionname === 'jpeg' ||$pic_extentionname === 'png'){
            
           if( move_uploaded_file($pic_tempname, 'uploads/'.$pic_name)){
               $host = 'localhost';
               $dbUser = 'tester';
               $dbPassword = '1234tester1234';
               $dbName = 'imagesuploads';

               $mysqli = new mysqli($host,$dbUser,$dbPassword,$dbName) or die(mysqli_error($mysqli));
               $imagePath = 'uploads/'.$pic_name;
               $mysqli->query("INSERT INTO imagepaths (path) VALUES ('$imagePath')") or die($mysqli->error);
           
               header("Location: $imagePath" );
           }else {
               echo 'we encountered a problem uploading image';
           }
        }else {
            echo 'images only';
        }
        die();
    }
   
}

?>