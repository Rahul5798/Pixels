<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
function signup(){
    $userExist = "False";
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      
        // Include file which makes the
        // Database Connection.
        include 'DBConnection.php';   
        
        $username = $_POST["signupUsername"]; 
        $email = $_POST["signupEmail"];
        $password = $_POST["signupPassword"];             
        
        $sql = "Select * from userdetails where Email='$email'";
        
        $result = mysqli_query($con, $sql);
        
        $num = mysqli_num_rows($result); 
        
        // This sql query is use to check if
        // the username is already present 
        // or not in our Database
        if($num == 0) {
                $sql = "INSERT INTO `userdetails` ( `Username`, 
                    `Email`, `Password`) VALUES ('$username', 
                    '$email', '$password')";
        
                $result = mysqli_query($con, $sql);
        
                if ($result) {
                    header("Location:login.php?message=Account created successfully");
                }else{
                    header("Location:signup.php?message=Please!Try again");
                }      
        }// end if 
        
       if($num>0) 
       {
        header("Location:signup.php?message=User already exist");
        $exists="True"; 
       } 
        
    }
    $stmt->close();
    $sql->close();
    $con->close();
}
if(isset($_POST['signup'])){
    signup();
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
        <form class="form" id="createAccount" onsubmit="return signUpFormValidation()" method="POST" action="<?php $_SERVER["PHP_SELF"]; ?>">
            <h1 class="title">Create Account</h1>
            <div class="message errorMessage--error" id="errorMsg"><?php
                if(isset($_GET["message"])){
                    echo $_GET["message"];
                }?></div>
            <div class="inputField">
              <input
                type="text"
                id="signupUsername"
                class="innerInput"
                autofocus
                placeholder="Username"
                name="signupUsername"
              />
              <div class="inputedErrorMessage"></div>
            </div>
            <div class="inputField">
              <input
                type="text"
                class="innerInput"
                autofocus
                placeholder="Email Address"
                name="signupEmail"
                id="signupEmail"
              />
              <div class="inputedErrorMessage"></div>
            </div>
            <div class="inputField">
              <input
                type="password"
                class="innerInput"
                autofocus
                placeholder="Password"
                name="signupPassword"
                id="signupPassword"
              />
              <div class="inputedErrorMessage"></div>
            </div>
            <div class="inputField">
              <input
                type="password"
                class="innerInput"
                autofocus
                placeholder="Confirm password"
                name="repeatPassword"
                id="rePassword"
              />
              <div class="inputedErrorMessage"></div>
            </div>
            <button class="submitBtn" type="submit" name="signup">Continue</button>
            <p class="text">
              <a class="form__link" href="login.php" id="linkLogin"
                >Already have an account? Sign in</a
              >
            </p>
          </form>
        </div>
    </div>
    <script src="./src/main.js"></script>  
</body>
</html>