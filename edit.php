<?php
include 'db.php';

$id = $_GET['id'];
$query = "SELECT * FROM crud_p WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $photo = $user['photo']; // default to existing photo

    // File upload handling
    if (!empty($_FILES["photo"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
        $photo = $target_file;
    }

    $query = "UPDATE crud_p SET name = ?, email = ?, age = ?, photo = ? WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ssisi", $name, $email, $age, $photo, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Edit User</h1>
        <form method="POST" action="edit.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" value="<?php echo $user['age']; ?>" required>
            <label for="photo">Photo:</label>
            <input type="file" id="photo" name="photo">
            <button type="submit" class="btn">Update User</button>
        </form>
    </div>
</body>
</html>
