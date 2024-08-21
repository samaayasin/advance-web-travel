<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $table = 'flights';

    protected $primaryKey = 'FlightID';

    protected $fillable = [
        'UserID',
        'AirlineName',
        'DepartureAirport',
        'ArrivalAirport',
        'DepartureTime',
        'ArrivalTime',
        'Price',
        'Availability',
        'image_url'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }

    public function bookingFlights(){
        return $this->hasMany(BookingFlight::class, 'FlightID', 'FlightID');

    }
    
}