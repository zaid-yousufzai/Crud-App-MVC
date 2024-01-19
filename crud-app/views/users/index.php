<?php
require_once(__DIR__ . '/../../config.php');
require_once('../../controllers/UserController.php');


$userController = new UserController($conn);
$users = $userController->getUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>User List</title>
</head>
<body>
    <div class="container m-5 p-5 text-center">
    <h2 class="m-5">User List</h2>
    <table border="2" class="table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user->getId() ?></td>
                <td><?= $user->getName() ?></td>
                <td><?= $user->getEmail() ?></td>
                <td>
                    <a href="edit.php?id=<?= $user->getId() ?>" class="btn btn-warning">Edit</a>
                    <a href="delete.php?id=<?= $user->getId() ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="create.php" class="btn btn-primary">Add New User</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
