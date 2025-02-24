<?php

namespace App\Http\Controllers;

use App\Models\VideoGame;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function index(Request $request)
    {
        // Example: Admin sees all games, user sees only their own
        if (auth()->user()->role === 'admin') {
            $query = VideoGame::with(['user', 'reviews.user']); // eager load reviews + review user
        } else {
            $query = VideoGame::with(['user', 'reviews.user'])
                              ->where('user_id', auth()->id());
        }
    
        // Filtering by genre, sorting by release_date, etc.
        if ($request->filled('genre')) {
            $query->where('genre', $request->genre);
        }
        if ($request->filled('sort')) {
            $sort = strtolower($request->sort);
            if (in_array($sort, ['asc', 'desc'])) {
                $query->orderBy('release_date', $sort);
            }
        }
    
        $games = $query->get();
    
        return view('dashboard', compact('games'));
    }
    
}
