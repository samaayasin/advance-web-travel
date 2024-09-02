<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CarBookingUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        return $this->view('emails.booking_car_updated')
                    ->with([
                        'totalPrice' => $this->booking->TotalPrice,
                        'location' => $this->booking->Location,
                    ])
                    ->subject('Your Car Booking has been Updated');
    }
}
