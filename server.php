<?php
session_start();

$username = "";
$email    = "";

$errors = array(); 

$db = mysqli_connect('localhost', 'root', '', 'ivm');
if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

if (isset($_POST['reg_user'])) {
  $first_name=mysqli_real_escape_string($db, $_POST['first_name']);
  $last_name=mysqli_real_escape_string($db, $_POST['last_name']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $pass = mysqli_real_escape_string($db, $_POST['pass']);

  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($first_name)) { array_push($errors, "First Name is required"); }
  if (empty($last_name)) { array_push($errors, "Last Name is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($pass)) { array_push($errors, "Password is required"); }

  $user_check_query = "SELECT * FROM register WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { 
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  if (count($errors) == 0) {
  	$pass = md5($pass);

  	$query = "INSERT INTO register (username,email,pass,first_name,last_name) 
  			  VALUES('$username', '$email', '$pass','$first_name','$last_name')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['first_name'] =$first_name;
	$_SESSION['last_name'] =$last_name;
  	header('location: index.php');
  }
}

if(isset($_POST['submit']))
{
  
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $pass = mysqli_real_escape_string($db, $_POST['pass']);
  
    if (empty($username)) {
      array_push($errors, "Username is required");
    }
    if (empty($pass)) {
      array_push($errors, "Password is required");
    }
    
    if (count($errors) == 0) 
    {
      $pass = md5($pass);
      if (md5($_POST['pass']) !== $pass)
{
    echo "Password is invalid";
}
      $query = "SELECT * FROM register WHERE username='$username' AND pass ='$pass'";
    
      $sql="SELECT first_name,last_name FROM register WHERE username='$username' AND pass ='$pass'";
		$result=mysqli_query($db,$sql);  
		$row=mysqli_fetch_assoc($result);
	 
	 
	 
      $results = mysqli_query($db, $query);
      $res=mysqli_num_rows($results);
      if ($res) 
      {
        $_SESSION['username'] = $username;
        $_SESSION['first_name'] =$row["first_name"];
		
		$_SESSION['last_name'] =$row["last_name"];
        header('location: index.php');
      }
      else 
      {
        array_push($errors, "Wrong username/password");
      }
    }
  }
  
  ?>
  