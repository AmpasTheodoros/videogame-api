@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Review for {{ $game->title }}</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('reviews.store', $game->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Rating (1-5)</label>
            <input type="number" name="rating" class="form-control" min="1" max="5" required>
        </div>

        <div class="form-group">
            <label>Comment (optional)</label>
            <textarea name="comment" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Review</button>
    </form>
</div>
@endsection
