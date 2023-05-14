<?php
include 'DBConnection.php';

if (isset($_GET['fileName'])) {
    $fileName = $_GET['fileName'];

    // fetch file to download from database
    $sql = $sql = "SELECT * FROM `images` WHERE fileName = '$fileName';";
    $result = mysqli_query($con, $sql);

    $image = mysqli_fetch_assoc($result);
    $imagePath = 'uploads/'.$image['fileName'];

    if(file_exists($imagePath)){
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($imagePath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($imagePath));
        readfile($imagePath);
    }
    header("location: homepage.php");
}
else{
    echo "<script>alert('Image not found');</script>";
    header("location: homepage.php");
}
?>