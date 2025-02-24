@extends('layouts.app')

@section('content')
    <div class="mt-4">
        <h1 class="mb-4">Your Video Games</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Filtering & Sorting Form -->
        <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
            <div class="form-row">
                <div class="col-md-4">
                    <input type="text" name="genre" class="form-control" placeholder="Filter by Genre" value="{{ request('genre') }}">
                </div>
                <div class="col-md-4">
                    <select name="sort" class="form-control">
                        <option value="">-- Sort by Release Date --</option>
                        <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Oldest First</option>
                        <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Newest First</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary btn-block">Apply</button>
                </div>
            </div>
        </form>

        <div class="mb-4">
            <a href="{{ route('games.create') }}" class="btn btn-success">Add New Game</a>
        </div>

        @if($games->isEmpty())
            <p>No games found. Create one!</p>
        @else
            <div class="row">
            @foreach($games as $game)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $game->title }}</h5>
                            <p class="card-text">{{ Str::limit($game->description, 100) }}</p>
                            <p class="card-text"><small class="text-muted">Release Date: {{ $game->release_date }}</small></p>
                            <p class="card-text"><small class="text-muted">Genre: {{ $game->genre }}</small></p>
                            
                            <!-- Display average rating (if any reviews exist) -->
                            @if($game->reviews->count() > 0)
                                @php
                                    $averageRating = $game->reviews->avg('rating');
                                @endphp
                                <p><strong>Average Rating:</strong> {{ number_format($averageRating, 1) }} / 5</p>
                            @else
                                <p><strong>Average Rating:</strong> No reviews yet</p>
                            @endif

                            <!-- Display up to a few reviews -->
                            <p><strong>Reviews:</strong></p>
                            @if($game->reviews->isEmpty())
                                <p class="text-muted">No reviews yet.</p>
                            @else
                                <ul class="list-unstyled">
                                    @foreach($game->reviews as $review)
                                        <li>
                                            <strong>{{ $review->rating }}★</strong> - 
                                            {{ $review->comment ?? 'No comment' }}
                                            <small class="text-muted">
                                                (by {{ $review->user->username }})
                                            </small>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        
                        <div class="card-footer">
                            <!-- Existing logic for Edit/Delete buttons, etc. -->
                            <!-- Example: Only show to owner or admin -->
                            @if(auth()->id() == $game->user_id || auth()->user()->role == 'admin')
                                <a href="{{ route('games.edit', $game->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('games.destroy', $game->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" 
                                            onclick="return confirm('Delete this game?')">Delete</button>
                                </form>
                            @endif

                            <!-- (Optional) Link to add a review -->
                            <a href="{{ route('reviews.create', $game->id) }}" class="btn btn-primary btn-sm">
                                Add Review
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        @endif
    </div>
@endsection
