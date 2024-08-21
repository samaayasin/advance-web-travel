<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
/**
 * @OA\Schema(
 *     schema="SearchingFlight",
 *     type="object",
 *     title="SearchingFlight",
 *     required={"id", "flight_number"},
 *     properties={
 *         @OA\Property(property="id", type="integer"),
 *         @OA\Property(property="flight_number", type="string"),
 *         @OA\Property(property="arrival", type="string"),
 *         @OA\Property(property="price", type="number")
 *     }
 * )
 */

class FlightController extends Controller
{

    public function __construct()
    {

    }
    /**
     * @OA\Get(
     *     path="/get/flights",
     *     tags={"Searching Flight"},
     *     summary="Get all flights",
     *     description="Returns list of all booked flights",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/SearchingFlight")
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
        $flight = Flight::all();
        return response($flight);

    }
    /**
     * @OA\Get(
     *     path="/search/flights",
     *     tags={"Searching Flight"},
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
        $query = Flight::query();

        if ($request->filled('AirlineName')) {
            $query->where('AirlineName', 'like', '%' . $request->AirlineName . '%');
        }

        if ($request->filled('DepartureAirport')) {
            $query->where('DepartureAirport', 'like', '%' . $request->DepartureAirport . '%');
        }

        if ($request->filled('ArrivalAirport')) {
            $query->where('ArrivalAirport', 'like', '%' . $request->ArrivalAirport . '%');
        }

        if ($request->filled('DepartureTime')) {
            $query->where('DepartureTime', '>=', $request->DepartureTime);
        }

        if ($request->filled('ArrivalTime')) {
            $query->where('ArrivalTime', '<=', $request->ArrivalTime);
        }

        if ($request->filled('Price')) {
            $query->where('Price', '<=', $request->Price);
        }

        $flights = $query->get();
        return response()->json($flights);
    }
}


