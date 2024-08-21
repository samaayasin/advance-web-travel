<?php

namespace App\Http\Controllers;

use App\Models\BookingHotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
/**
 * @OA\Schema(
 *     schema="SearchingHotel",
 *     type="object",
 *     title="SearchingHotel",
 *     required={"id", "hotel_name"},
 *     properties={
 *         @OA\Property(property="id", type="integer"),
 *         @OA\Property(property="hotel_name", type="string"),
 *         @OA\Property(property="location", type="string"),
 *         @OA\Property(property="price", type="number"),
 *         @OA\Property(property="rating", type="number", format="float")
 *     }
 * )
 */
class BookingHotelController extends Controller
{
    public function __construct()
    {

    }
 /**
     * @OA\Get(
     *     path="/get/hotels",
     *     tags={"Searching Hotel"},
     *     summary="Get all hotels",
     *     description="Returns a list of all booked hotels",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/SearchingHotel")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function getHotel(){


        Log::error("error");
        $hotel = BookingHotel::all();
        return response($hotel);

    }
    /**
     * @OA\Get(
     *     path="/search/hotels",
     *     tags={"Searching Hotel"},
     *     summary="Search hotels",
     *     description="Search hotels based on criteria",
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
