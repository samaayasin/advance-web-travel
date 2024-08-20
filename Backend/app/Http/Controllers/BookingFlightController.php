<?php

namespace App\Http\Controllers;

use App\Models\BookingFlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
/**
 * @OA\Schema(
 *     schema="BookingFlight",
 *     type="object",
 *     title="BookingFlight",
 *     required={"id", "flight_number"},
 *     properties={
 *         @OA\Property(property="id", type="integer"),
 *         @OA\Property(property="flight_number", type="string"),
 *         @OA\Property(property="arrival", type="string"),
 *         @OA\Property(property="price", type="number")
 *     }
 * )
 */

class BookingFlightController extends Controller
{

    public function __construct()
    {

    }
    /**
     * @OA\Get(
     *     path="/get/flights",
     *     tags={"Booking Flight"},
     *     summary="Get all flights",
     *     description="Returns list of all booked flights",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/BookingFlight")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function getFlight(){


        Log::error("error");
        $flight = BookingFlight::all();
        return response($flight);

    }
    /**
     * @OA\Get(
     *     path="/search/flights",
     *     tags={"Booking Flight"},
     *     summary="Search flights",
     *     description="Search flights based on criteria",
     *     @OA\Parameter(
     *         name="query",
     *         in="query",
     *         description="Search criteria",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     )
     * )
     */
    public function search(Request $request)
    {
        
    }
}


