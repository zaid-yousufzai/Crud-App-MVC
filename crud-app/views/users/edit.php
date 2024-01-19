<?php
require_once('../../controllers/UserController.php');
require_once('../../config.php');

$userController = new UserController($conn); // Make sure to pass the database connection object

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $userController->updateUser($userId, $name, $email);

    header('Location: index.php');
    exit();
}

$userId = isset($_GET['id']) ? $_GET['id'] : null;

if ($userId === null) {
    echo 'User ID is missing.';
    exit();
}

$user = $userController->getUserById($userId);

if (!$user) {
    echo 'User not found.';
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Edit User</title>
</head>
<body>
   <div class="container text-center m-5 p-5">
   <h2>Edit User</h2>
    <form method="post">
       <div class="form-group m-3">
       <input type="hidden" name="id" value="<?= $user->getId() ?>">
        <label for="name">Name:</label>
       </div>
       <div class="form-group m-3">
       <input type="text" name="name" value="<?= $user->getName() ?>" required>
        <br>
        <label for="email">Email:</label>
       </div>
       <div class="form-group m-3">
       <input type="email" name="email" value="<?= $user->getEmail() ?>" required>
        <br>
        <input type="submit" value="Update User" class="btn btn-warning m-2">
       </div>
    </form>
    <br>
    <a href="index.php" class="btn btn-primary">Back to User List</a>
   </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
