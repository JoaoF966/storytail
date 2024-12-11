<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookUserRead;
use Illuminate\Support\Facades\Auth;

class Ratingcontroller extends Controller
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
