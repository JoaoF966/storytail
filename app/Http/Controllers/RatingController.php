<?php

namespace App\Http\Controllers;

use App\Models\BookUserRead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function rateBook(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $userId = Auth::id();


        BookUserRead::updateOrCreate(
            [
                'book_id' => $id,
                'user_id' => $userId,
            ],
            [
                'rating' => $request->rating,
            ]
        );

        return response()->json(['message' => 'Rating submitted successfully!']);
    }
}
