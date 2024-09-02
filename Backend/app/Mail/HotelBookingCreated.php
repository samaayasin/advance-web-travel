<?php

namespace App\Mail;

use App\Models\BookingHotel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class HotelBookingCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;


    public function __construct(BookingHotel $booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        return $this->subject('Your Hotel Booking Confirmed')
                    ->view('emails.hotel_booking_created')
                    ->with([
                        'bookingID' => $this->booking->BookingID,
                        'totalPrice' => $this->booking->TotalPrice,
                        'startDate' => $this->booking->StartDate,
                        'endDate' => $this->booking->EndDate,
                    ]);
    }
}
