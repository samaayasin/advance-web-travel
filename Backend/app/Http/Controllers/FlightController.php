<?php

namespace App\Http\Controllers;

use App\Models\BookingFlight;
use Illuminate\Http\Request;

/**
 *     @OA\Schema(
 *         schema="BookingFlight",
 *         type="object",
 *         title="BookingFlight",
 *         required={"UserID", "AirlineName", "DepartureAirport", "ArrivalAirport", "DepartureTime", "ArrivalTime", "Price", "StartDate", "EndDate"},
 *         @OA\Property(property="UserID", type="integer", description="The ID of the user"),
 *         @OA\Property(property="AirlineName", type="string", description="Name of the airline"),
 *         @OA\Property(property="DepartureAirport", type="string", description="Departure airport"),
 *         @OA\Property(property="ArrivalAirport", type="string", description="Arrival airport"),
 *         @OA\Property(property="DepartureTime", type="string", format="date-time", description="Departure time"),
 *         @OA\Property(property="ArrivalTime", type="string", format="date-time", description="Arrival time"),
 *         @OA\Property(property="Price", type="number", format="float", description="Price of the flight"),
 *         @OA\Property(property="StartDate", type="string", format="date", description="Booking start date"),
 *         @OA\Property(property="EndDate", type="string", format="date", description="Booking end date")
 *     )
 */
class FlightController extends Controller{
    /**
     * @OA\Get(
     *     path="/api/booking/flights",
     *     operationId="getAllFlights",
     *     tags={"Flights"},
     *     summary="Get list of all flights",
     *     description="Returns a list of all flights",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/BookingFlight"))
     *     )
     * )
     */
    public function show_all_flight(){}
    

    /**
     * @OA\Get(
     *     path="/api/booking/flights/{id}",
     *     operationId="getFlightById",
     *     tags={"Flights"},
     *     summary="Get a flight by ID",
     *     description="Returns a specific flight by its ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/BookingFlight")
     *     ),
     *     @OA\Response(response=404, description="Flight not found")
     * )
     */
    public function show_flight($id){}
   
    /**
     * @OA\Post(
     *     path="/api/booking/flights",
     *     operationId="createFlightBooking",
     *     tags={"Flights"},
     *     summary="Add a new flight booking",
     *     description="Creates a new flight booking",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/BookingFlight")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Booking created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/BookingFlight")
     *     ),
     *     @OA\Response(response=422, description="Validation errors")
     * )
     */
    public function add_booking_flight(Request $request){}
   

    /**
     * @OA\Delete(
     *     path="/api/booking/flights/{id}",
     *     operationId="cancelFlightBooking",
     *     tags={"Flights"},
     *     summary="Cancel a flight booking",
     *     description="Cancels a flight booking by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Booking canceled successfully",
     *         @OA\JsonContent(ref="#/components/schemas/BookingFlight")
     *     ),
     *     @OA\Response(response=404, description="Flight not found")
     * )
     */
    public function cancel_booking_flight($id){}
    
}
