<?php

namespace App\Http\Controllers;

use App\Models\VideoGame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VideoGameController extends Controller
{
    // List video games for the authenticated user, with optional filtering and sorting
    public function index(Request $request)
    {
        $games = VideoGame::with('user')  // Eager load the user relationship
        ->where('user_id', auth()->id())
        ->get();
    
        if ($request->has('genre')) {
            $query->where('genre', $request->genre);
        }
    
        if ($request->has('sort')) {
            $query->orderBy('release_date', $request->sort); // 'asc' or 'desc'
        }
    
        $games = $query->get();
    
        return view('dashboard', compact('games'));
    }

    // Create a new video game
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'release_date' => 'required|date',
            'genre'        => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $videoGame = VideoGame::create([
            'user_id'      => auth()->id(),
            'title'        => $request->title,
            'description'  => $request->description,
            'release_date' => $request->release_date,
            'genre'        => $request->genre,
        ]);

        return response()->json($videoGame, 201);
    }

    // Show a single video game
    public function show($id)
    {
        $videoGame = VideoGame::findOrFail($id);
        return response()->json($videoGame);
    }

    // Update a video game (only if owned by the authenticated user)
    public function update(Request $request, $id)
    {
        $videoGame = VideoGame::findOrFail($id);

        if ($videoGame->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'title'        => 'sometimes|required|string|max:255',
            'description'  => 'sometimes|required|string',
            'release_date' => 'sometimes|required|date',
            'genre'        => 'sometimes|required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $videoGame->update($request->all());
        return response()->json($videoGame);
    }

    // Delete a video game: Regular users can delete only their own games; Admins can delete any game.
    public function destroy($id)
    {
        $game = VideoGame::findOrFail($id);
        $user = auth()->user();
    
        // Allow deletion if the game belongs to the user OR if the user is an admin.
        if ($game->user_id !== $user->id && $user->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        $game->delete();
    
        return response()->json(['message' => 'Game deleted successfully']);
    }    
    
}
