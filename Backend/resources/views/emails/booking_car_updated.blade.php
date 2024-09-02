<html>
<body>
    <h1>Your car booking has been updated.</h1>
    <p>Dear {{ Auth::user()->Name }},</p>
    <p>Your booking for the car has been successfully updated.</p>
    <p><strong>Location:</strong> {{ $location }}</p>
    <p><strong>Total Price:</strong> ${{ $totalPrice }}</p>
    <p>Thank you :) </p>
</body>
</html>
