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
  <link rel="stylesheet" href="style.css">
  <script language="JavaScript" type="text/javascript">
  function checkDelete(){
    return confirm('Are you sure to delete this user?');
  }
</script>
</head>
<body>
  <div class="container">
    <h1 class="text-center">Admin Control Panel</h1>
    <h2 class="text-center">Registered Users</h2>
    <?php
    try 
    {
      // This script retrieves all the records from the users table.
      require('mysqli_connect.php'); // Connect to the database.
      //set the number of rows per display page
      $pagerows = 5;                                                            
      // Has the total number of pagess already been calculated?
      if ((isset($_GET['p']) && is_numeric($_GET['p']))) 
      { 
        $pages = htmlspecialchars($_GET['p'], ENT_QUOTES);  
      } 
      else 
      { 
        //use the next block of code to calculate the number of pages                     
        // First, check for the total number of records
        $query = "SELECT COUNT(userid) FROM users";
        $result = $conn->query($query);
        $row = $result->fetch_array (MYSQLI_NUM);
        $records = htmlspecialchars($row[0], ENT_QUOTES);
        // Now calculate the number of pages
        if ($records > $pagerows)
        { 
          //if the number of records will fill more than one page
          // Calculate the number of pages and round the result up to the nearest integer
          $pages = ceil ($records/$pagerows); //                                                   
        } 
        else 
        {
          $pages = 1;
        }
      }

      // Declare which record to start with                                                     
      if ((isset($_GET['s'])) &&( is_numeric($_GET['s'])))
      {
        $start = htmlspecialchars($_GET['s'], ENT_QUOTES);
        // make sure it is not executable XSS
      } 
      else
      {
        $start = 0;
      }

      $query = "SELECT last_name, first_name, email, ";
      $query .= "DATE_FORMAT(registration_date, '%M %d, %Y')";
      $query .= " AS regdat, userid FROM users ORDER BY registration_date ASC";
      $query .= " LIMIT ?, ?";
      $stmt = $conn->stmt_init();
      $stmt->prepare($query);
      // bind $id to SQL Statement
      $stmt->bind_param("ii", $start, $pagerows); 
      // execute query
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result) 
      { 
        // If it ran OK (records were returned), display the records.
        // Table header.                  #2
        echo '<table class="table table-striped">
        <tr>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
        <th scope="col">Last Name</th>
        <th scope="col">First Name</th>
        <th scope="col">Email</th>
        <th scope="col">Date Registered</th>
        </tr>';      

        // Fetch and print all the records:             
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
        {
          // Remove special characters that might already be in table to 
          // reduce the chance of XSS exploits
          $user_id = htmlspecialchars($row['userid'], ENT_QUOTES);
          $last_name = htmlspecialchars($row['last_name'], ENT_QUOTES);
          $first_name = htmlspecialchars($row['first_name'], ENT_QUOTES);
          $email = htmlspecialchars($row['email'], ENT_QUOTES);
          $registration_date = htmlspecialchars($row['regdat'], ENT_QUOTES);
          echo '<tr>
          <td><a href="edit_user.php?id=' . $user_id . '">Edit</a></td>
          <td><a href="delete_user.php?id=' . $user_id . '" onclick="return checkDelete()">Delete</a></td>
          <td>' . $last_name . '</td>
          <td>' . $first_name . '</td>
          <td>' . $email . '</td>
          <td>' . $registration_date . '</td>
          </tr>';
        }
        echo '</table>'; 
        //                                                            
        $result->free_result(); // Free up the resources. 
      }
      else 
      { 
        // If it did not run OK.
        // Error message:
        echo '<p class="text-center">The current users could not be retrieved.</p>';
        exit;
      } 

      // Now display the total number of records/members.           
      $query = "SELECT COUNT(userid) FROM users";
      $result = $conn->query($query);
      $row = $result->fetch_array(MYSQLI_NUM);
      $members = htmlspecialchars($row[0], ENT_QUOTES);
      $conn->close(); // Close the database connection.     
      $echostring = "<p class='text-center'>Total users: $members</p>";
      $echostring .= "<p class='text-center'>";
      if ($pages > 1) 
      {//                                             
        //What number is the current page?
        $current_page = ($start/$pagerows) + 1;
        //If the page is not the first page then create a Previous link
        if ($current_page != 1) 
        {
          $echostring .= '<a href="admin-page.php?s=' . ($start - $pagerows) . 
        '&p=' . $pages . '">Previous</a> ';
        }
        //Create a Next link                                                  
        if ($current_page != $pages) 
        {
          $echostring .= ' <a href="admin-page.php?s=' . ($start + $pagerows) . 
          '&p=' . $pages . '">Next</a> ';
        }
        $echostring .= '</p>';
        echo $echostring;
      }

      $conn->close(); // Close the database connection.
    } //end of try
    catch(Exception $e) // We finally handle any problems here                
    {
      print "An Exception occurred. Message: " . $e->getMessage();
    }
    ?>

<p class="text-center"><a href="logout.php"><button class="btn btn-primary">Log Out</button></a></p>
  </div>
</body>
</html>
