<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory;
    protected $primaryKey = 'UserID';

    protected $fillable = [
        'Name',
        'Email',
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

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
