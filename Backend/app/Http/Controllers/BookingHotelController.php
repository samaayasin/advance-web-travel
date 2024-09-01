<?php

namespace App\Http\Controllers;

use App\Mail\HotelBookingCreated;
use App\Mail\HotelBookingDeleted;
use App\Mail\HotelBookingUpdated;
use App\Models\BookingHotel;
use App\Models\Hotel;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

/**
 * @OA\Schema(
 *     schema="BookingHotel",
 *     type="object",
 *     title="BookingHotel",
 *     required={"UserID", "HotelID", "TotalPrice", "StartDate", "EndDate"},
 *     @OA\Property(property="UserID", type="integer", description="ID of the user who made the booking"),
 *     @OA\Property(property="HotelID", type="integer", description="ID of the booked hotel"),
 *     @OA\Property(property="TotalPrice", type="number", format="float", description="Total price of the booking"),
 *     @OA\Property(property="StartDate", type="string", format="date", description="Start date of the booking"),
 *     @OA\Property(property="EndDate", type="string", format="date", description="End date of the booking")
 * )
 */

class BookingHotelController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/booking/hotels",
     *     summary="Get all hotel bookings by the authenticated user",
     *     tags={"Hotel"},
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of all hotel bookings by the user",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/BookingHotel"))
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No bookings found for the user"
     *     )
     * )
     */
    public function show()
    {
        $userId = Auth::id();
        $hotels = BookingHotel::where('UserID', $userId)->get();
        if ($hotels->isEmpty()) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return response()->json(['status' => 'success', 'length' => sizeof($hotels), 'hotels' => $hotels], 200);
    }


    /**
     * @OA\Post(
     *     path="/api/booking/hotels",
     *     summary="Add a new hotel booking for the authenticated user",
     *     tags={"Hotel"},
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/BookingHotel")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Hotel booking successfully added",
     *         @OA\JsonContent(ref="#/components/schemas/BookingHotel")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Hotel not found or not available for the selected dates"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation errors"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Booking failed due to a server error"
     *     )
     * )
     */
    public function create(Request $request)
    {

        $validatedData = $request->validate([
            'HotelID' => 'required|exists:hotels,HotelID',
            'StartDate' => 'required|date_format:Y-m-d',
            'EndDate' => 'required|date|date_format:Y-m-d|after_or_equal:StartDate',
        ]);

        $hotel = Hotel::where('HotelID', $validatedData['HotelID'])->first();

        if (!$hotel) {
            return response()->json(['message' => 'Hotel Not Found'], 404);
        }

        $available = BookingHotel::where('HotelID', $validatedData['HotelID'])
            ->where(function ($query) use ($validatedData) {
                $query->whereBetween('StartDate', [$validatedData['StartDate'], $validatedData['EndDate']])
                    ->orWhereBetween('EndDate', [$validatedData['StartDate'], $validatedData['EndDate']])
                    ->orWhere(function ($query) use ($validatedData) {
                        $query->where('StartDate', '<=', $validatedData['StartDate'])
                            ->where('EndDate', '>=', $validatedData['EndDate']);
                    });
            })->exists();

        if ($available) {
            return response()->json(['message' => 'Hotel Not Available'], 404);
        }

        $start = new DateTime($validatedData['StartDate']);
        $end = new DateTime($validatedData['EndDate']);
        $totalDays = $end->diff($start)->days + 1;
        $totalPrice = $hotel->PricePerNight * $totalDays;

        $booking = new BookingHotel([
            'UserID' => Auth::id(),
            'HotelID' => $hotel->HotelID,
            'TotalPrice' => $totalPrice,
            'StartDate' => $validatedData['StartDate'],
            'EndDate' => $validatedData['EndDate'],
        ]);

        try {
            $booking->save();
            Mail::to(Auth::user()->Email)->send(new HotelBookingCreated($booking));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Booking failed', 'error' => $e->getMessage()], 500);
        }

        return response()->json(['Status' => 'Successfully booked', 'Booking' => $booking], 201);
    }


    /**
     * @OA\Put(
     *     path="/api/booking/hotels/{id}",
     *     summary="Update a hotel booking for the authenticated user",
     *     tags={"Hotel"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the booking to update",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/BookingHotel")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Hotel booking successfully updated",
     *         @OA\JsonContent(ref="#/components/schemas/BookingHotel")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Hotel not available for the selected dates or booking not found"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="No booking found for the provided ID and authenticated user"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Booking update failed due to a server error"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'StartDate' => 'required|date_format:Y-m-d',
            'EndDate' => 'required|date|date_format:Y-m-d|after_or_equal:StartDate',
        ]);

        $booking = BookingHotel::where('UserID', Auth::id())->where('BookingID', $id)->first();

        if (!$booking) {
            return response()->json(['message' => 'No booking'], 403);
        }

        $available = BookingHotel::where('HotelID', $booking->HotelID)
            ->whereBetween('StartDate', [$validatedData['StartDate'], $validatedData['EndDate']])
            ->orWhereBetween('EndDate', [$validatedData['StartDate'], $validatedData['EndDate']])
            ->where('BookingID', '!=', $id)
            ->exists();

        if ($available) {
            return response()->json(['message' => 'Hotel Not Available'], 404);
        }

        $booking->StartDate = $validatedData['StartDate'];
        $booking->EndDate = $validatedData['EndDate'];

        $hotel = Hotel::where('HotelID', $booking->HotelID)->first();

        if ($hotel) {
            $start = new DateTime($validatedData['StartDate']);
            $end = new DateTime($validatedData['EndDate']);
            $totalDays = $end->diff($start)->days + 1;
            $booking->TotalPrice = $hotel->PricePerNight * $totalDays;
        }

        try {
            $booking->save();
            Mail::to(Auth::user()->Email)->send(new HotelBookingUpdated($booking));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Booking update failed', 'error' => $e->getMessage()], 500);
        }

        return response()->json(['Status' => 'Successfully Updated', 'Booking' => $booking], 200);
    }


    /**
     * @OA\Delete(
     *     path="/api/booking/hotels/{id}",
     *     summary="Cancel a hotel booking for the authenticated user",
     *     tags={"Hotel"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Hotel booking canceled",
     *         @OA\JsonContent(ref="#/components/schemas/BookingHotel")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Booking not found"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="No booking"
     *     )
     * )
     */

    public function cancel($id)
    {
        $booking = BookingHotel::where('UserID', Auth::id())->where('BookingID', $id)->first();

        if (!$booking) {
            return response()->json(['message' => 'No booking'], 403);
        }

        $booking->delete();
        Mail::to(Auth::user()->Email)->send(new HotelBookingDeleted($booking));


        return response()->json(['Status' => 'Successfully Deleated'], 200);
    }
}
