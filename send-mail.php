<?php
// Function to sanitize user input
function sanitizeInput($data) {
    return htmlspecialchars(trim($data));
}

// Get form data (assuming form submission)
$firstname = sanitizeInput($_POST["firstname"]);
$lastname  = sanitizeInput($_POST["lastname"]);
$address   = sanitizeInput($_POST["address"]);
$town      = sanitizeInput($_POST["town"]);
$country   = sanitizeInput($_POST["country"]);
$postcode  = sanitizeInput($_POST["postcode"]);
$email     = sanitizeInput($_POST["email"]);
$phone     = sanitizeInput($_POST["phone"]);

// Validate required fields
if (empty($firstname) || empty($lastname) || empty($postcode)) {
    echo "Please fill in all required fields.";
    exit;
}

// Function to send email with PHPMailer
function sendEmail($firstname, $lastname, $email, $phone, $address, $town) {
    require "vendor/autoload.php";

    use PHPMailer\PHPMailer;
    use phpmailer\PHPMailer\SMTP;

    $mail = new PHPMailer(true);

    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Set debug level

    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.example.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 465;

    $mail->Username = "you@example.com";
    $mail->Password = "password";

    $mail->setFrom($email, $firstname . ' ' . $lastname);
    $mail->addAddress("adesokanadedeji10@gmail.com", "yemi", "deji");

    $mail->Subject = "Form Submission"; // Set email subject
    $mail->Body = "You have received a new form submission:\n"
                . "- First Name: $firstname\n"
                . "- Last Name: $lastname\n"
                . "- Email: $email\n"
                . "- Phone: $phone\n"
                . "- Address: $address\n"