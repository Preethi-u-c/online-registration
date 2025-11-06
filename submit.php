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

  // ✅ SQL Query (26 question marks)
  $sql = "INSERT INTO applicants (
    first_name, last_name, dob, gender, email, phone, alt_phone, nationality,
    address1, address2, city, state, country, pincode,
    qualification, university, passing_year, percentage,
    course, mode, timing, skills, experience, hobbies, comments, resume
  ) VALUES (
    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
  )";

  $stmt = $conn->prepare($sql);

  // ✅ EXACTLY 26 type specifiers for 26 values
  $stmt->bind_param(
    "ssssssssssssssssssssssssss",
    $first_name, $last_name, $dob, $gender, $email, $phone, $alt_phone, $nationality,
    $address1, $address2, $city, $state, $country, $pincode,
    $qualification, $university, $passing_year, $percentage,
    $course, $mode, $timing, $skills, $experience, $hobbies, $comments, $resume_name
  );

  if ($stmt->execute()) {
    echo "<h2 style='color:green;text-align:center;'>✅ Application Submitted Successfully!</h2>";
    echo "<p style='text-align:center;'><a href='index.php'>Go back to form</a></p>";
  } else {
    echo "❌ Error: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
}
?>
