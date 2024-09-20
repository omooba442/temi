<?php

// Function to sanitize user input
function sanitizeInput($data) {
  return htmlspecialchars(trim($data));
}

// Get form data (assuming form submission)
$firstname = sanitizeInput($_POST["firstname"]);
$lastname = sanitizeInput($_POST["lastname"]);
$address = sanitizeInput($_POST["address"]);
$town = sanitizeInput($_POST["town"]);
$country = sanitizeInput($_POST["country"]);
$postcode = sanitizeInput($_POST["postcode"]);
$email = sanitizeInput($_POST["email"]);
$phone = sanitizeInput($_POST["phone"]);

// Validate required fields
if (empty($firstname) || empty($lastname) || empty($postcode)|| empty($phone)|| empty($email)|| empty($country)|| empty($town)|| empty($postcode)) {
  echo "Please fill in all required fields.";
  exit;
}

// Function to send email using PHP's built-in mail() function
function sendEmail($firstname, $lastname, $email, $phone, $address, $town ,$country, $postcode) {
  $to = "adesokanadedeji10@gmail.com"; // Replace with your recipient's email address
  $subject = "Form Submission";
  $message = "You have received a new form submission:\n"
              . "- First Name: $firstname\n"
              . "- Last Name: $lastname\n"
              . "- Email: $email\n"
              . "- Phone: $phone\n"
              . "- Address: $address\n"
              . "- Town: $town\n"
              . "- Country: $country\n"
              . "- Postcode: $postcode\n";
  $headers = "From: aowebtech13@gmail"; // Replace with your sender's email address

  try {
    if (mail($to, $subject, $message, $headers)) {
      echo "Email sent successfully!";
      header('Location: thank-you.html'); // Redirect to index.html after successful email sending
      exit; // Exit script after redirect
    } else {
      throw new Exception("Error sending email.");
    }
  } catch (Exception $e) {
    echo "Error sending email: " . $e->getMessage();
  }
}

// Call the sendEmail function with the form data
sendEmail($firstname, $lastname, $email, $phone , town:$town , country:$country, postcode:$postcode, address:$address );