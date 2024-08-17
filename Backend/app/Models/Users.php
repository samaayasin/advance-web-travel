<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $primaryKey = 'UserID';

    protected $fillable = [
        'Name',
        'EmailAddress',
        'Password',
        'PhoneNumber',
        'ProfilePicture',
        'Role',
    ];

    public function notifications()
    {
        return $this->hasMany(Notifications::class, 'UserID', 'UserID');
    }

    public function bookingFlights()
    {
        return $this->hasMany(Booking_flights::class, 'UserID', 'UserID');
    }

    public function bookingCars()
    {
        return $this->hasMany(Booking_cars::class, 'UserID', 'UserID');
    }

    public function bookingHotels()
    {
        return $this->hasMany(Booking_hotels::class, 'UserID', 'UserID');
    }
}
