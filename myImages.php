<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}
$user = $_SESSION['username'];
include'DBConnection.php';
$query = "SELECT * FROM `images` WHERE user = '$user';";

$result = mysqli_query($con,$query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="./src/homepage.css" />
    <title>Pixels</title>
</head>
<body>

 
<h1>Pixels </h1>
    <div class="navDiv">
    <nav>
      <a href="homepage.php">Home</a>
      
      <a href="myImages.php" >My Images</a>
      <a href="upload.php" >Upload</a>   
      <a href="logout.php">Logout</a>  
      <div id="indicator"></div>
  </nav>
</div>
    

    <div id="cover">
  <form method="get" action="">
    <div class="tb">
      <div class="td"><input type="text" placeholder="Search" required></div>
      <div class="td" id="s-cover">
        <button type="submit">
          <div id="s-circle"></div>
          <span></span>
        </button>
      </div>
    </div>
  </form>
</div>






<ul class="cards">
<?php 
while($data = mysqli_fetch_assoc($result)){ ?>
  <li class="card"> 
  <img class="card__image " src="uploads/<?php echo $data['fileName'];?>" alt="No image Found">
    <div class="card__overlay">
      <div class="card__header">
        <svg class="card__arc" xmlns="http://www.w3.org/2000/svg"><path /></svg>                     
        <img class="card__thumb" id="img" src="https://i.imgur.com/7D7I6dI.png" alt="" />
        <div class="card__header-text">
        <h3 class="card__title"><?php echo $data['user'];?></h3>             
        <span class="card__status"><?php echo floor($data['fileSize']/100) . 'KB';?></span>
        <a href="download.php?fileName=<?php echo $data['fileName'] ?>"><button id="button">Download</button></a>
        <i class="fa fa-share-alt" style="font-size:13px"></i>
      </div>
    </div>
  <p class="card__description">Category: <?php echo $data['category'];?></p>
  </div>      
  </li>    

<?php
}
?>
</ul>
</body>
<!--<script src=
"https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js">
   </script>
   <script>
      function download(){
          axios({
              url:'https://source.unsplash.com/random/500x500',
              method:'GET',
              responseType: 'blob'
      })
      .then((response) => {
             const url = window.URL
             .createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', 'image.jpg');
                    document.body.appendChild(link);
                    link.click();
      })
      }

   </script>-->
</html>

