<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


/**
 * @OA\Schema(
 *     schema="BookingHotel",
 *     type="object",
 *     title="BookingHotel",
 *     required={"UserID", "HotelName", "Location", "RoomType", "PricePerNight", "Availability", "StartDate", "EndDate"},
 *     @OA\Property(property="UserID", type="integer"),
 *     @OA\Property(property="HotelName", type="string"),
 *     @OA\Property(property="Location", type="string"),
 *     @OA\Property(property="RoomType", type="string"),
 *     @OA\Property(property="PricePerNight", type="number", format="float"),
 *     @OA\Property(property="Availability", type="boolean"),
 *     @OA\Property(property="StartDate", type="string", format="date"),
 *     @OA\Property(property="EndDate", type="string", format="date")
 * )
 */

class HotelController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/booking/hotels",
     *     summary="Get all hotels",
     *     tags={"Hotel"},
     *     @OA\Response(
     *         response=200,
     *         description="List of all hotels",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/BookingHotel"))
     *     )
     * )
     */
    public function show_all_hotels() {}


    /**
     * @OA\Post(
     *     path="/api/booking/hotels",
     *     summary="Add a new hotel booking",
     *     tags={"Hotel"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/BookingHotel")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Hotel booking added",
     *         @OA\JsonContent(ref="#/components/schemas/BookingHotel")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation errors"
     *     )
     * )
     */
    public function booking_hotel() {}


    /**
     * @OA\Put(
     *     path="/api/booking/hotels/{id}",
     *     summary="Update a hotel booking",
     *     tags={"Hotel"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/BookingHotel")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Hotel booking updated",
     *         @OA\JsonContent(ref="#/components/schemas/BookingHotel")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Hotel booking not found"
     *     )
     * )
     */
    public function update_booking_hotel($id) {}


    /**
     * @OA\Delete(
     *     path="/api/booking/hotels/{id}",
     *     summary="Cancel a hotel booking",
     *     tags={"Hotel"},
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
     *         description="Hotel booking not found"
     *     )
     * )
     */
    public function cancel_booking_hotel($id) {}
}
