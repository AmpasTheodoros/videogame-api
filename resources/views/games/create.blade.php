@extends('layouts.app')

@section('content')
    <h1>Create a New Game</h1>

    @if ($errors->any())
        <div style="color: red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('games.store') }}" method="POST">
        @csrf
        <div>
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title') }}" required>
        </div>

        <div>
            <label>Description</label>
            <textarea name="description" required>{{ old('description') }}</textarea>
        </div>

        <div>
            <label>Release Date</label>
            <input type="date" name="release_date" value="{{ old('release_date') }}" required>
        </div>

        <div>
            <label>Genre</label>
            <input type="text" name="genre" value="{{ old('genre') }}" required>
        </div>

        <button type="submit">Save</button>
    </form>
@endsection
