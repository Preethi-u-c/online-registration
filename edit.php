<?php
include 'config.php';
$id = $_GET['id'];

// Fetch existing record
$result = mysqli_query($conn, "SELECT * FROM applicants WHERE id = $id");
$row = mysqli_fetch_assoc($result);

// Update when form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

  // Handle new resume upload (optional)
  $resume_name = $row['resume'];
  if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
      mkdir($target_dir);
    }
    $resume_name = basename($_FILES["resume"]["name"]);
    $target_file = $target_dir . $resume_name;
    move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file);
  }

  // Update query
  $sql = "UPDATE applicants SET 
    first_name='$first_name',
    last_name='$last_name',
    dob='$dob',
    gender='$gender',
    email='$email',
    phone='$phone',
    alt_phone='$alt_phone',
    nationality='$nationality',
    address1='$address1',
    address2='$address2',
    city='$city',
    state='$state',
    country='$country',
    pincode='$pincode',
    qualification='$qualification',
    university='$university',
    passing_year='$passing_year',
    percentage='$percentage',
    course='$course',
    mode='$mode',
    timing='$timing',
    skills='$skills',
    experience='$experience',
    hobbies='$hobbies',
    comments='$comments',
    resume='$resume_name'
    WHERE id=$id";

  mysqli_query($conn, $sql);
  header("Location: view.php?updated=1");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Edit Registration</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
  <h1>Edit Registration Details</h1>

  <form method="POST" enctype="multipart/form-data">

    <fieldset>
      <legend>👤 Personal Details</legend>
      <div class="form-group">
        <label>First Name:</label>
        <input type="text" name="first_name" value="<?= $row['first_name'] ?>" required>
      </div>
      <div class="form-group">
        <label>Last Name:</label>
        <input type="text" name="last_name" value="<?= $row['last_name'] ?>" required>
      </div>
      <div class="form-group">
        <label>Date of Birth:</label>
        <input type="date" name="dob" value="<?= $row['dob'] ?>" required>
      </div>
      <div class="form-group">
        <label>Gender:</label>
        <select name="gender" required>
          <option <?= $row['gender']=='Male'?'selected':'' ?>>Male</option>
          <option <?= $row['gender']=='Female'?'selected':'' ?>>Female</option>
          <option <?= $row['gender']=='Other'?'selected':'' ?>>Other</option>
        </select>
      </div>
    </fieldset>

    <fieldset>
      <legend>📞 Contact Details</legend>
      <div class="form-group">
        <label>Email:</label>
        <input type="email" name="email" value="<?= $row['email'] ?>" required>
      </div>
      <div class="form-group">
        <label>Phone:</label>
        <input type="tel" name="phone" value="<?= $row['phone'] ?>" required>
      </div>
      <div class="form-group">
        <label>Alternate Phone:</label>
        <input type="tel" name="alt_phone" value="<?= $row['alt_phone'] ?>">
      </div>
      <div class="form-group">
        <label>Nationality:</label>
        <input type="text" name="nationality" value="<?= $row['nationality'] ?>" required>
      </div>
    </fieldset>

    <fieldset>
      <legend>🏠 Address</legend>
      <div class="form-group">
        <label>Address Line 1:</label>
        <input type="text" name="address1" value="<?= $row['address1'] ?>" required>
      </div>
      <div class="form-group">
        <label>Address Line 2:</label>
        <input type="text" name="address2" value="<?= $row['address2'] ?>">
      </div>
      <div class="form-group">
        <label>City:</label>
        <input type="text" name="city" value="<?= $row['city'] ?>" required>
      </div>
      <div class="form-group">
        <label>State:</label>
        <input type="text" name="state" value="<?= $row['state'] ?>" required>
      </div>
      <div class="form-group">
        <label>Country:</label>
        <input type="text" name="country" value="<?= $row['country'] ?>" required>
      </div>
      <div class="form-group">
        <label>Pincode:</label>
        <input type="text" name="pincode" value="<?= $row['pincode'] ?>" required>
      </div>
    </fieldset>

    <fieldset>
      <legend>🎓 Education Details</legend>
      <div class="form-group">
        <label>Highest Qualification:</label>
        <input type="text" name="qualification" value="<?= $row['qualification'] ?>" required>
      </div>
      <div class="form-group">
        <label>University / College:</label>
        <input type="text" name="university" value="<?= $row['university'] ?>" required>
      </div>
      <div class="form-group">
        <label>Year of Passing:</label>
        <input type="number" name="passing_year" value="<?= $row['passing_year'] ?>" required>
      </div>
      <div class="form-group">
        <label>Percentage / CGPA:</label>
        <input type="text" name="percentage" value="<?= $row['percentage'] ?>" required>
      </div>
    </fieldset>

    <fieldset>
      <legend>📚 Course Details</legend>
      <div class="form-group">
        <label>Course Applying For:</label>
        <input type="text" name="course" value="<?= $row['course'] ?>" required>
      </div>
      <div class="form-group">
        <label>Preferred Mode:</label>
        <select name="mode" required>
          <option <?= $row['mode']=='Online'?'selected':'' ?>>Online</option>
          <option <?= $row['mode']=='Offline'?'selected':'' ?>>Offline</option>
        </select>
      </div>
      <div class="form-group">
        <label>Preferred Batch Timing:</label>
        <input type="text" name="timing" value="<?= $row['timing'] ?>">
      </div>
    </fieldset>

    <fieldset>
      <legend>💼 Other Details</legend>
      <div class="form-group">
        <label>Skills:</label>
        <input type="text" name="skills" value="<?= $row['skills'] ?>">
      </div>
      <div class="form-group">
        <label>Experience (in years):</label>
        <input type="number" name="experience" value="<?= $row['experience'] ?>">
      </div>
      <div class="form-group">
        <label>Hobbies:</label>
        <input type="text" name="hobbies" value="<?= $row['hobbies'] ?>">
      </div>
      <div class="form-group">
        <label>Upload Resume (optional):</label>
        <input type="file" name="resume">
        <?php if (!empty($row['resume'])): ?>
          <p>Current File: <a href="uploads/<?= $row['resume'] ?>" target="_blank"><?= $row['resume'] ?></a></p>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <label>Comments / Message:</label>
        <textarea name="comments"><?= $row['comments'] ?></textarea>
      </div>
    </fieldset>

    <button type="submit">💾 Save Changes</button>
  </form>

  <div style="text-align:center; margin-top:15px;">
    <a href="view.php" class="back-link">← Back to All Registrations</a>
  </div>
</div>
</body>
</html>
