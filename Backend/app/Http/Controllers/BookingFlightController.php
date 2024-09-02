<?php

namespace App\Http\Controllers;

use App\Mail\FlightBookingCreated;
use App\Mail\FlightBookingDeleted;
use App\Mail\FlightBookingUpdated;
use App\Models\BookingFlight;
use App\Models\Flight;
use App\Models\User;
use App\Notifications\BookFlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;



/**
 * @OA\Schema(
 *     schema="BookingFlight",
 *     type="object",
 *     title="BookingFlight",
 *     required={"UserID", "FlightID", "Numberofpassengers", "TotalPrice", "ArrivalTime"},
 *     @OA\Property(property="UserID", type="integer"),
 *     @OA\Property(property="FlightID", type="integer"),
 *     @OA\Property(property="Numberofpassengers", type="integer"),
 *     @OA\Property(property="TotalPrice", type="number", format="float"),
 *     @OA\Property(property="ArrivalTime", type="string", format="date-time")
 * )
 */

class BookingFlightController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/booking/flights",
     *     summary="Get all flights booked by the authenticated user",
     *     tags={"Flights"},
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of all flights booked by the user",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/BookingFlight"))
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found"
     *     )
     * )
     */

    public function show()
    {
        $userId = Auth::id();
        $flight = BookingFlight::where('UserID', $userId)->get();
        if (!$flight) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return response()->json(['status' => 'success', 'length' => sizeof($flight), 'flights' => $flight], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/booking/flights",
     *     summary="Add a new flight booking for the authenticated user",
     *     tags={"Flights"},
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/BookingFlight")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Flight booking added",
     *         @OA\JsonContent(ref="#/components/schemas/BookingFlight")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Flight Not Found"
     *     ),
     *     @OA\Response(
     *         response=409,
     *         description="You have already booked this flight"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation errors"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Booking failed"
     *     )
     * )
     */

    public function create(Request $request)
    {

        $validatedData = $request->validate([
            'FlightID' => 'required|exists:flights,FlightID',
            'Numberofpassengers' => 'required',
        ]);

        $userId = Auth::id();
        $flightId = $validatedData['FlightID'];

        $existingBooking = BookingFlight::where('UserID', $userId)
            ->where('FlightID', $flightId)
            ->first();

        if ($existingBooking) {
            return response()->json(['message' => 'You have already booked this flight'], 409);
        }

        $flight = Flight::where('FlightID', $flightId)->first();
        if (!$flight) {
            return response()->json(['message' => 'Flight Not Found'], 404);
        }

        $totalPrice = $flight->Price * $validatedData['Numberofpassengers'];

        $newBooking = new BookingFlight([
            'UserID' => $userId,
            'FlightID' => $flightId,
            'Numberofpassengers' => $validatedData['Numberofpassengers'],
            'TotalPrice' => $totalPrice,
            'ArrivalTime' => $flight->ArrivalTime,
        ]);

        try {
            $newBooking->save();
            Mail::to(Auth::user()->Email)->send(new FlightBookingCreated($newBooking));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Booking failed', 'error' => $e->getMessage()], 500);
        }
        return response()->json(['Status' => 'Successfully Created', 'Booking' => $newBooking], 201);
    }

    /**
     * @OA\Put(
     *     path="/api/booking/flights/{id}",
     *     summary="Update a flight booking for the authenticated user",
     *     tags={"Flights"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/BookingFlight")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Flight booking updated",
     *         @OA\JsonContent(ref="#/components/schemas/BookingFlight")
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="No booking"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Flight Not Found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Booking update failed"
     *     )
     * )
     */

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Numberofpassengers' => 'required',
        ]);
        $booking = BookingFlight::where('UserID', Auth::id())->where('BookingID', $id)->first();
        if (!$booking) {
            return response()->json(['massege' => 'No booking'], 403);
        }
        $booking->Numberofpassengers = $validatedData['Numberofpassengers'];

        $flight = Flight::where('FlightID', $booking->FlightID)->first();

        if ($flight) {
            $totalPrice = $flight->Price * $validatedData['Numberofpassengers'];
            $booking->TotalPrice = $totalPrice;
        }

        try {
            $booking->save();
            Mail::to(Auth::user()->Email)->send(new FlightBookingUpdated($booking));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Booking failed', 'error' => $e->getMessage()], 500);
        }
        return response()->json(['Status' => 'Successfully Updated', 'Booking' => $booking], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/booking/flights/{id}",
     *     summary="Cancel a flight booking for the authenticated user",
     *     tags={"Flights"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Flight booking canceled",
     *         @OA\JsonContent(ref="#/components/schemas/BookingFlight")
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="No booking"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Booking not found"
     *     )
     * )
     */

    public function cancel($id)
    {

        $booking = BookingFlight::where('UserID', Auth::id())->where('BookingID', $id)->first();

        if (!$booking) {
            return response()->json(['massege' => 'No booking'], 403);
        }

        $booking->delete();
        Mail::to(Auth::user()->Email)->send(new FlightBookingDeleted($booking));

        return response()->json(['Status' => 'Successfully Deleated'], 200);
    }
}
