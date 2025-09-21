<?php
// process_enquiry.php
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');
$destination_id = (int)($_POST['destination_id'] ?? 0);

$errors = [];
if ($name === '') $errors[] = 'Name is required.';
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';
if ($message === '') $errors[] = 'Message is required.';
if ($destination_id <= 0) $errors[] = 'Please select a destination.';

if (!empty($errors)) {
    $err = urlencode(implode(' ', $errors));
    // redirect back to index with error and id
    header("Location: index.php?id={$destination_id}&error={$err}");
    exit;
}

$stmt = $mysqli->prepare("INSERT INTO enquiries (name, email, message, destination_id) VALUES (?, ?, ?, ?)");
$stmt->bind_param('sssi', $name, $email, $message, $destination_id);
$ok = $stmt->execute();
$stmt->close();

if ($ok) {
    header("Location: index.php?id={$destination_id}&success=1");
} else {
    header("Location: index.php?id={$destination_id}&error=" . urlencode("Database error"));
}
exit;
