<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Platform</title>
</head>
<body>
    <h1>Welcome, {{ $userName }}!</h1>
    <p>Thank you for registering with us.</p>
    <p>Here are your registration details:</p>
    <ul>
        <li><strong>Name:</strong> {{ $userName }}</li>
        <li><strong>Email:</strong> {{ $userEmail }}</li>
        <li><strong>Password:</strong> {{ $plaintextPassword }}</li>  <!-- Plaintext password -->
    </ul>
    <p>We are excited to have you on board!</p>
</body>
</html>
