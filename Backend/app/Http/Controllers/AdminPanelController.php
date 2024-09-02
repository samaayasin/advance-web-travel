<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Car;
use App\Models\Flight;
use App\Models\Hotel;
use App\Models\BookingCar;
use App\Models\BookingFlight;
use App\Models\BookingHotel;
use App\Models\User;



/**
 * @OA\Component(
 *     schemas={
 *         @OA\Schema(
 *             schema="User",
 *             type="object",
 *             title="User",
 *             description="User schema",
 *             @OA\Property(property="id", type="integer", example=1, description="The user ID"),
 *             @OA\Property(property="name", type="string", example="John Doe", description="The user's name"),
 *             @OA\Property(property="email", type="string", example="john.doe@example.com", description="The user's email address"),
 *             @OA\Property(property="phone_number", type="string", example="+1234567890", description="The user's phone number"),
 *             @OA\Property(property="profile_picture", type="string", nullable=true, example="http://example.com/profile.jpg", description="URL of the user's profile picture"),
 *             @OA\Property(property="role", type="string", example="admin", description="The user's role"),
 *         ),
 *         @OA\Schema(
 *             schema="Booking",
 *             type="object",
 *             title="Booking",
 *             description="Booking schema",
 *             @OA\Property(property="id", type="integer", example=1, description="The booking ID"),
 *             @OA\Property(property="user_id", type="integer", example=1, description="The ID of the user who made the booking"),
 *             @OA\Property(property="service_type", type="string", example="car", description="Type of the service booked (e.g., car, flight, hotel)"),
 *             @OA\Property(property="booking_date", type="string", format="date", example="2024-09-10", description="Date of the booking"),
 *             @OA\Property(property="start_date", type="string", format="date", example="2024-09-15", description="Start date of the service"),
 *             @OA\Property(property="end_date", type="string", format="date", example="2024-09-20", description="End date of the service"),
 *             @OA\Property(property="total_price", type="number", format="float", example=500.00, description="Total price for the booking"),
 * 
 *         ),
 * 
 *         @OA\Schema(
 *             schema="AvailableItem",
 *             type="object",
 *             title="Available Item",
 *             description="Schema for an available item",
 *             @OA\Property(property="id", type="integer", example=1, description="The ID of the item"),
 *             @OA\Property(property="name", type="string", example="Service Name", description="Name of the service item"),
 *             @OA\Property(property="description", type="string", example="Detailed description of the item", description="Description of the service item"),
 *             @OA\Property(property="price", type="number", format="float", example=100.00, description="Price of the item"),
 *             @OA\Property(property="type", type="string", example="car", description="Type of the service item (e.g., car, flight, hotel)"),
 *             @OA\Property(property="available_from", type="string", format="date-time", example="2024-09-01T00:00:00Z", description="Date and time from when the item is available"),
 *             @OA\Property(property="available_to", type="string", format="date-time", example="2024-09-30T00:00:00Z", description="Date and time until when the item is available")
 *         )
 *     
 *     }
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
        $cars = BookingCar::all();
        $flights = BookingFlight::all();
        $hotels = BookingHotel::all();

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
                $booking = BookingCar::find($id);
                break;
            case 'flight':
                $booking = BookingFlight::find($id);
                break;
            case 'hotel':
                $booking = BookingHotel::find($id);
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
 *     path="/bookings/{type}",
 *     summary="List all bookings by type",
 *     operationId="showBookingsByType",
 *     tags={"Bookings"},
 *     @OA\Parameter(
 *         name="type",
 *         in="path",
 *         required=true,
 *         description="Type of the booking (car, flight, hotel)",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="A list of bookings of the specified type",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Booking")
 *         )
 *     ),
 *     @OA\Response(
 *         response="404",
 *         description="Bookings not found"
 *     )
 * )
 */
    public function showType ($type){
        switch ($type) {
            case 'car':
                $booking = BookingCar::all();
                break;
            case 'flight':
                $booking = BookingFlight::all();
                break;
            case 'hotel':
                $booking = BookingHotel::all();
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
/**
 * @OA\Get(
 *     path="/availables/{type}",
 *     summary="List all available items by type",
 *     operationId="listAvailableItemsByType",
 *     tags={"Availables"},
 *     @OA\Parameter(
 *         name="type",
 *         in="path",
 *         required=true,
 *         description="Type of the available item (car, flight, hotel)",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="A list of available items of the specified type",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/AvailableItem")
 *         )
 *     ),
 *     @OA\Response(
 *         response="404",
 *         description="Available items not found"
 *     )
 * )
 */
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
                $rules = [
                    'UserID' => 'required|integer',
                    'CarModel' => 'required|string|max:255',
                    'Year' => 'required|integer|min:1900|max:' . date('Y'),
                    'Color' => 'required|string|max:50',
                    'PricePerDay' => 'required|numeric|min:0',
                    'Availability' => 'required|boolean',
                    'image_url' => 'nullable|url',
                ];
                $modelClass = Car::class;
                break;
    
                case 'flight':
                    $rules = [
                        'UserID' => 'required|integer',
                        'AirlineName' => 'required|string|max:255',
                        'DepartureAirport' => 'required|string|max:255',
                        'ArrivalAirport' => 'required|string|max:255',
                        'DepartureTime' => 'required|date_format:Y-m-d H:i:s',
                        'ArrivalTime' => 'required|date_format:Y-m-d H:i:s|after:DepartureTime',
                        'Price' => 'required|numeric|min:0',
                        'Availability' => 'required|boolean',
                        'image_url' => 'nullable|url',
                    ];
                    $modelClass = Flight::class;
                    break;
    
                    case 'hotel':
                        $rules = [
                            'UserID' => 'required|integer',
                            'HotelName' => 'required|string|max:255',
                            'rating' => 'required|integer|min:1|max:5',
                            'PricePerNight' => 'required|numeric|min:0',
                            'Availability' => 'required|boolean',
                            'StartDate' => 'required|date_format:Y-m-d',
                            'EndDate' => 'required|date_format:Y-m-d|after:StartDate',
                            'city' => 'required|string|max:255',
                            'county' => 'required|string|max:255',
                            'description' => 'nullable|string',
                            'image_url' => 'nullable|url',
                            'number_of_guests' => 'required|integer|min:1',
                        ];
                        $modelClass = Hotel::class;
                        break;
    
            default:
                return response()->json(['message' => 'Invalid available item type'], 400);
        }
    
        // Validate the request data
        $validated = $request->validate($rules);
    
        // Create the record
        $item = $modelClass::create($validated);
    
        // Return the created item as JSON
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


                  //user management//




/**
 * @OA\Get(
 *     path="/users",
 *     summary="List all users",
 *     operationId="getAllUsers",
 *     tags={"Users"},
 *     @OA\Response(
 *         response="200",
 *         description="A list of all users",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/User")
 *         )
 *     )
 * )
 */
    public function getAllUsers()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
 * @OA\Post(
 *     path="/users",
 *     summary="Create a new user",
 *     operationId="createUser",
 *     tags={"Users"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/User")
 *     ),
 *     @OA\Response(
 *         response="201",
 *         description="User created successfully",
 *         @OA\JsonContent(ref="#/components/schemas/User")
 *     ),
 *     @OA\Response(
 *         response="400",
 *         description="Validation error"
 *     )
 * )
 */

    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Name' => 'required|string|max:255',
            'Email' => 'required|string|email|max:255|unique:users',
            'Password' => 'required|string|min:8',
            'PhoneNumber' => 'required|string|max:15',
            'ProfilePicture' => 'nullable|string|max:255',
            'Role' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'Name' => $request->Name,
            'Email' => $request->Email,
            'Password' => Hash::make($request->Password),
            'PhoneNumber' => $request->PhoneNumber,
            'ProfilePicture' => $request->ProfilePicture,
            'Role' => $request->Role,
        ]);

        return response()->json($user, 201);
    }
/**
 * @OA\Put(
 *     path="/users/{id}",
 *     summary="Update a user",
 *     operationId="updateUser",
 *     tags={"Users"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the user",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/User")
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="User updated successfully",
 *         @OA\JsonContent(ref="#/components/schemas/User")
 *     ),
 *     @OA\Response(
 *         response="404",
 *         description="User not found"
 *     ),
 *     @OA\Response(
 *         response="400",
 *         description="Validation error"
 *     )
 * )
 */
    public function updateUser(Request $request, $id)
    {
        try {
            // Find the user by ID
            $user = User::find($id);
            
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }
    
            // Validate the request
            $validator = Validator::make($request->all(), [
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|string|email|max:255|unique:users,email,'.$id.',UserID',
                'password' => 'nullable|string|min:8',
                'phone_number' => 'nullable|string|max:15',
                'profile_picture' => 'nullable|string|max:255',
                'role' => 'nullable|string|max:50',
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
    
            // Logging the incoming data
            \Log::info('Updating user with data: ', $request->all());
    
            // Update user data
            $user->update([
                'Name' => $request->input('name', $user->Name),
                'Email' => $request->input('email', $user->Email),
                'PhoneNumber' => $request->input('phone_number', $user->PhoneNumber),
                'ProfilePicture' => $request->input('profile_picture', $user->ProfilePicture),
                'Role' => $request->input('role', $user->Role),
                'Password' => $request->filled('password') ? Hash::make($request->input('password')) : $user->Password,
            ]);
    
            // Logging successful update
            \Log::info('User updated successfully');
    
            return response()->json($user, 200);
        } catch (\Exception $e) {
            \Log::error('Failed to update user: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update user'], 500);
        }
    }

    /**
 * @OA\Delete(
 *     path="/users/{id}",
 *     summary="Delete a user",
 *     operationId="deleteUser",
 *     tags={"Users"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the user",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="User deleted successfully"
 *     ),
 *     @OA\Response(
 *         response="404",
 *         description="User not found"
 *     )
 * )
 */
    
    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
/**
 * @OA\Get(
 *     path="/bookings/latest",
 *     summary="Get latest bookings",
 *     operationId="getLatestBookings",
 *     tags={"Bookings"},
 *     @OA\Response(
 *         response="200",
 *         description="Latest bookings",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Booking")
 *         )
 *     )
 * )
 */
    public function getLatestBookings()
    {
        $latestBookings = BookingHotel::orderBy('created_at', 'desc')->take(2)->get();

        return response()->json($latestBookings);
    }



}
