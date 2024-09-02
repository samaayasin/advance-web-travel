<?php

namespace App\Http\Controllers;

use App\Models\BookingCar;
use App\Models\Car;
use Illuminate\Http\Request;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Illuminate\Support\Facades\Log;
use App\Mail\BookingCreated;
use App\Mail\BookingUpdated;
use App\Mail\BookingDeleted;
use App\Mail\CarBookingCreated;
use App\Mail\CarBookingDeleted;
use App\Mail\CarBookingUpdated;
use Illuminate\Support\Facades\Mail;

/**
 * @OA\Schema(
 *     schema="BookingCar",
 *     type="object",
 *     title="BookingCar",
 *     required={"UserID", "CarRentalID", "Location", "TotalPrice", "StartDate", "EndDate"},
 *     @OA\Property(property="UserID", type="integer", description="ID of the user who made the booking"),
 *     @OA\Property(property="CarRentalID", type="integer", description="ID of the car rental being booked"),
 *     @OA\Property(property="CarModel", type="string", description="Model of the car being booked"),
 *     @OA\Property(property="Location", type="string", description="Location where the car will be picked up"),
 *     @OA\Property(property="TotalPrice", type="number", format="float", description="Total price for the booking"),
 *     @OA\Property(property="StartDate", type="string", format="date", description="Start date of the booking"),
 *     @OA\Property(property="EndDate", type="string", format="date", description="End date of the booking")
 * )
 */
class BookingCarController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/booking/cars",
     *     summary="Get all car bookings by the authenticated user",
     *     tags={"Cars"},
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of all car bookings by the user",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/BookingCar"))
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No car bookings found"
     *     )
     * )
     */
    public function show()
    {
        $userId = Auth::id();
        $cars = BookingCar::where('UserID', $userId)->get();
        if ($cars->isEmpty()) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return response()->json(['status' => 'success', 'length' => sizeof($cars), 'cars' => $cars], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/booking/cars",
     *     summary="Create a new car booking",
     *     tags={"Cars"},
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/BookingCar")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Car booking created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/BookingCar")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Car not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Booking creation failed"
     *     )
     * )
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'CarRentalID' => 'required|exists:cars,CarRentalID',
            'Location' => 'required|string',
            'StartDate' => 'required|date_format:Y-m-d',
            'EndDate' => 'required|date|date_format:Y-m-d|after_or_equal:StartDate',
        ]);

        $car = Car::where('CarRentalID', $validatedData['CarRentalID'])->first();

        if (!$car) {
            return response()->json(['message' => 'Car Not Found'], 404);
        }
        $available = BookingCar::where('CarRentalID', $validatedData['CarRentalID'])
            ->where(function ($query) use ($validatedData) {
                $query->whereBetween('StartDate', [$validatedData['StartDate'], $validatedData['EndDate']])
                    ->orWhereBetween('EndDate', [$validatedData['StartDate'], $validatedData['EndDate']])
                    ->orWhere(function ($query) use ($validatedData) {
                        $query->where('StartDate', '<=', $validatedData['StartDate'])
                            ->where('EndDate', '>=', $validatedData['EndDate']);
                    });
            })->exists();

        if ($available) {
            return response()->json(['message' => 'Car Not Available'], 404);
        }

        $start = new DateTime($validatedData['StartDate']);
        $end = new DateTime($validatedData['EndDate']);

        $totalDays = $end->diff($start)->days + 1;

        $totalPrice = $car->PricePerDay * $totalDays;

        $booking = new BookingCar([
            'UserID' =>  Auth::id(),
            'CarRentalID' => $car->CarRentalID,
            'CarModel' => $car->CarModel,
            'Location' => $validatedData['Location'],
            'TotalPrice' => $totalPrice,
            'StartDate' => $validatedData['StartDate'],
            'EndDate' => $validatedData['EndDate'],
        ]);

        try {
            $booking->save();
            Mail::to(Auth::user()->Email)->send(new CarBookingCreated($booking));
        } catch (\Exception $e) {
            Log::error('Booking failed: ' . $e->getMessage());
            return response()->json(['message' => 'Booking failed', 'error' => $e->getMessage()], 500);
        }
        return response()->json(['Status' => 'Successfully booked', 'Booking' => $booking], 201);
    }



    /**
     * @OA\Put(
     *     path="/api/booking/cars/{id}",
     *     summary="Update an existing car booking",
     *     tags={"Cars"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the booking to update"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/BookingCar")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Car booking updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/BookingCar")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Car not available or booking not found"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="No booking found for this user"
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
            'StartDate' => 'required|date_format:Y-m-d',
            'EndDate' => 'required|date|date_format:Y-m-d|after_or_equal:StartDate',
        ]);

        $booking = BookingCar::where('UserID', Auth::id())->where('BookingID', $id)->first();

        if (!$booking) {
            return response()->json(['massege' => 'No booking'], 403);
        }
        $available = BookingCar::where('CarRentalID', $booking->CarRentalID)
            ->whereBetween('StartDate', [$validatedData['StartDate'], $validatedData['EndDate']])
            ->orWhereBetween('EndDate', [$validatedData['StartDate'], $validatedData['EndDate']])
            ->where('BookingID', '!=', $id)
            ->exists();

        if ($available) {
            return response()->json(['message' => 'Car Not Available'], 404);
        }

        $booking->StartDate = $validatedData['StartDate'];
        $booking->EndDate = $validatedData['EndDate'];
        $car = Car::where('CarRentalID', $booking->CarRentalID)->first();
        if ($car) {
            $start = new DateTime($validatedData['StartDate']);
            $end = new DateTime($validatedData['EndDate']);
            $totalDays = $end->diff($start)->days + 1;
            $booking->TotalPrice = $car->PricePerDay * $totalDays;
        }

        try {
            $booking->save();
            Mail::to(Auth::user()->Email)->send(new CarBookingUpdated($booking));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Booking failed', 'error' => $e->getMessage()], 500);
        }
        return response()->json(['Status' => 'Successfully Updated', 'Booking' => $booking], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/booking/cars/{id}",
     *     summary="Cancel a car booking",
     *     tags={"Cars"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the booking to cancel"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Car booking canceled successfully",
     *         @OA\JsonContent(ref="#/components/schemas/BookingCar")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Booking not found"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="No booking found for this user"
     *     )
     * )
     */
    public function cancel($id)
    {

        $booking = BookingCar::where('UserID', Auth::id())->where('BookingID', $id)->first();
        if (!$booking) {
            return response()->json(['massege' => 'No booking'], 403);
        }
        $booking->delete();
        Mail::to(Auth::user()->Email)->send(new CarBookingDeleted($booking));

        return response()->json(['Status' => 'Successfully Deleated'], 200);
    }
}
