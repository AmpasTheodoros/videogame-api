<?php

namespace App\Http\Controllers;

use App\Models\VideoGame; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        // Redirect to the dashboard instead of displaying the games list
        return redirect()->route('dashboard')->with('info', 'You have been redirected to the dashboard.');
    }

    public function create()
    {
        return view('games.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'release_date' => 'required|date',
            'genre'        => 'required|string',
        ]);

        // Create the game
        $data = $request->all();
        $data['user_id'] = auth()->id(); // override any user_id in the request
        VideoGame::create($data);

        // Redirect to the dashboard after creating the game
        return redirect()->route('dashboard')->with('success', 'Game created successfully.');
    }    

    public function edit($id)
    {
        $game = VideoGame::findOrFail($id);

        // Ensure the logged-in user owns this game
        if ($game->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('games.edit', compact('game'));
    }

    public function update(Request $request, $id)
    {
        $game = VideoGame::findOrFail($id);

        // Check ownership
        if ($game->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Validate updates
        $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'release_date' => 'required|date',
            'genre'        => 'required|string',
        ]);

        // Update the game
        $game->update([
            'title'        => $request->title,
            'description'  => $request->description,
            'release_date' => $request->release_date,
            'genre'        => $request->genre,
        ]);

        return redirect()->route('games.index')->with('success', 'Game updated successfully.');
    }

    public function destroy($id)
    {
        $game = VideoGame::findOrFail($id);

        // Check ownership or if user is an admin (if you have that logic)
        if ($game->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $game->delete();

        return redirect()->route('games.index')
                        ->with('success', 'Game deleted successfully.');
    }
}
