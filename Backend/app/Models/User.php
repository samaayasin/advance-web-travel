<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
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
        return $this->hasMany(Notification::class, 'UserID', 'UserID');
    }

    public function bookingFlights()
    {
        return $this->hasMany(BookingFlight::class, 'UserID', 'UserID');
    }

    public function bookingCars()
    {
        return $this->hasMany(BookingCar::class, 'UserID', 'UserID');
    }

    public function bookingHotels()
    {
        return $this->hasMany(BookingHotel::class, 'UserID', 'UserID');
    }
}
