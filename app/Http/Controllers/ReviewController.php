<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\VideoGame;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Show all reviews for a specific game
    public function index($videoGameId)
    {
        $reviews = Review::where('video_game_id', $videoGameId)
                         ->with('user')
                         ->get();

        return response()->json($reviews);
    }

    public function create($videoGameId)
    {
        $game = VideoGame::findOrFail($videoGameId);
        return view('reviews.create', compact('game'));
    }

    public function store(Request $request, $videoGameId)
    {
        // Example logic
        $game = VideoGame::findOrFail($videoGameId);

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'video_game_id' => $game->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('dashboard')->with('success', 'Review added!');
    } 

    //TODO Show a single review, update, or delete
}
