<?php 
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
    $hashed_passcode = password_hash($password, PASSWORD_DEFAULT);
    // Make and prepare the query                                               
    $query = "INSERT INTO users (first_name, last_name, email, password, registration_date) ";
    $query .= "VALUES(?, ?, ?, ?, NOW())";			                
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $first_name, $last_name, $email, $hashed_passcode);
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
?>

