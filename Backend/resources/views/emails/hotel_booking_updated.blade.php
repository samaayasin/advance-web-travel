<!DOCTYPE html>
<html>
<head>
    <title>Your Hotel Booking Updated</title>
</head>
<body>
    <h1>Booking Update</h1>
    <p>Dear {{ Auth::user()->Name }},</p>
    <p>Your hotel booking has been updated.</p>
    <p><strong>Booking ID:</strong> {{ $bookingID }}</p>
    <p><strong>Total Price:</strong> ${{ $totalPrice }}</p>
    <p><strong>Start Date:</strong> {{ $startDate }}</p>
    <p><strong>End Date:</strong> {{ $endDate }}</p>
    <p>Thank you for choosing our service!</p>
</body>
</html>
