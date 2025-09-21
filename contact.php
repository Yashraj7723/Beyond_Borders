<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - Travel Website</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php include 'includes/header.php'; ?>

<div class="container mt-5">
  <h2 class="mb-4">Contact Us</h2>
  
  <form action="contact.php" method="POST" class="card p-4 shadow">
    <div class="mb-3">
      <label class="form-label">Your Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    
    <div class="mb-3">
      <label class="form-label">Your Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    
    <div class="mb-3">
      <label class="form-label">Subject</label>
      <input type="text" name="subject" class="form-control" required>
    </div>
    
    <div class="mb-3">
      <label class="form-label">Message</label>
      <textarea name="message" class="form-control" rows="4" required></textarea>
    </div>
    
    <button type="submit" class="btn btn-success">Send Message</button>
  </form>
</div>

<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $mysqli->real_escape_string($_POST['name']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $subject = $mysqli->real_escape_string($_POST['subject']);
    $message = $mysqli->real_escape_string($_POST['message']);

    $sql = "INSERT INTO contact_messages (name, email, subject, message) 
            VALUES ('$name', '$email', '$subject', '$message')";

    if ($mysqli->query($sql) === TRUE) {
        echo "<div class='container mt-4'><div class='alert alert-success'> Thank you! Your message has been sent.</div></div>";
    } else {
        echo "<div class='container mt-4'><div class='alert alert-danger'> Error: " . $mysqli->error . "</div></div>";
    }
}
?>
