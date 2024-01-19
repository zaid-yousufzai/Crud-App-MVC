<?php
require_once('../../controllers/UserController.php');
require_once('../../config.php');

$userController = new UserController($conn); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    
    if (!empty($name) && !empty($email)) {
        $userController->createUser($name, $email);
        header('Location: index.php');
        exit();
    } else {
        echo 'Name and email are required fields.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Create User</title>
</head>
<body>
    <div class="container m-5 p-5 text-center">
    <h2>Create User</h2>
    <form method="post">
       <div class="form-group">
       <label for="name">Name:</label>
        <input type="text" name="name" class="form-control" required>
       </div>
        <br>
        <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" class="form-control" required>
        </div>
        <br>
        <input type="submit" class="btn btn-warning m-1" value="Create User">
    </form>

    <a href="index.php" class="btn btn-primary m-1">Back to User List</a>
    </div>
    <br>
   
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
