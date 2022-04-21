<!doctype html>
<html lang="en">
 <head>
 <!-- Required meta tags -->
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.
min.css" integrity="sha384-
Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin
="anonymous">
 <title>Login</title>
 </head>
 <body> <?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
 $email = $_POST['email'];
 $p = $_POST['p'];

 $username = "root";
 $server = "localhost";
 $password = "";
 $database ="student";
 $conn = mysqli_connect($server, $username, $password, $database);
if($conn)
 {
 echo "Connection Establised";
 }
else {
 echo "Connection not established";
 }
 $sql = "SELECT * FROM `table2` WHERE email='$email' AND Password='$p'";

 $result = mysqli_query($conn,$sql);
 $num = mysqli_num_rows($result);

 if($num)
 {
 echo "User is Authentiated";

 session_start();
 $_SESSION['name']=$name;
 header("location:practical6.php");
 }
else {
 echo "error".mysqli_error($conn);
 }
}
?>
<div class="container mt-3">
<h1>Login </h1>
 <form action="login.php" method="post">
<br>
 <label for="text">Email address</label>
 <input type="text" name="email" class="form-control" id="email">
 <small class="form-text textmuted">We'll never share your email with anyone else.</small>
<br>
 <label for="p">Password</label>
 <input type="password" name="p" class="form-control" id="p"> <br>

 <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
 <!-- Optional JavaScript -->
 <!-- jQuery first, then Popper.js, then Bootstrap JS -->
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-
J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin=
"anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="
sha384-
Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="a
nonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="
sha384-
wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="a
nonymous"></script>
 </body>
</html>