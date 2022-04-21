<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password)
*/ define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root'); define('DB_PASSWORD',
''); define('DB_NAME', 'wppractical');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection if($link === false){ die("ERROR: Could
not connect. " . mysqli_connect_error());
}
?>
////////////////////////////////////////////Create.php///////////////////////////////////////////
<?php
// Include config file require_once
"config.php";

// Define variables and initialize with empty values
$name = $email = $phone = "";
$name_err = $address_err = $phone_err = "";

// Processing form data when form is submitted if($_SERVER["REQUEST_METHOD"]
== "POST"){
 // Validate name
Acharya Prachi[180130107001] Page 57 of 79

 $input_name = trim($_POST["name"]);
if(empty($input_name)){
 $name_err = "Please enter a name.";
 }
Acharya Prachi[180130107001] Page 58 of 79

elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP,
array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
 $name_err = "Please enter a valid name.";
 } else{
 $name = $input_name;
 }

 // Validate email
 $input_email = trim($_POST["email"]);
if(empty($input_email)){
 $address_err = "Please enter an email.";
 } else{
 $email = $input_email;
 }

 // Validate phone
 $input_phone = trim($_POST["phone"]);
if(empty($input_phone)){
 $phone_err = "Please enter the phone amount.";
 } elseif(!ctype_digit($input_phone)){
 $phone_err = "Please enter a positive integer value.";
 } else{
 $phone = $input_phone;
 }

 // Check input errors before inserting in database
if(empty($name_err) && empty($address_err) && empty($phone_err)){
 // Prepare an insert statement
 $sql = "INSERT INTO user_details (fname, email, phone) VALUES (?, ?, ?)";

 if($stmt = mysqli_prepare($link, $sql)){
 // Bind variables to the prepared statement as parameters
Acharya Prachi[180130107001] Page 59 of 79

 mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_address,
$param_phone);

 // Set parameters
 $param_name = $name;
 $param_address = $email;
 $param_phone = $phone;

 // Attempt to execute the prepared statement
if(mysqli_stmt_execute($stmt)){
 // Records created successfully. Redirect to landing
page header("location: index.php"); exit();
 } else{
 echo "Oops! Something went wrong. Please try again later.";
 }
 }

 }

 // Close connection
mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>Create Record</title>
 <link rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <style>
.wrapper{
Acharya Prachi[180130107001] Page 60 of 79

width: 600px;
margin: 0 auto;
 }
 </style>
</head>
<body>
 <div class="wrapper">
 <div class="container-fluid">
 <div class="row">
 <div class="col-md-12">
 <h2 class="mt-5">Create Record</h2>
 <p>Please fill this form and submit to add user record to the
database.</p>
 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
method="post">
 <div class="form-group">
 <label>Name</label>
 <input type="text" name="name" class="form-control <?php echo
(!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
 <span class="invalid-feedback"><?php echo $name_err;?></span>
 </div>
 <div class="form-group">
 <label>Email</label>
 <textarea name="email" class="form-control <?php echo
(!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $email; ?></textarea>
 <span class="invalid-feedback"><?php echo $address_err;?></span>
 </div>
 <div class="form-group">
 <label>phone</label>
 <input type="text" name="phone" class="form-control <?php echo
(!empty($phone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone; ?>">
 <span class="invalid-feedback"><?php echo $phone_err;?></span>
 </div>
 <input type="submit" class="btn btn-primary" value="Submit">
 <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
 </form>
Acharya Prachi[180130107001] Page 61 of 79

 </div>
 </div>
 </div>
 </div>
</body> </html>
1. Delete.php
Acharya Prachi[180130107001] Page 62 of 79

<?php
// Process delete operation after confirmation if(isset($_POST["id"])
&& !empty($_POST["id"])){
 // Include config file
require_once "config.php";

 // Prepare a delete statement
 $sql = "DELETE FROM user_details WHERE id = ?";

 if($stmt = mysqli_prepare($link, $sql)){
 // Bind variables to the prepared statement as parameters
mysqli_stmt_bind_param($stmt, "i", $param_id);

 // Set parameters
 $param_id = trim($_POST["id"]);

 // Attempt to execute the prepared statement
if(mysqli_stmt_execute($stmt)){
 // Records deleted successfully. Redirect to landing page
header("location: index.php");
 exit();
 } else{
 echo "Oops! Something went wrong. Please try again later.";
 }
 }

 // Close statement
mysqli_stmt_close($stmt);

 // Close connection
mysqli_close($link);
} else{
 // Check existence of id parameter
if(empty(trim($_GET["id"]))){
 // URL doesn't contain id parameter. Redirect to error page
header("location: error.php");
Acharya Prachi[180130107001] Page 63 of 79

 exit();
 }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>Delete Record</title>
 <link rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <style>
.wrapper{
width: 600px;
margin: 0 auto;
 }
 </style>
</head>
<body>
 <div class="wrapper">
 <div class="container-fluid">
 <div class="row">
 <div class="col-md-12">
 <h2 class="mt-5 mb-3">Delete Record</h2>
 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
method="post">
 <div class="alert alert-danger">
 <input type="hidden" name="id" value="<?php echo trim($_GET["id"]);
?>"/> <p>Are you sure you want to delete this employee record?</p>
 <p>
 <input type="submit" value="Yes" class="btn btn-danger">
 <a href="index.php" class="btn btn-secondary">No</a>
 </p>
 </div>
 </form>
Acharya Prachi[180130107001] Page 64 of 79

 </div>
 </div>
 </div>
 </div>
</body>
</html>
2. Error.php
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>Error</title>
 <link rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <style>
.wrapper{
width: 600px;
margin: 0 auto;
 }
 </style>
</head>
<body>
 <div class="wrapper">
 <div class="container-fluid">
 <div class="row">
 <div class="col-md-12">
 <h2 class="mt-5 mb-3">Invalid Request</h2>
 <div class="alert alert-danger">Sorry, you've made an invalid request. Please <a
href="index.php" class="alert-link">go back</a> and try again.</div>
 </div>
 </div>
 </div>
 </div>
</body>
Acharya Prachi[180130107001] Page 65 of 79

</html>
Acharya Prachi[180130107001] Page 66 of 79

3. Index.php
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
<title>Dashboard</title>
 <link rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <link rel="stylesheet"
href="https://maxcdn.bootstrapcdn.com/fontawesome/4.7.0/css/font-awesome.min.css">
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 <script
src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
 <script
src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 <style>
.wrapper{
width: 600px;
margin: 0 auto;
 }
 table tr td:last-child{
width: 120px;
 }
 </style>
 <script>
 $(document).ready(function(){
 $('[data-toggle="tooltip"]').tooltip();
 });
 </script>
</head>
<body>
 <div class="wrapper">
Acharya Prachi[180130107001] Page 67 of 79

 <div class="container-fluid">
 <div class="row">
 <div class="col-md-12">
 <div class="mt-5 mb-3 clearfix">
 <h2 class="pull-left">User Details</h2>
 <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i>
Add New User</a>
 </div>
 <?php
 // Include config file
require_once "config.php";

 // Attempt select query execution $sql = "SELECT
* FROM user_details"; if($result = mysqli_query($link, $sql)){
if(mysqli_num_rows($result) > 0){ echo '<table
class="table table-bordered table-striped">'; echo
"<thead>"; echo "<tr>"; echo
"<th>#</th>"; echo "<th>Name</th>";
echo "<th>Email</th>"; echo "<th>Phone</th>";
echo "<th>Action</th>"; echo "</tr>";
echo "</thead>"; echo "<tbody>";
while($row = mysqli_fetch_array($result)){ echo
"<tr>"; echo "<td>" . $row['id'] . "</td>";
echo "<td>" . $row['fname'] . "</td>"; echo "<td>"
. $row['email'] . "</td>"; echo "<td>" .
$row['phone'] . "</td>"; echo "<td>";
 echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="View
Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
 echo '<a href="update.php?id='. $row['id'] .'" class="mr-3"
title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
 echo '<a href="delete.php?id='. $row['id'] .'" title="Delete Record"
data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
Acharya Prachi[180130107001] Page 68 of 79

 echo "</td>";
echo "</tr>";
 }
echo "</tbody>";
echo "</table>"; //
Free result set
 mysqli_free_result($result);
 } else{
 echo '<div class="alert alert-danger"><em>No records were
found.</em></div>';
 }
 } else{
 echo "Oops! Something went wrong. Please try again later.";
 }

 // Close connection
mysqli_close($link);
 ?>
 </div>
 </div>
 </div>
 </div>
</body>
</html>
4. Read.php
<?php
// Check existence of id parameter before processing further if(isset($_GET["id"])
&& !empty(trim($_GET["id"]))){
 // Include config file
require_once "config.php";

 // Prepare a select statement
 $sql = "SELECT * FROM user_details WHERE id = ?";

 if($stmt = mysqli_prepare($link, $sql)){
Acharya Prachi[180130107001] Page 69 of 79

 // Bind variables to the prepared statement as parameters
mysqli_stmt_bind_param($stmt, "i", $param_id);

 // Set parameters
 $param_id = trim($_GET["id"]);

 // Attempt to execute the prepared statement
if(mysqli_stmt_execute($stmt)){
 $result = mysqli_stmt_get_result($stmt);

 if(mysqli_num_rows($result) == 1){
 /* Fetch result row as an associative array. Since the result set
contains only one row, we don't need to use while loop */
 $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

 // Retrieve individual field value
 $name = $row["fname"];
 $email = $row["email"];
 $phone = $row["phone"];
 } else{
 // URL doesn't contain valid id parameter. Redirect to error page
header("location: error.php");
 exit();
 }

 } else{
 echo "Oops! Something went wrong. Please try again later.";
 }
 }

 // Close statement
mysqli_stmt_close($stmt);

Acharya Prachi[180130107001] Page 70 of 79

 // Close connection
mysqli_close($link);
} else{
 // URL doesn't contain id parameter. Redirect to error page
header("location: error.php");
 exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>View Record</title>
 <link rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <style>
.wrapper{
width: 600px;
margin: 0 auto;
 }
 </style>
</head>
<body>
 <div class="wrapper">
 <div class="container-fluid">
 <div class="row">
 <div class="col-md-12">
 <h1 class="mt-5 mb-3">View Record</h1>
 <div class="form-group">
 <label>Name</label>
 <p><b><?php echo $row["fname"]; ?></b></p>
 </div>
 <div class="form-group">
Acharya Prachi[180130107001] Page 71 of 79

 <label>Email</label>
 <p><b><?php echo $row["email"]; ?></b></p>
 </div>
 <div class="form-group">
 <label>Phone</label>
 <p><b><?php echo $row["phone"]; ?></b></p>
 </div>
 <p><a href="index.php" class="btn btn-primary">Back</a></p>
 </div>
 </div>
 </div>
 </div>
</body>
</html>
5. Update.php
<?php
// Include config file require_once
"config.php";

// Define variables and initialize with empty values
$name = $email = $phone = "";
$name_err = $address_err = $phone_err = "";

// Processing form data when form is submitted if(isset($_POST["id"])
&& !empty($_POST["id"])){
 // Get hidden input value
 $id = $_POST["id"];

 // Validate name
 $input_name = trim($_POST["name"]);
if(empty($input_name)){
 $name_err = "Please enter a name.";
Acharya Prachi[180130107001] Page 72 of 79

 } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP,
array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
 $name_err = "Please enter a valid name.";
 } else{
 $name = $input_name;
 }

 // Validate email email
Acharya Prachi[180130107001] Page 73 of 79

 $input_address = trim($_POST["email"]);
if(empty($input_address)){
 $address_err = "Please enter an email.";
 } else{
 $email = $input_address;
 }

 // Validate phone
 $input_phone = trim($_POST["phone"]);
if(empty($input_phone)){
 $phone_err = "Please enter the phone amount.";
 } elseif(!ctype_digit($input_phone)){
 $phone_err = "Please enter a positive integer value.";
 } else{
 $phone = $input_phone;
 }

 // Check input errors before inserting in database
if(empty($name_err) && empty($address_err) && empty($phone_err)){
 // Prepare an update statement
 $sql = "UPDATE user_details SET fname=?, email=?, phone=? WHERE id=?";

 if($stmt = mysqli_prepare($link, $sql)){
 // Bind variables to the prepared statement as parameters
mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_email, $param_phone,
$param_id);

 // Set parameters
 $param_name = $name;
 $param_email = $email;
 $param_phone = $phone;
 $param_id = $id;

Acharya Prachi[180130107001] Page 74 of 79

 // Attempt to execute the prepared statement
if(mysqli_stmt_execute($stmt)){
 // Records updated successfully. Redirect to landing page
 header("location: index.php");
 exit();
 } else{
 echo "Oops! Something went wrong. Please try again later.";
 }
 }
 }

 // Close connection
mysqli_close($link);
} else{
 // Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
 // Get URL parameter
 $id = trim($_GET["id"]);

 // Prepare a select statement
 $sql = "SELECT * FROM user_details WHERE id = ?";
if($stmt = mysqli_prepare($link, $sql)){
 // Bind variables to the prepared statement as parameters
mysqli_stmt_bind_param($stmt, "i", $param_id);

 // Set parameters
 $param_id = $id;

 // Attempt to execute the prepared statement
if(mysqli_stmt_execute($stmt)){
 $result = mysqli_stmt_get_result($stmt);

 if(mysqli_num_rows($result) == 1){
 /* Fetch result row as an associative array. Since the result set
contains only one row, we don't need to use while loop */
 $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

Acharya Prachi[180130107001] Page 75 of 79

 // Retrieve individual field value
 $name = $row["fname"];
 $email = $row["email"];
 $phone = $row["phone"];
 } else{
 // URL doesn't contain valid id. Redirect to error
page header("location: error.php"); exit();
} else{
 echo "Oops! Something went wrong. Please try again later.";
 }
 }
 // Close statement
mysqli_stmt_close($stmt); //
Close connection
mysqli_close($link);
 } else{
 // URL doesn't contain id parameter. Redirect to error page
header("location: error.php");
 exit();
 }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>Update details</title>
 <link rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <style>
.wrapper{
width: 600px;
margin: 0 auto;
 }
Acharya Prachi[180130107001] Page 76 of 79

 </style>
</head>
<body>
 <div class="wrapper">
 <div class="container-fluid">
 <div class="row">
 <div class="col-md-12">
 <h2 class="mt-5">Update Record</h2>
 <p>Please edit the input values and submit to update the employee record.</p>
<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>"
method="post">
 <div class="form-group">
 <label>Name</label>
 <input type="text" name="name" class="form-control <?php echo
(!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
 <span class="invalid-feedback"><?php echo $name_err;?></span>
 </div>
 <div class="form-group">
 <label>Email</label>
 <textarea name="email" class="form-control <?php echo
(!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $email; ?></textarea>
 <span class="invalid-feedback"><?php echo $address_err;?></span>
 </div>
 <div class="form-group">
 <label>Phone</label>
 <input type="text" name="phone" class="form-control <?php echo
(!empty($phone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone; ?>">
 <span class="invalid-feedback"><?php echo $phone_err;?></span>
 </div>
 <input type="hidden" name="id" value="<?php echo $id; ?>"/>
 <input type="submit" class="btn btn-primary" value="Submit">
 <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
 </form>
 </div>
 </div>
 </div>
 </div>
Acharya Prachi[180130107001] Page 77 of 79

</body>
</html> 