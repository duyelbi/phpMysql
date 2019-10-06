<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Page</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php 
// Khai báo giá trị ban đầu, nếu không form sẽ báo lỗi.
$first_name = $last_name = $email = $password = $confirm_password = "";
$error_first_name = $error_last_name = $error_email = $error_password = $error_confirm_password = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $error_check = 1;
    if (empty($_POST["first_name"])) 
    {
      $error_first_name = "<span style='color:red;'>Error: 
      Please enter your first name .</span>";
      $error_check = 0;
    } 
    else 
    {
      $first_name = $_POST["first_name"];
      // check if name only contains letters and whitespace
      if(!preg_match("/^[a-zA-Z ]*$/",$first_name)) 
      {
        $error_first_name = "<span style='color:red;'>Error:  Only letters and white space allowed.</span>";
        $error_check = 0;
      } 
    }

    if (empty($_POST["last_name"])) 
    {
      $error_last_name = "<span style='color:red;'>Error: 
      Please enter your last name.</span>";
      $error_check = 0;
    } 
    else 
    {
      $first_name = $_POST["last_name"];
      // check if name only contains letters and whitespace
      if(!preg_match("/^[a-zA-Z ]*$/",$last_name)) 
      {
        $error_last_name = "<span style='color:red;'>Error: Only letters and white space allowed.</span>";
        $error_check = 0;
      } 
    }


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
      else 
      {
        require "mysqli_connect.php";

        $sql = "select email from users;";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) 
        {
          while($row = $result->fetch_assoc())
          {
            if ($email === $row["email"]) 
            {
              $error_email = "<span style='color:red;'>Error: email already exists.</span>";
              $error_check = 0;
            }
          }
        }
        $conn->close();
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

    if (empty($_POST["confirm_password"])) 
    {
      $error_confirm_password = "<span style='color:red;'>Error: 
      Please enter your confirm password.</span>";
      $error_check = 0;
    } 
    else 
    {
      $confirm_password = $_POST["confirm_password"];
      $password = $_POST["password"];
      if ($_POST["password"] != $_POST["confirm_password"]) 
      {
        $error_confirm_password = "<span style='color:red;'>Error: The password and confirmation password do not match.</span>";
        $error_check = 0;

        // echo $confirm_password;
      } 
    }

    if($error_check === 1)
    {
        // header("Location: register.php");

      try 
      {
        require('mysqli_connect.php');
        // Check connection
        if ($conn->connect_error) 
        {
          die("Connection failed: " . $conn->connect_error);
        }
        // Get form inputs
        $first_name = $_POST['first_name'];	
        $last_name = $_POST['last_name'];	
        $email = $_POST['email'];	
        $password = $_POST['password'];
        // $hashed_passcode = password_hash($password, PASSWORD_DEFAULT);
        // Make and prepare the query                                               
        $query = "INSERT INTO users (first_name, last_name, email, password, registration_date) ";
        $query .= "VALUES(?, ?, ?, ?, NOW())";			                
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $first_name, $last_name, $email, $password);
        // Run and check the query's result
        if ($stmt->execute()) 
        {	
          // One record inserted			
          header ("location: register-thanks.php"); 
          exit();
        } 
        else 
        { 
          // If it did not run OK.
          $errorstring = "<p class='text-center col-sm-8' style='color:red'>";
          $errorstring .= "System Error<br />You could not be registered due ";
          $errorstring .= "to a system error. We apologize for any inconvenience.</p>"; 
          exit();
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
}
?>




<div class="container">
  <h1>Register Page</h1>

  <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
    <div class="form-group">
      <label for="first_name">First Name:</label>
      <input type="first_name"class="form-control" id="first_name" placeholder="First Name" name="first_name" value="<?php echo $first_name; ?>">
      <?php echo $error_first_name . '<br>'?>
    </div>
    
    <div class="form-group">
      <label for="last_name">Last Name:</label>
      <input type="last_name" class="form-control" id="last_name" placeholder="Last Name" name="last_name" value="<?php echo $last_name; ?>">
      <?php echo $error_last_name . '<br>'?>
    </div>
    
    <div class="form-group">
      <label for="email">E-mail:</label>
      <input type="email" class="form-control" id="email" placeholder="E-mail" name="email" value="<?php echo $email; ?>">
      <?php echo $error_email . '<br>'?>
    </div>
    
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Password" name="password" value="<?php echo $password; ?>">
      <?php echo $error_password . '<br>'?>
    </div>
    
    <div class="form-group">
      <label for="cpd">Confirm Password:</label>
      <input type="password" class="form-control" id="cpd" placeholder="Confirm Password" name="confirm_password" value="<?php echo $confirm_password; ?>">
      <?php echo $error_confirm_password . '<br>'?>
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Register</button>
    <br><br>
  </form>

  <p>You already have an account, do you want to login: </p>

  <a href="login-page.php"><button class="btn btn-primary">Login</button></a>

</div>

</body>
</html>