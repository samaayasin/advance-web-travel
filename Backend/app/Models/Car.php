<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $primaryKey = 'CarRentalID';

    protected $fillable = [
        'UserID',
        'CarModel',
        'Year',
        'Color',
        'PricePerDay',
        'Availability',
        'image_url'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }

    public function bookingCars(){
        return $this->hasMany(BookingCar::class, 'CarID', 'CarRentalID');

    }
    
}