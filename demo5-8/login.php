<?php
   session_start();

   try 
{
    require('mysqli_connect.php');
    // Check connection
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
    // Get form inputs
    $email = $_POST['email'];	
    $password = $_POST['password'];
    $hashed_passcode = password_hash($password, PASSWORD_DEFAULT);
    // Make and prepare the query                                               
    $query = "SELECT * FROM users WHERE email = '$email' and password = '$password'";
    $stmt = $conn->prepare($query);
    // Run and check the query's result
    if ($stmt->execute()) 
    {	
        // One record inserted			
        header ("location: admin-page.php"); 
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
?>