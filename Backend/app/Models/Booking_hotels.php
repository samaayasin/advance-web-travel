<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bookinghotel extends Model
{
    use HasFactory;


    protected $primaryKey = 'HotelID';

    protected $fillable = [
        'UserID',
        'HotelName',
        'Location',
        'RoomType',
        'PricePerNight',
        'Availability',
        'StartDate',
        'EndDate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'booking', 'BookingType', 'BookingID');
    }
}
