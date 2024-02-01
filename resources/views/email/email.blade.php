<!-- resources/views/email/email.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Email Title</title>
</head>
<body>

    <h1>Hello!</h1>
    <p>This is the content of your email.</p>

    <p>{{ $trackingToken }} 
        <br/>
        {{  $emailId }}</p>
    <!-- Include the tracking pixel with the generated token and email_id -->
    <img src="{{ route('track-email', ['token' => $trackingToken, 'email_id' => $emailId]) }}" alt="Tracking Pixel" style="display: none;">

    <p>Thank you for using our service!</p>

</body>
</html>
