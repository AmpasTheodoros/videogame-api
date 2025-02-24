@extends('layouts.app')

@section('content')
    <h1>Edit Game</h1>

    @if ($errors->any())
        <div style="color: red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('games.update', $game->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title', $game->title) }}" required>
        </div>

        <div>
            <label>Description</label>
            <textarea name="description" required>{{ old('description', $game->description) }}</textarea>
        </div>

        <div>
            <label>Release Date</label>
            <input type="date" name="release_date" value="{{ old('release_date', $game->release_date) }}" required>
        </div>

        <div>
            <label>Genre</label>
            <input type="text" name="genre" value="{{ old('genre', $game->genre) }}" required>
        </div>

        <button type="submit">Update</button>
    </form>
@endsection
