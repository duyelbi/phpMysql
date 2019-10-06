<?php                                                                                     
session_start();
//if (!isset($_SESSION['user']) or ($_SESSION['user_level'] != 1))
if (!isset($_SESSION['email']))
{ 
  header("location: login-page.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Page</title>
  <!-- Bootstrap CSS File -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" 
  integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <h1 class="text-center">Admin Control Panel</h1>
    <h2 class="text-center">Registered Users</h2>
    <?php
    try 
    { 
      // Check for a valid user ID, through GET or POST:
      if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) 
      {
        $id = htmlspecialchars($_GET['id'], ENT_QUOTES); 
      } 
      else 
      { // No valid ID, kill the script, return to login page
        header("Location: login-page.php");
        exit();
      }
      require ('mysqli_connect.php');
      // Check if the form has been submitted:                                               
      
      // Use prepare statement to remove security problems
      $q = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($q, 'DELETE FROM users WHERE userid=? LIMIT 1');

      // bind $id to SQL Statement
      mysqli_stmt_bind_param($q, "s", $id);

      // execute query
      mysqli_stmt_execute($q);
    
      if (mysqli_stmt_affected_rows($q) == 1) 
      { 
        // It ran OK
        // Print a message:
        echo '<h3 class="text-center">The record has been deleted.</h3>'; 
      } 
      else 
      { 
        // If the query did not run OK display public message
          echo '<p class="text-center">The record could not be deleted.</p>';
      }
      
      mysqli_stmt_close($q);
      mysqli_close($conn);
      header("Location: admin-page.php");
    }
    catch(Exception $e) 
    {
      print "An Exception occurred.Message: " . $e->getMessage();
    }
    ?>
  </div>
</body>
</html>
