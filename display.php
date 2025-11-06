<?php
include 'config.php';

$sql = "SELECT * FROM applicants ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Submitted Applications</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f7f9fb;
      padding: 30px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 10px;
      border: 1px solid #ddd;
      text-align: left;
    }
    th {
      background: #007bff;
      color: white;
    }
    tr:hover {
      background: #f1f1f1;
    }
    h2 {
      color: #333;
      text-align: center;
    }
  </style>
</head>
<body>
  <h2>All Submitted Applications</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Course</th>
      <th>Percentage</th>
      <th>Resume</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo "<tr>
          <td>{$row['id']}</td>
          <td>{$row['first_name']}</td>
          <td>{$row['last_name']}</td>
          <td>{$row['email']}</td>
          <td>{$row['phone']}</td>
          <td>{$row['course']}</td>
          <td>{$row['percentage']}</td>
          <td><a href='uploads/{$row['resume']}' target='_blank'>View</a></td>
        </tr>";
      }
    } else {
      echo "<tr><td colspan='8'>No applications found</td></tr>";
    }
    $conn->close();
    ?>
  </table>
</body>
</html>
