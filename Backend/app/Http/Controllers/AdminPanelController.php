<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\BookingCar;
use App\Models\BookingFlight;
use App\Models\BookingHotel;

/**
 * @OA\Schema(
 *     schema="Booking",
 *     type="object",
 *     title="Booking",
 *     required={"id", "type", "user_id"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="The unique identifier of the booking",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="type",
 *         type="string",
 *         description="The type of the booking, e.g., hotel, flight",
 *         example="hotel"
 *     ),
 *     @OA\Property(
 *         property="user_id",
 *         type="integer",
 *         description="The ID of the user who made the booking",
 *         example=42
 *     )
 *    
 *     
 * )
 */
class AdminPanelController extends Controller
{
    /**
     * @OA\Get(
     *     path="/bookings",
     *     operationId="getAllBookings",
     *     tags={"Bookings"},
     *     summary="Get list of all bookings",
     *     description="Returns a list of all bookings",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Booking")
     *         )
     *     )
     * )
     */
    public function listAll()
    {
    }

    public function show($type, $id)
    {    
    }

    public function store(Request $request, $type)
    {   
    }

    public function update(Request $request, $type, $id)
    {
    }

    public function delete($type, $id)
    {
    }

    public function getAllUsers()
    {  
    }

    public function showUser($id)
    {  
    }

    public function createUser(Request $request)
    {  
    }

    public function updateUser(Request $request, $id)
    {  
    }

    public function deleteUser($id)
    {
    }

}

