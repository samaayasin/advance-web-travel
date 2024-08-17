<?php

namespace App\Http\Controllers;

use App\Models\BookingCar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class BookingCarController extends Controller
{
    public function __construct()
    {

    }

    public function getCar(){


        Log::error("error");
        $car = BookingCar::all();
        return response($car);

    }
    public function search(Request $request)
    {

    }
}
