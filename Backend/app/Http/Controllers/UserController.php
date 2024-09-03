<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * @OA\Tag(
 *     name="User",
 *     description="API Endpoints for managing user information",
 * )
 */
class UserController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/user",
     *     summary="Get the current authenticated user",
     *     tags={"User"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Returns the current user details",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
     *             @OA\Property(property="phoneNumber", type="string", example="+1234567890"),
     *             @OA\Property(property="role", type="string", example="user"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function getCurrentUser(Request $request)
    {
        return response()->json($request->user());
    }


    /**
     * @OA\Put(
     *     path="/api/user",
     *     summary="Update user information",
     *     tags={"User"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="phoneNumber", type="string", example="+1234567890"),
     *             @OA\Property(property="role", type="string", example="admin"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User information updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User information updated successfully"),
     *             @OA\Property(property="user", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="John Doe"),
     *                 @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
     *                 @OA\Property(property="phoneNumber", type="string", example="+1234567890"),
     *                 @OA\Property(property="role", type="string", example="admin"),
     *             ),
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|min:3|max:255',
            'phoneNumber' => 'sometimes|string|max:13',
            'role' => 'sometimes|string|max:50',
        ]);

        $user = $request->user();

        $user->update(array_filter([
            'Name' => $validated['name'] ?? $user->Name,
            'PhoneNumber' => $validated['phoneNumber'] ?? $user->PhoneNumber,
            'Role' => $validated['role'] ?? $user->Role,
        ]));

        return response()->json([
            'message' => 'User information updated successfully',
            'user' => $user
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/user/password",
     *     summary="Update user password",
     *     tags={"User"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="current_password", type="string", format="password", example="CurrentPassw0rd"),
     *             @OA\Property(property="new_password", type="string", format="password", example="NewPassw0rd"),
     *             @OA\Property(property="new_password_confirmation", type="string", format="password", example="NewPassw0rd"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Password updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Password updated successfully"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Current password is incorrect",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Current password is incorrect"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = $request->user();

        if (!Hash::check($validated['current_password'], $user->Password)) {
            return response()->json(['error' => 'Current password is incorrect'], 400);
        }

        $user->update([
            'Password' => Hash::make($validated['new_password']),
        ]);

        return response()->json([
            'message' => 'Password updated successfully',
        ]);
    }

}
