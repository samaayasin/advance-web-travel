<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * @OA\Schema(
 *     schema="SearchingCar",
 *     type="object",
 *     title="SearchingCar",
 *     required={"UserID", "CarModel", "SeatNumber", "Location", "PricePerDay", "Availability", "StartDate", "EndDate"},
 *     @OA\Property(property="CarRentalID", type="integer", example=1),
 *     @OA\Property(property="UserID", type="integer", example=1),
 *     @OA\Property(property="CarModel", type="string", example="Toyota Corolla"),
 *     @OA\Property(property="SeatNumber", type="integer", example=5),
 *     @OA\Property(property="Location", type="string", example="New York"),
 *     @OA\Property(property="PricePerDay", type="number", format="float", example="49.99"),
 *     @OA\Property(property="Availability", type="boolean", example=true),
 *     @OA\Property(property="StartDate", type="string", format="date", example="2024-08-20"),
 *     @OA\Property(property="EndDate", type="string", format="date", example="2024-08-25"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-08-19 10:00:00"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-08-19 10:00:00")
 * )
 */
class CarController extends Controller
{
    public function __construct()
    {
        // Constructor code
    }

    /**
     * @OA\Get(
     *     path="/api/get/cars",
     *     summary="Get a list of all car bookings",
     *     tags={"Searching Car"},
     *     @OA\Response(
     *         response=200,
     *         description="A list of car bookings",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/SearchingCar"))
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No bookings found"
     *     )
     * )
     */
    public function getCar()
    {
        Log::error("error");
        $car = Car::all();
        return response($car);
    }
    /**
     * @OA\Get(
     *     path="/api/search/cars",
     *     summary="Search for car bookings",
     *     tags={"Searching Car"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/SearchingCar")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Search results",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/SearchingCar"))
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid search input"
     *     )
     * )
     */
    public function search(Request $request)
    {
        $query = Car::query();

        if ($request->filled('CarModel')) {
            $query->where('CarModel', 'like', '%' . $request->CarModel . '%');
        }

        if ($request->filled('Year')) {
            $query->where('Year', $request->Year);
        }

        if ($request->filled('PricePerDay')) {
            $query->where('PricePerDay', '<=', $request->PricePerDay);
        }

        $cars = $query->get();
        return response()->json($cars);
    }
}
