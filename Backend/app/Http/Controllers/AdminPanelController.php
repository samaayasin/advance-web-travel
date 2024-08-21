<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Flight;
use App\Models\Hotel;

/**
 * @OA\Components(
 *     @OA\Schema(
 *         schema="Booking",
 *         type="object",
 *         title="Booking",
 *         required={"id", "type", "user_id"},
 *         @OA\Property(
 *             property="id",
 *             type="integer",
 *             description="The unique identifier of the booking",
 *             example=1
 *         ),
 *         @OA\Property(
 *             property="type",
 *             type="string",
 *             description="The type of the booking, e.g., hotel, flight",
 *             example="hotel"
 *         ),
 *         @OA\Property(
 *             property="user_id",
 *             type="integer",
 *             description="The ID of the user who made the booking",
 *             example=42
 *         )
 *     ),
 *     @OA\Schema(
 *         schema="User",
 *         type="object",
 *         title="User",
 *         required={"id", "name", "email"},
 *         @OA\Property(
 *             property="id",
 *             type="integer",
 *             description="The user ID"
 *         ),
 *         @OA\Property(
 *             property="name",
 *             type="string",
 *             description="The name of the user"
 *         ),
 *         @OA\Property(
 *             property="email",
 *             type="string",
 *             format="email",
 *             description="The email address of the user"
 *         )
 *     )
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

    /**
     * @OA\Get(
     *     path="/bookings/{type}/{id}",
     *     operationId="showBooking",
     *     tags={"Bookings"},
     *     summary="Show a specific booking",
     *     description="Return details for specific booking",
     *     @OA\Parameter(
     *         name="type",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Booking")
     *     ),
     *     @OA\Response(response=404, description="Booking not found")
     * )
     */
    public function show($type, $id)
    {    
    }

    /**
     * @OA\Post(
     *     path="/bookings/{type}",
     *     operationId="storeBooking",
     *     tags={"Bookings"},
     *     summary="Create a new booking",
     *     description="Creates a new booking for the given type (car,flight or hotel)",
     *     @OA\Parameter(
     *         name="type",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Booking")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Booking created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Booking")
     *     )
     * )
     */

    public function store(Request $request, $type)
    {   
    }
/**
     * @OA\Put(
     *     path="/bookings/{type}/{id}",
     *     operationId="updateBooking",
     *     tags={"Bookings"},
     *     summary="Update an existing booking",
     *     description="Updates a booking by ID",
     *     @OA\Parameter(
     *         name="type",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Booking")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Booking updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Booking")
     *     )
     * )
     */
    public function update(Request $request, $type, $id)
    {
    }
 /**
     * @OA\Delete(
     *     path="/bookings/{type}/{id}",
     *     operationId="deleteBooking",
     *     tags={"Bookings"},
     *     summary="Delete a booking",
     *     description="Delete a booking by ID",
     *     @OA\Parameter(
     *         name="type",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=204, description="Booking deleted successfully")
     * )
     */
    public function delete($type, $id)
    {
    }
/**
     * @OA\Get(
     *     path="/users",
     *     operationId="getAllUsers",
     *     tags={"Users"},
     *     summary="List all users",
     *     description="Returns a list of all users",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/User")
     *         )
     *     )
     * )
     */
    public function getAllUsers()
    {  
    }

    /**
     * @OA\Get(
     *     path="/users/{id}",
     *     operationId="showUser",
     *     tags={"Users"},
     *     summary="Show a specific user",
     *     description="Returns specific user",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(response=404, description="User not found")
     * )
     */
    public function showUser($id)
    {  
    }
/**
     * @OA\Post(
     *     path="/users",
     *     operationId="createUser",
     *     tags={"Users"},
     *     summary="Create a new user",
     *     description="Creates a new user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     )
     * )
     */
    public function createUser(Request $request)
    {  
    }
     /**
     * @OA\Put(
     *     path="/users/{id}",
     *     operationId="updateUser",
     *     tags={"Users"},
     *     summary="Update an existing user",
     *     description="Updates a user by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     )
     * )
     */

    public function updateUser(Request $request, $id)
    {  
    }
    /**
     * @OA\Delete(
     *     path="/users/{id}",
     *     operationId="deleteUser",
     *     tags={"Users"},
     *     summary="Delete a user",
     *     description="Deletes a user by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=204, description="User deleted successfully")
     * )
     */

    public function deleteUser($id)
    {
    }

}

