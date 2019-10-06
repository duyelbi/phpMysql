<?php 
try 
{
    require('mysqli_connect.php');
    // check connection
    if($conn->connect_error)
    {
        die("connection failed: " . $conn->connection_error);
    }
    echo "Connected successfully";
} catch (Exception $e)
{
    echo 'Caught exception: ', $e->getMessage(), "\n";
}

// close connection
$conn->close();
?>