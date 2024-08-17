<?php

namespace App\Http\Controllers;

use App\Models\BookingHotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class BookingHotelController extends Controller
{
    public function __construct()
    {

    }

    public function getHotel(){


        Log::error("error");
        $hotel = BookingHotel::all();
        return response($hotel);

    }
    public function search(Request $request)
    {
        
    }
}
