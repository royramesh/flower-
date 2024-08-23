<?php
// Define the recipient email address
$to = 'tgameing33@gmail.com';

// Get form data from POST request
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$subject = htmlspecialchars($_POST['subject']);
$message = htmlspecialchars($_POST['message']);

// Validate form data
if(empty($name) || empty($email) || empty($subject) || empty($message)) {
    echo 'All fields are required.';
    exit;
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'Invalid email format.';
    exit;
}

// Prepare the email content
$headers = "From: $name <$email>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

// Create the email body
$email_body = "<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; }
        .header { background-color: #f4f4f4; padding: 10px; border-bottom: 1px solid #ddd; }
        .content { padding: 20px; }
        .footer { font-size: 12px; color: #888; text-align: center; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h2>Contact Form Submission</h2>
        </div>
        <div class='content'>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Subject:</strong> $subject</p>
            <p><strong>Message:</strong></p>
            <p>$message</p>
        </div>
        <div class='footer'>
            <p>This is an automated message. Please do not reply directly to this email.</p>
        </div>
    </div>
</body>
</html>";

// Send the email
if (mail($to, $subject, $email_body, $headers)) {
    echo 'Message sent successfully!';
} else {
    echo 'Failed to send message.';
}
?>
