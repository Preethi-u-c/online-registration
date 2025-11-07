<?php
include 'config.php';
$id = $_GET['id'];

// Delete record using correct column name
mysqli_query($conn, "DELETE FROM applicants WHERE id = $id");

header("Location: view.php?deleted=1");
exit();
?>
