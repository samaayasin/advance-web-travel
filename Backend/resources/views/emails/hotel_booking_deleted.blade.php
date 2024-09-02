<!DOCTYPE html>
<html>
<head>
    <title>Your Hotel Booking Canceled</title>
</head>
<body>
    <h1>Booking Cancellation</h1>
    <p>Dear {{ Auth::user()->Name }},</p>
    <p>Your hotel booking has been canceled.</p>
    <p><strong>Booking ID:</strong> {{ $bookingID }}</p>
    <p><strong>Start Date:</strong> {{ $startDate }}</p>
    <p><strong>End Date:</strong> {{ $endDate }}</p>
    <p>If you have any questions, please contact our support team.</p>
    <p>Thank you for choosing our service!</p>
</body>
</html>
