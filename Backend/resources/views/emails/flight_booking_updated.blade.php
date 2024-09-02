<!DOCTYPE html>
<html>
<head>
    <title>Your Flight Booking Updated</title>
</head>
<body>
    <h1>Booking Update</h1>
    <p>Dear {{ Auth::user()->Name }},</p>
    <p>Your flight booking has been successfully updated.</p>
    <p><strong>Booking ID:</strong> {{ $bookingID }}</p>
    <p><strong>Number of Passengers:</strong> {{ $numberofpassengers }}</p>
    <p><strong>Total Price:</strong> ${{ $totalPrice }}</p>
    <p><strong>Arrival Time:</strong> {{ $arrivalTime }}</p>
    <p>Thank you for choosing our service!</p>
</body>
</html>
