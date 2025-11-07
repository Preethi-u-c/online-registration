<?php
include 'config.php';
error_reporting(0); // optional: hides minor PHP notices

// Fetch all records
$result = mysqli_query($conn, "SELECT * FROM applicants");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Registrations</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* Table and button styles integrated with your CSS theme */
    body {
      background-color: #f4f6f9;
      font-family: 'Poppins', sans-serif;
      padding: 30px;
    }

    .container {
      background: #fff;
      padding: 25px;
      border-radius: 10px;
      max-width: 1000px;
      margin: auto;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    h2 {
      color: #1a237e;
      text-align: left;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }

    table th, table td {
      padding: 12px 15px;
      border-bottom: 1px solid #ddd;
      text-align: left;
    }

    table th {
      background-color: #1a237e;
      color: white;
    }

    tr:hover {
      background-color: #f2f2f2;
    }

    .btn {
      padding: 6px 12px;
      text-decoration: none;
      border-radius: 5px;
      font-size: 14px;
      font-weight: 500;
      color: white;
      transition: all 0.2s ease;
    }

    .btn-edit {
      background: #0288d1;
    }

    .btn-edit:hover {
      background: #0277bd;
    }

    .btn-delete {
      background: #d32f2f;
    }

    .btn-delete:hover {
      background: #b71c1c;
    }

    .btn-add {
      background: #2e7d32;
      padding: 10px 16px;
      float: right;
      margin-bottom: 10px;
    }

    .btn-add:hover {
      background: #1b5e20;
    }

    /* Success message styling */
    .message {
      text-align: center;
      padding: 12px;
      border-radius: 6px;
      margin-bottom: 15px;
      font-weight: 500;
    }

    .success { background: #c8e6c9; color: #1b5e20; }
    .update  { background: #bbdefb; color: #0d47a1; }
    .delete  { background: #ffcdd2; color: #b71c1c; }
  </style>
</head>
<body>

<div class="container">

  <!-- ✅ Display status messages -->
  <?php if (isset($_GET['success'])): ?>
    <div class="message success">✅ Registration submitted successfully!</div>
  <?php elseif (isset($_GET['updated'])): ?>
    <div class="message update">✏️ Record updated successfully!</div>
  <?php elseif (isset($_GET['deleted'])): ?>
    <div class="message delete">🗑️ Record deleted successfully!</div>
  <?php endif; ?>

  <h2>All Registrations</h2>

  <!-- Add New Registration button -->
  <a href="index.php" class="btn btn-add">+ Add New Registration</a>

  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Course</th>
      <th>Actions</th>
    </tr>

    <?php while($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['phone']) ?></td>
        <td><?= htmlspecialchars($row['course']) ?></td>
        <td>
          <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-edit">Edit</a>
          <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
        </td>
      </tr>
    <?php } ?>
  </table>
</div>

</body>
</html>
