<!DOCTYPE html>
<html>
<head>
    <title>Your Flight Booking Canceled</title>
</head>
<body>
    <h1>Booking Cancellation</h1>
    <p>Dear {{ Auth::user()->Name }},</p>
    <p>We're sorry to inform you that your flight booking has been canceled.</p>
    <p><strong>Booking ID:</strong> {{ $bookingID }}</p>
    <p><strong>Arrival Time:</strong> {{ $arrivalTime }}</p>
    <p>If you have any questions or need assistance, please contact our support team.</p>
    <p>Thank you for choosing our service!</p>
</body>
</html>
