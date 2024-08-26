<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Tag(
 *     name="Reviews",
 *     description="API Endpoints for Reviews"
 * )
 */
class ReviewController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/{bookingType}/{bookingId}/reviews",
     *     summary="Store a new review",
     *     tags={"Reviews"},
     *     @OA\Parameter(
     *         name="bookingType",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         description="Type of the booking (e.g., flight, hotel, car_rental)"
     *     ),
     *     @OA\Parameter(
     *         name="bookingId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the booking"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"rating"},
     *             @OA\Property(property="rating", type="integer", minimum=1, maximum=5, example=5),
     *             @OA\Property(property="review_text", type="string", example="Great service!")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Review added successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Review added successfully"),
     *             @OA\Property(property="review", type="object",
     *                 @OA\Property(property="BookingID", type="integer", example=1),
     *                 @OA\Property(property="BookingType", type="string", example="hotel"),
     *                 @OA\Property(property="Rating", type="integer", example=5),
     *                 @OA\Property(property="ReviewText", type="string", example="Great service!")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation errors",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */
    public function storeReview(Request $request, $bookingType, $bookingId)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $review = Review::create([
            'BookingID' => $bookingId,
            'BookingType' => $bookingType,
            'Rating' => $request->rating,
            'ReviewText' => $request->review_text,
        ]);

        return response()->json(['message' => 'Review added successfully', 'review' => $review], 201);
    }

    /**
     * @OA\Put(
     *     path="/api/{bookingType}/{bookingId}/reviews/{reviewId}",
     *     summary="Update an existing review",
     *     tags={"Reviews"},
     *     @OA\Parameter(
     *         name="bookingType",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         description="Type of the booking"
     *     ),
     *     @OA\Parameter(
     *         name="bookingId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the booking"
     *     ),
     *     @OA\Parameter(
     *         name="reviewId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the review"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"rating"},
     *             @OA\Property(property="rating", type="integer", minimum=1, maximum=5, example=5),
     *             @OA\Property(property="review_text", type="string", example="Updated review text")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Review updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Review updated successfully"),
     *             @OA\Property(property="review", type="object",
     *                 @OA\Property(property="BookingID", type="integer", example=1),
     *                 @OA\Property(property="BookingType", type="string", example="hotel"),
     *                 @OA\Property(property="Rating", type="integer", example=5),
     *                 @OA\Property(property="ReviewText", type="string", example="Updated review text")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Review not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Review not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation errors",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */
    public function updateReview(Request $request, $bookingType, $bookingId, $reviewId)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $review = Review::where('BookingID', $bookingId)
            ->where('BookingType', $bookingType)
            ->where('ReviewID', $reviewId)
            ->first();

        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        $review->Rating = $request->rating;
        $review->ReviewText = $request->review_text;

        $review->save();

        return response()->json(['message' => 'Review updated successfully', 'review' => $review], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/{bookingType}/{bookingId}/reviews",
     *     summary="Get all reviews for a specific booking",
     *     tags={"Reviews"},
     *     @OA\Parameter(
     *         name="bookingType",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         description="Type of the booking"
     *     ),
     *     @OA\Parameter(
     *         name="bookingId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the booking"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of reviews",
     *         @OA\JsonContent(type="array",
     *             @OA\Items(
     *                 @OA\Property(property="BookingID", type="integer", example=1),
     *                 @OA\Property(property="BookingType", type="string", example="hotel"),
     *                 @OA\Property(property="Rating", type="integer", example=5),
     *                 @OA\Property(property="ReviewText", type="string", example="Great service!")
     *             )
     *         )
     *     )
     * )
     */
    public function getReviews($bookingType, $bookingId)
    {
        $reviews = Review::where('BookingID', $bookingId)
            ->where('BookingType', $bookingType)
            ->get();

        return response()->json($reviews, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/{bookingType}/{bookingId}/reviews/{reviewId}",
     *     summary="Delete a review",
     *     tags={"Reviews"},
     *     @OA\Parameter(
     *         name="bookingType",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         description="Type of the booking"
     *     ),
     *     @OA\Parameter(
     *         name="bookingId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the booking"
     *     ),
     *     @OA\Parameter(
     *         name="reviewId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the review"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Review deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Review deleted successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Review not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Review not found")
     *         )
     *     )
     * )
     */
    public function deleteReview($bookingType, $bookingId, $reviewId)
    {
        $review = Review::where('BookingID', $bookingId)
            ->where('BookingType', $bookingType)
            ->where('ReviewID', $reviewId)
            ->firstOrFail();

        $review->delete();

        return response()->json(['message' => 'Review deleted successfully'], 200);
    }
}
