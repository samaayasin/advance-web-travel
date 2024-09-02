<html>
<body>
    <h1>Your Car Booking has been Confirmed</h1>
    <p>Dear {{ Auth::user()->Name }},</p>
    <p>Your booking for the car has been successfully created.</p>
    <p><strong>Location:</strong> {{ $location }}</p>
    <p><strong>Total Price:</strong> ${{ $totalPrice }}</p>
    <p>Thank you for booking with us!</p>
</body>
</html>
