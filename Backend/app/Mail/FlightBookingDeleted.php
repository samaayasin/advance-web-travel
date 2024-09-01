<?php

namespace App\Mail;

use App\Models\BookingFlight;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FlightBookingDeleted extends Mailable
{
    use Queueable, SerializesModels;
    
    public $booking;

    public function __construct(BookingFlight $booking)
    {
        $this->booking = $booking;
    }
    public function build()
    {
        return $this->subject('Your Flight Booking Canceled')
                    ->view('emails.flight_booking_deleted')
                    ->with([
                        'bookingID' => $this->booking->BookingID,
                        'arrivalTime' => $this->booking->ArrivalTime,
                    ]);
    }
}
