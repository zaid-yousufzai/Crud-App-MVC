<?php
session_start();
require_once('../../config.php');


if(isset($_COOKIE['admin_name']) && isset($_COOKIE['admin_pass']))
{
  $name=$_COOKIE['admin_name'];
  $pass=$_COOKIE['admin_pass'];
}

else{
  $name='';
  $pass='';
}

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    header('location: dashboard.php');
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Assuming $conn is your database connection
    $stmt = $conn->prepare("SELECT * FROM admins WHERE name=? AND password=?");
    $stmt->bind_param("ss", $username, $password);

    // Set values for $username and $password before executing the statement

    $stmt->execute();
    $result = $stmt->get_result();

    // Process the result as needed

    $rows = mysqli_num_rows($result);

    if ($rows) {
        $_SESSION['username'] = $username; // Corrected session variable

        // Set a cookie if "Remember Me" is checked
        if (isset($_POST['remember'])) {
            $cookie_expiry = time() + (30 * 24 * 3600); // 30 days
            setcookie('admin_name', $username, $cookie_expiry);
            setcookie('admin_pass', $password, $cookie_expiry);
        }

        else
        {
          setcookie('admin_name','',time()-60);
          setcookie('admin_pass','',time()-60);
        }

        header("Location: dashboard.php");
        exit();
    } else {
        echo "Invalid credentials";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<div class="container m-5 p-5 ">
    <h1 class="m-5">Admin Login</h1>
    <form method="post">

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" value="<?= $name   ?>">
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" value="<?= $pass  ?>">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input bg-primary" name="remember">
            <label class="form-check-label" for="remember">Remember Me</label>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
