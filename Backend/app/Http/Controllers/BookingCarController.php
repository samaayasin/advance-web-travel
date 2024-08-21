<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


/**
 * @OA\Schema(
 *     schema="BookingCar",
 *     type="object",
 *     title="BookingCar",
 *     required={"UserID", "CarModel", "SeatNumber", "Location", "PricePerDay", "Availability", "StartDate", "EndDate"},
 *     @OA\Property(property="UserID", type="integer"),
 *     @OA\Property(property="CarModel", type="string"),
 *     @OA\Property(property="SeatNumber", type="integer"),
 *     @OA\Property(property="Location", type="string"),
 *     @OA\Property(property="PricePerDay", type="number", format="float"),
 *     @OA\Property(property="Availability", type="boolean"),
 *     @OA\Property(property="StartDate", type="string", format="date"),
 *     @OA\Property(property="EndDate", type="string", format="date")
 * )
 */
class BookingCarController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/booking/cars",
     *     summary="Get all cars",
     *     tags={"Cars"},
     *     @OA\Response(
     *         response=200,
     *         description="List of all cars",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/BookingCar"))
     *     )
     * )
     */
    public function show_all_cars() {}

    /**
     * @OA\Post(
     *     path="/api/booking/cars",
     *     summary="Add a new car booking",
     *      tags={"Cars"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/BookingCar")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Car booking added",
     *         @OA\JsonContent(ref="#/components/schemas/BookingCar")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation errors"
     *     )
     * )
     */
    public function booking_car() {}

    /**
     * @OA\Put(
     *     path="/api/booking/cars/{id}",
     *     summary="Update a car booking",
     * tags={"Cars"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/BookingCar")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Car booking updated",
     *         @OA\JsonContent(ref="#/components/schemas/BookingCar")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Car booking not found"
     *     )
     * )
     */
    public function update_booking_car($id) {}

    /**
     * @OA\Delete(
     *     path="/api/booking/cars/{id}",
     *     summary="Cancel a car booking",
     * tags={"Cars"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Car booking canceled",
     *         @OA\JsonContent(ref="#/components/schemas/BookingCar")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Car booking not found"
     *     )
     * )
     */
    public function cancel_booking_car($id) {}
}
