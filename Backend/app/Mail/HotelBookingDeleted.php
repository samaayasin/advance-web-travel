<?php

namespace App\Mail;

use App\Models\BookingHotel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class HotelBookingDeleted extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(BookingHotel $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Hotel Booking Canceled')
                    ->view('emails.hotel_booking_deleted')
                    ->with([
                        'bookingID' => $this->booking->BookingID,
                        'startDate' => $this->booking->StartDate,
                        'endDate' => $this->booking->EndDate,
                    ]);
    }
}
