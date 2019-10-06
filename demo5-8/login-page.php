<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php 
// Khai báo giá trị ban đầu, nếu không form sẽ báo lỗi.
$email = $password = "";
$error_email = $error_password = $errorstring= "";
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $error_check = 1;

    if (empty($_POST["email"])) 
    {
      $error_email = "<span style='color:red;'>Error: 
      Please enter your email.</span>";
      $error_check = 0;
    } 
    else 
    {
      $email = $_POST["email"];
      // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
      {
          $error_email = "<span style='color:red;'>Error: Invalid email format.</span>";
          $error_check = 0;
      }
    }

    if (empty($_POST["password"])) 
    {
      $error_password = "<span style='color:red;'>Error: 
      Please enter your password.</span>";
      $error_check = 0;
    } 
    else 
    {
      $password = $_POST["password"];
      if(!preg_match("/^[a-zA-Z0-9 ]*$/",$password)) 
      {
        $error_password = "<span style='color:red;'>Error: Only letters and numbers.</span>";
        $error_check = 0;
      } 
    }
}

    if($error_check === 1)
    {

      try 
      {
        require('mysqli_connect.php');
        // Check connection
        if ($conn->connect_error) 
        {
          die("Connection failed: " . $conn->connect_error);
        }
        // Get form inputs
        // $email = $_POST['email'];	
        // $password = $_POST['password'];
        // Make and prepare the query                                               
        $sql = "SELECT * FROM users WHERE email = '$email' and password = '$password'";
        $result = $conn->query($sql);
        // Run and check the query's result
        if ($result->num_rows == 1) 
        {	
          $_SESSION["email"] = $email;
        // One record inserted			
        header ("location: admin-page.php"); 
        exit();
        } 
        else 
        {
          header ("Location: login-page.php");
        }
      } 
      catch (Exception $e) 
      {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
      }

      // Close statement and connection
      $stmt->close();
      $conn->close();
    }
?>


<div class="container">
  <h1>Login Page</h1>

  <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
    <div class="form-group">
      <label for="email">E-mail:</label>
      <input type="email" class="form-control" id="email" placeholder="E-mail" name="email" value="<?php echo $email; ?>">
      <span><?php echo $error_email . '<br>'?></span>
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Password" name="password" value="<?php echo $password; ?>">
      <span><?php echo $error_password . '<br>'?></span>
    </div>
    <span><?php echo $errorstring;?></span>
    <br>
    <button type="submit" class="btn btn-primary">Login</button>
    <br> <br>
  </form>

  <p>
You do not have an account, do you want to register: </p>

  <a href="register-page.php"><button class="btn btn-primary">Register</button></a>
</div>

</body>
</html>