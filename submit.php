<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Handle file upload
  $resume_name = "";
  if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
      mkdir($target_dir);
    }
    $resume_name = basename($_FILES["resume"]["name"]);
    $target_file = $target_dir . $resume_name;
    move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file);
  }

  // Collect form data
  $first_name   = $_POST['first_name'];
  $last_name    = $_POST['last_name'];
  $dob          = $_POST['dob'];
  $gender       = $_POST['gender'];
  $email        = $_POST['email'];
  $phone        = $_POST['phone'];
  $alt_phone    = $_POST['alt_phone'];
  $nationality  = $_POST['nationality'];
  $address1     = $_POST['address1'];
  $address2     = $_POST['address2'];
  $city         = $_POST['city'];
  $state        = $_POST['state'];
  $country      = $_POST['country'];
  $pincode      = $_POST['pincode'];
  $qualification= $_POST['qualification'];
  $university   = $_POST['university'];
  $passing_year = $_POST['passing_year'];
  $percentage   = $_POST['percentage'];
  $course       = $_POST['course'];
  $mode         = $_POST['mode'];
  $timing       = $_POST['timing'];
  $skills       = $_POST['skills'];
  $experience   = $_POST['experience'];
  $hobbies      = $_POST['hobbies'];
  $comments     = $_POST['comments'];

  // Insert into database
  $sql = "INSERT INTO applicants (
    first_name, last_name, dob, gender, email, phone, alt_phone, nationality,
    address1, address2, city, state, country, pincode,
    qualification, university, passing_year, percentage,
    course, mode, timing, skills, experience, hobbies, comments, resume
  ) VALUES (
    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
  )";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param(
    "ssssssssssssssssssssssssss",
    $first_name, $last_name, $dob, $gender, $email, $phone, $alt_phone, $nationality,
    $address1, $address2, $city, $state, $country, $pincode,
    $qualification, $university, $passing_year, $percentage,
    $course, $mode, $timing, $skills, $experience, $hobbies, $comments, $resume_name
  );

  if ($stmt->execute()) {
    // Get last inserted record ID
    $last_id = $stmt->insert_id;

    // Fetch the inserted record to display summary
    $result = mysqli_query($conn, "SELECT * FROM applicants WHERE id = $last_id");
    $row = mysqli_fetch_assoc($result);

    echo "<!DOCTYPE html><html lang='en'><head>
      <meta charset='UTF-8'>
      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
      <title>Registration Successful</title>
      <style>
        body {
          font-family: 'Poppins', sans-serif;
          background: #f4f6f9;
          margin: 0;
          padding: 40px;
          color: #333;
        }
        .container {
          background: #fff;
          max-width: 700px;
          margin: auto;
          border-radius: 12px;
          box-shadow: 0 4px 12px rgba(0,0,0,0.1);
          padding: 30px;
        }
        h2 {
          text-align: center;
          color: #2e7d32;
          margin-bottom: 20px;
        }
        table {
          width: 100%;
          border-collapse: collapse;
          margin: 20px 0;
        }
        td {
          padding: 10px 12px;
          border-bottom: 1px solid #ddd;
        }
        tr:last-child td {
          border-bottom: none;
        }
        th {
          background: #2e7d32;
          color: white;
          text-align: left;
          padding: 10px;
        }
        .btn-container {
          text-align: center;
          margin-top: 20px;
        }
        a.button {
          background: #1a237e;
          color: white;
          padding: 10px 20px;
          text-decoration: none;
          border-radius: 6px;
          margin: 0 10px;
          display: inline-block;
        }
        a.button:hover {
          background: #3949ab;
        }
      </style>
    </head><body>";

    echo "<div class='container'>";
    echo "<h2>✅ Registration Submitted Successfully!</h2>";

    echo "<table>";
    echo "<tr><th colspan='2'>Summary of Your Registration</th></tr>";
    echo "<tr><td><b>Full Name:</b></td><td>{$row['first_name']} {$row['last_name']}</td></tr>";
    echo "<tr><td><b>Email:</b></td><td>{$row['email']}</td></tr>";
    echo "<tr><td><b>Phone:</b></td><td>{$row['phone']}</td></tr>";
    echo "<tr><td><b>Course Applied:</b></td><td>{$row['course']} ({$row['mode']})</td></tr>";
    echo "<tr><td><b>Skills:</b></td><td>{$row['skills']}</td></tr>";
    echo "<tr><td><b>Qualification:</b></td><td>{$row['qualification']}</td></tr>";
    echo "<tr><td><b>Resume:</b></td><td><a href='uploads/{$row['resume']}' target='_blank'>{$row['resume']}</a></td></tr>";
    echo "</table>";

    echo "<div class='btn-container'>
            <a href='index.php' class='button'>➕ Add Another</a>
            <a href='view.php' class='button'>📋 View All Registrations</a>
          </div>";

    echo "</div></body></html>";

  } else {
    echo "❌ Error: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
}
?>
