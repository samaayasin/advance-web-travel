<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $table = 'hotels';

    protected $primaryKey = 'HotelID';

    protected $fillable = [
        'UserID',
        'HotelName',
        'rating',
        'PricePerNight',
        'Availability',
        'StartDate',
        'EndDate',
        'city',
        'country',
        'description',
        'image_url',
        'number_of_guests'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }

    public function bookingHotels(){
        return $this->hasMany(BookingHotel::class, 'HotelID', 'HotelID');

    }
    
}