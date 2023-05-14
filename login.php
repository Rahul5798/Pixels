<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: homepage.php");
    exit;
}
function login(){

  // Include file which makes the
  // Database Connection.
  include 'DBConnection.php'; 

  $email = $_POST["loginEmail"];
  $password = $_POST["loginPassword"];

  $sql = "Select * from userdetails where Email='$email'";
        
  $result = mysqli_query($con, $sql);
        
  $num = mysqli_num_rows($result); 
    if ($num === 1) {
       while($row = mysqli_fetch_assoc($result)) {
            if($row["Password"]==$password){
                $_SESSION["loggedin"] = true;
                $_SESSION["email"] = $row["Email"];
                $_SESSION["username"] = $row["Username"]; 
    
                // Redirect user to welcome page
                header("location: homepage.php");
            }
            else{
              header("Location:login.php?message=Password is Invalid");
            }
        }
           
       
    } else {
      header("Location:login.php?message=Email does not match!");
    }
}
if(isset($_POST['login'])){
  login();
}
?>
<!DOCTYPE html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8" />
  <title>Login / Sign Up Form</title>
  <link rel="shortcut icon" href="/assets/favicon.ico" />
  <link rel="stylesheet" href="./src/main.css" />
</head>
<body>

    <div class="upperContainer">
      <video autoplay muted loop id="myVideo">
        <source src="./src/wave.mp4" type="video/mp4" />
      </video>
      <div class="container">
        <form class="form" id="login" method="POST" onsubmit="return loginFormValidation()" action="<?php $_SERVER["PHP_SELF"]; ?>">
          <h1 class="title">Login</h1>
          <div class="message errorMessage--error" id="errorMsg1"><?php
                if(isset($_GET["message"])){
                    echo $_GET["message"];
                }?></div>
          <div class="inputField">
            <input
              type="text"
              class="innerInput"
              autofocus
              placeholder="Email"
              name="loginEmail"
              id="loginEmail"
            />
            <div class="inputedErrorMessage"></div>
          </div>
          <div class="inputField">
            <input
              type="password"
              class="innerInput"
              autofocus
              placeholder="Password"
              name="loginPassword"
              id="loginPassword"
            />
            <div class="inputedErrorMessage"></div>
          </div>
          <button class="submitBtn" type="submit" name="login">Continue</button>
          <p class="text">
            <a href="#" class="form__link">Forgot your password?</a>
          </p>
          <p class="text">
            <a class="form__link" href="signup.php" id="linkCreateAccount"
              >Don't have an account? Create account</a
            >
          </p>
        </form>
      </div>
    </div>
    <script src="./src/main.js"></script>  
</body>
</html>