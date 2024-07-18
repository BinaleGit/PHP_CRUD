<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Application</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Users</h1>
        <a href="create.php" class="btn">Add New User</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM crud_p";
                $result = $con->query($query);

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td><img src='{$row['photo']}' alt='User Photo' width='50' height='50'></td>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['age']}</td>
                            <td>
                                <a href='edit.php?id={$row['id']}' class='btn'>Edit</a>
                                <a href='delete.php?id={$row['id']}' class='btn'>Delete</a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
