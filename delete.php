<?php
include 'db.php';

$id = $_GET['id'];
$query = "DELETE FROM crud_p WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

header("Location: index.php");
exit();
?>
