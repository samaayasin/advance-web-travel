<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingHotel extends Model
{
    use HasFactory;


    protected $primaryKey = 'BookingID';

    protected $fillable = [
        'UserID',
        'HotelID',
        'TotalPrice',
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
