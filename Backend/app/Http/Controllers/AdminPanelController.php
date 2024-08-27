<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Flight;
use App\Models\Hotel;

/**
 * @OA\Schema(
 *     schema="Booking",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=2),
 *     @OA\Property(property="booking_date", type="string", format="date-time", example="2024-08-21T00:00:00Z")
 * )
 * 
 * @OA\Schema(
 *     schema="AvailableItem",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Sample Item")
 * )
 */
class AdminPanelController extends Controller
{
    /**
     * @OA\Get(
     *     path="/bookings",
     *     summary="List all bookings",
     *     operationId="listAllBookings",
     *     tags={"Bookings"},
     *     @OA\Response(
     *         response="200",
     *         description="A list of bookings",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Booking")
     *         )
     *     )
     * )
     */
    public function listAll()
    {
        $cars = Car::all();
        $flights = Flight::all();
        $hotels = Hotel::all();

        $bookings = $cars->merge($flights)->merge($hotels);

        return response()->json($bookings, 200);
    }


    /**
     * @OA\Get(
     *     path="/bookings/{type}/{id}",
     *     summary="Show a specific booking",
     *     operationId="showBooking",
     *     tags={"Bookings"},
     *     @OA\Parameter(
     *         name="type",
     *         in="path",
     *         required=true,
     *         description="Type of the booking",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the booking",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Details of the specified booking",
     *         @OA\JsonContent(ref="#/components/schemas/Booking")
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Booking not found"
     *     )
     * )
     */
    public function show($type, $id)
    {
        switch ($type) {
            case 'car':
                $booking = Car::find($id);
                break;
            case 'flight':
                $booking = Flight::find($id);
                break;
            case 'hotel':
                $booking = Hotel::find($id);
                break;
            default:
                return response()->json(['message' => 'Invalid booking type'], 400);
        }

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        return response()->json($booking, 200);
    }


    /**
     * @OA\Get(
     *     path="/availables",
     *     summary="List all available items",
     *     operationId="listAllAvailables",
     *     tags={"Availables"},
     *     @OA\Response(
     *         response="200",
     *         description="A list of available items",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/AvailableItem")
     *         )
     *     )
     * )
     */
    public function listAllAvailables()
    {
        $cars = Car::all();
        $flights = Flight::all();
        $hotels = Hotel::all();

        $availableItems = $cars->merge($flights)->merge($hotels);

        return response()->json($availableItems, 200);
    }

    public function listAvailableType($type)
    {
        switch ($type) {
            case 'car':
                $item = Car::all();
                break;
            case 'flight':
                $item = Flight::all();
                break;
            case 'hotel':
                $item = Hotel::all();
                break;
            default:
                return response()->json(['message' => 'Invalid available item type'], 400);
        }

        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        return response()->json($item, 200);
    }
    /**
     * @OA\Get(
     *     path="/availables/{type}/{id}",
     *     summary="Show a specific available item",
     *     operationId="showAvailable",
     *     tags={"Availables"},
     *     @OA\Parameter(
     *         name="type",
     *         in="path",
     *         required=true,
     *         description="Type of the available item",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the available item",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Details of the specified available item",
     *         @OA\JsonContent(ref="#/components/schemas/AvailableItem")
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Available item not found"
     *     )
     * )
     */
    public function showAvailable($type, $id)
    {
        switch ($type) {
            case 'car':
                $item = Car::find($id);
                break;
            case 'flight':
                $item = Flight::find($id);
                break;
            case 'hotel':
                $item = Hotel::find($id);
                break;
            default:
                return response()->json(['message' => 'Invalid available item type'], 400);
        }

        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        return response()->json($item, 200);
    }

    /**
     * @OA\Post(
     *     path="/availables/{type}",
     *     summary="Create a new available item",
     *     operationId="storeAvailable",
     *     tags={"Availables"},
     *     @OA\Parameter(
     *         name="type",
     *         in="path",
     *         required=true,
     *         description="Type of the available item",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AvailableItem")
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Item Created Successfully",
     *         @OA\JsonContent(ref="#/components/schemas/AvailableItem")
     *     )
     * )
     */
    public function storeAvailable(Request $request, $type)
    {
        switch ($type) {
            case 'car':
                $item = Car::create($request->all());
                break;
            case 'flight':
                $item = Flight::create($request->all());
                break;
            case 'hotel':
                $item = Hotel::create($request->all());
                break;
            default:
                return response()->json(['message' => 'Invalid available item type'], 400);
        }

        return response()->json($item, 201);
    }

    /**
     * @OA\Put(
     *     path="/availables/{type}/{id}",
     *     summary="Update an available item",
     *     operationId="updateAvailable",
     *     tags={"Availables"},
     *     @OA\Parameter(
     *         name="type",
     *         in="path",
     *         required=true,
     *         description="Type of the available item",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the available item",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AvailableItem")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Item Updated Successfully",
     *         @OA\JsonContent(ref="#/components/schemas/AvailableItem")
     *     )
     * )
     */
    public function updateAvailable(Request $request, $type, $id)
    {
        switch ($type) {
            case 'car':
                $item = Car::find($id);
                break;
            case 'flight':
                $item = Flight::find($id);
                break;
            case 'hotel':
                $item = Hotel::find($id);
                break;
            default:
                return response()->json(['message' => 'Invalid available item type'], 400);
        }

        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $item->update($request->all());

        return response()->json($item, 200);
    }

    /**
     * @OA\Delete(
     *     path="/availables/{type}/{id}",
     *     summary="Delete an available item",
     *     operationId="deleteAvailable",
     *     tags={"Availables"},
     *     @OA\Parameter(
     *         name="type",
     *         in="path",
     *         required=true,
     *         description="Type of the available item",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the available item",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="204",
     *         description="Item Deleted Successfully"
     *     )
     * )
     */
    public function deleteAvailable($type, $id)
    {
        switch ($type) {
            case 'car':
                $item = Car::find($id);
                break;
            case 'flight':
                $item = Flight::find($id);
                break;
            case 'hotel':
                $item = Hotel::find($id);
                break;
            default:
                return response()->json(['message' => 'Invalid available item type'], 400);
        }

        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $item->delete();

        return response()->json(['message' => 'Item deleted successfully'], 204);
    }
}
