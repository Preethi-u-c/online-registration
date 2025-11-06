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

  // Collect form data (26 fields)
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

  // ✅ Insert into database
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
    echo "<!DOCTYPE html><html lang='en'><head>
      <meta charset='UTF-8'>
      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
      <title>Application Submitted</title>
      <style>
        body {
          font-family: Arial, sans-serif;
          background: #f5f7fa;
          color: #333;
          margin: 0;
          padding: 20px;
        }
        h2 {
          color: #2e7d32;
          text-align: center;
        }
        table {
          width: 70%;
          margin: 30px auto;
          border-collapse: collapse;
          background: white;
          box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        td {
          padding: 10px 15px;
          border-bottom: 1px solid #ddd;
        }
        tr:last-child td {
          border-bottom: none;
        }
        th {
          background: #4caf50;
          color: white;
          text-align: left;
          padding: 12px;
        }
        a {
          display: inline-block;
          text-decoration: none;
          margin: 20px auto;
          text-align: center;
          color: white;
          background: #2196f3;
          padding: 10px 20px;
          border-radius: 5px;
        }
        a:hover {
          background: #0b7dda;
        }
      </style>
    </head><body>";

    echo "<h2>✅ Application Submitted Successfully!</h2>";
    echo "<table>";
    echo "<tr><th colspan='2'>Submitted Details</th></tr>";
    echo "<tr><td><b>Full Name:</b></td><td>$first_name $last_name</td></tr>";
    echo "<tr><td><b>Date of Birth:</b></td><td>$dob</td></tr>";
    echo "<tr><td><b>Gender:</b></td><td>$gender</td></tr>";
    echo "<tr><td><b>Email:</b></td><td>$email</td></tr>";
    echo "<tr><td><b>Phone:</b></td><td>$phone</td></tr>";
    echo "<tr><td><b>Alternate Phone:</b></td><td>$alt_phone</td></tr>";
    echo "<tr><td><b>Address:</b></td><td>$address1, $address2, $city, $state, $country - $pincode</td></tr>";
    echo "<tr><td><b>Qualification:</b></td><td>$qualification</td></tr>";
    echo "<tr><td><b>University:</b></td><td>$university</td></tr>";
    echo "<tr><td><b>Passing Year:</b></td><td>$passing_year</td></tr>";
    echo "<tr><td><b>Percentage:</b></td><td>$percentage%</td></tr>";
    echo "<tr><td><b>Course:</b></td><td>$course ($mode - $timing)</td></tr>";
    echo "<tr><td><b>Skills:</b></td><td>$skills</td></tr>";
    echo "<tr><td><b>Experience:</b></td><td>$experience</td></tr>";
    echo "<tr><td><b>Hobbies:</b></td><td>$hobbies</td></tr>";
    echo "<tr><td><b>Comments:</b></td><td>$comments</td></tr>";
    echo "<tr><td><b>Resume File:</b></td><td><a href='uploads/$resume_name' target='_blank'>$resume_name</a></td></tr>";
    echo "</table>";
    echo "<div style='text-align:center;'><a href='index.php'>⬅ Go back to form</a></div>";
    echo "</body></html>";
  } else {
    echo "❌ Error: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
}
?>
