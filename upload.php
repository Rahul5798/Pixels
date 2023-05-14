<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}


function uploadImage(){
    //Process the image that is uploaded by the user
    include 'DBConnection.php'; 

    $filename = $_FILES["uploadImages"]["name"];
    
    $tempname = $_FILES["uploadImages"]["tmp_name"];
    $fileSize = $_FILES["uploadImages"]["size"];
    $fileErr = $_FILES["uploadImages"]["error"];
    $fileType = $_FILES["uploadImages"]["type"];
    $fileExt = explode(".", $filename);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array("jpg","jpeg","png");
    $user = $_SESSION["username"];
    $category = $_POST['title'];
           
if(in_array($fileActualExt, $allowed)){
  if($fileSize < 10000000){ 
      if($fileErr === 0 ){
              $fileNameNew = uniqid("",true).".".$fileActualExt;
              $fileDestination = "uploads/".$fileNameNew;
                  
              $sql = "INSERT INTO `images` ( `filename`,
                      `user`,`category`,`fileSize`) VALUES ('$fileNameNew', 
                      '$user','$category','$fileSize')";
              mysqli_query($con, $sql);  
              move_uploaded_file($tempname,$fileDestination);
              echo "<script>alert('Image Uploaded Successfully');</script>";
                
            }
            else{
            echo"Sorry an error occured uploading your file";

            }
        }
        else{
      echo"Your file is too big to upload";

        }

    }
    else{
      echo"You cannot upload files of this types!";
    }
}



if(isset($_POST['submit'])){
    
    uploadImage();

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./src/upload.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixels-Upload</title>
</head>
<body>
  <script>
   window.document.onkeydown = function(e) {
  if (!e) {
    e = event;
  }
  if (e.keyCode == 27) {
    lightbox_close();
  }
}

function lightbox_open() {
  var lightBoxVideo = document.getElementById("VisaChipCardVideo");
  window.scrollTo(0, 0);
  document.getElementById('light').style.display = 'block';
  document.getElementById('fade').style.display = 'block';
  lightBoxVideo.play();
}

function lightbox_close() {
  var lightBoxVideo = document.getElementById("VisaChipCardVideo");
  document.getElementById('light').style.display = 'none';
  document.getElementById('fade').style.display = 'none';
  lightBoxVideo.pause();
}
  </script>
    <h2 class="websiteName">Pixels </h2>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
  <div class="navDiv">
    <nav>
      <a href="homepage.php" >Home</a>
      <a href="myImages.php" >My Images</a>
      <a href="upload.php" >Upload</a>   
      <a href="logout.php">Logout</a>  
      <div id="indicator"></div>    
  </nav>
    </div>
<br>
<form action="" method="post" enctype="multipart/form-data">


  <div id="light">
  <a class="boxclose" id="boxclose" onclick="lightbox_close();"></a>
  <video id="VisaChipCardVideo" width="600" controls>
      <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
      <!--Browser does not support <video> tag -->
    </video>
</div>

<div id="fade" onClick="lightbox_close();"></div>

<div class="watchVideo">
  <a class="watchVideoText" href="#" onclick="lightbox_open();">Watch video</a>
</div>
<div class="formDiv">
<h1><strong>Image Upload</strong></h1>
<div class="form-group">
  <label>Choose a Category from this list:
<input type="text" name="title" id="title" class="form-controll" list="categories" required="required" /></label>
<datalist  id="categories">
  <option value="People">
  <option value="Lifestyle">
  <option value="Health">
  <option value="Beauty">
  <option value="Party">
  <option value="Sports">
  <option value="Festivals">
  <option value="Animals">
  <option value="Nature">
  <option value="Vehicle">
  <option value="Tourist place">
  
</datalist>
  </div>
  
  <div class="form-group file-area">
        <label for="images">Images <span>Your images should be at least 400x300 wide</span></label>
    <input type="file" name="uploadImages" id="images" required="required" multiple="multiple"/>
    <div class="file-dummy">
      <div class="success">Great, your files are selected. Keep on.</div>
      <div class="default">Please select some files</div>
    </div>
  </div>
  
  <div class="form-group">
    <button type="submit" name="submit" id="submit">Upload images</button>
  </div>
  
</form>

<link href='https://fonts.googleapis.com/css?family=Lato:100,200,300,400,500,600,700' rel='stylesheet' type='text/css'>

</body>
</html>