<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit(); // Ensure that no further code is executed
}

// Log out functionality
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit(); // Ensure that no further code is executed
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container m-5 p-5 text-center">
        <h1 class="m-5">Admin Dashboard  <?=  $_SESSION['username']  ?></h1>
        <div class="container">
            <button class="btn btn-danger"><a href="logout.php">Logout</a></button>
            
            <button class="btn btn-danger"><a href="../users/create.php">Add User</a></button>
            <button class="btn btn-danger"><a href="../users/index.php">Diplay LIst</a></button>


        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
