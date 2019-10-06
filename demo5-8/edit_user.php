<?php
try
{ 
    if ((isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From admin-page.php
        $id = htmlspecialchars($_GET['id'], ENT_QUOTES);
    } elseif ((isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES);
    } else { // No valid ID, kill the script.
        echo '<p class="text-center">This page has been accessed in error.</p>';
        exit();
}
require ('mysqli_connect.php'); 
// Has the form been submitted?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name']; 
    $last_name = $_POST['last_name'];           
    $email = $_POST['email'];   
    $u_query = 'UPDATE users SET first_name=?, last_name=?, email=?';
    $u_query .= ' WHERE userid=? LIMIT 1';
    $u_stmt = $conn->stmt_init();
    $u_stmt->prepare($u_query);
    // bind values to SQL Statement
    $u_stmt->bind_param('sssi', $first_name, $last_name, $email, $id);
    // execute query
    $u_stmt->execute();  
    
    if ($u_stmt->affected_rows == 1) { // Update OK 
        // Echo a message if the edit was satisfactory:
        echo '<h3 class="text-center">The user has been edited.</h3>';
        header("location: admin-page.php");
        exit(); 
    } else { // Echo a message if the query failed.
        echo '<p class="text-center">The user could not be edited.'; // Public message.
    }
}

$s_stmt = $conn->stmt_init();
$s_query = "SELECT first_name, last_name, email FROM users WHERE userid=?";
$s_stmt->prepare($s_query);
// bind $id to SQL Statement
$s_stmt->bind_param('i', $id);  
// execute query
$s_stmt->execute();  
$result = $s_stmt->get_result();
$row1 = $result->fetch_array(MYSQLI_ASSOC);

if ($result->num_rows == 1) { // Valid user ID, display the form.
// Create the form:
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Page</title>
  <!-- Bootstrap CSS File -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" 
  integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script language="JavaScript" type="text/javascript">
    function checkUpdate(){
        return confirm('Are you sure to update this user?');
    }
</script>
</head>
<body>
  <div class="container">
    <h2 class="h2 text-center">Edit a Record</h2>
    <form action="edit-user.php" method="post" name="editform" id="editform" onsubmit="return checkUpdate()">
    <div class="form-group row">
            <label for="first_name" class="col-sm-4 col-form-label text-right">First Name*:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="first_name" name="first_name" 
                    placeholder="First Name" maxlength="30" required
                    value="<?php if (isset($row1['first_name'])) 
                    echo htmlspecialchars($row1['first_name'], ENT_QUOTES); ?>" >
            </div>
        </div>
        <div class="form-group row">
            <label for="last_name" class="col-sm-4 col-form-label text-right">Last Name*:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="last_name" name="last_name" 
                    placeholder="Last Name" maxlength="40" required
                    value="<?php if (isset($row1['last_name'])) 
                    echo htmlspecialchars($row1['last_name'], ENT_QUOTES); ?>" >
            </div>
        </div>
    <div class="form-group row">
            <label for="email" class="col-sm-4 col-form-label text-right">E-mail*:</label>
            <div class="col-sm-8">
                <input type="email" class="form-control" id="email" name="email" 
                placeholder="E-mail" maxlength="60" required
                value="<?php if (isset($row1['email'])) 
                echo htmlspecialchars($row1['email'], ENT_QUOTES); ?>" >
            </div>
        </div>
    </div>
    <input type="hidden" name="id" value="<?php echo $id ?>" />
    <div class="form-group row">
            <label for="" class="col-sm-4 col-form-label"></label>
            <div class="col-sm-8">
                <input id="submit" class="btn btn-primary" type="submit" name="submit" value="Update">
            </div>
        </div>
        </form>
        </div>
</body>
</html>
<?php
        $stmt_select->free_result();
        $conn->close();
    }
}
catch(Exception $e)
{
    print "An Exception occurred.Message: " . $e->getMessage();
}
?>
