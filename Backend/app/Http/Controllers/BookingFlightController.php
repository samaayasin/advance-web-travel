<?php

namespace App\Http\Controllers;

use App\Models\BookingFlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingFlightController extends Controller
{

    public function __construct()
    {

    }

    public function getFlight(){


        Log::error("error");
        $flight = BookingFlight::all();
        return response($flight);

    }
    public function search(Request $request)
    {
        
    }
}


