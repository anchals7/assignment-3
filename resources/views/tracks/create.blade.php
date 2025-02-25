@extends('layout')

@section('title', 'New Track')

@section('main')
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('tracks.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
            @error ('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="album" class="form-label">Album</label>
            <select name="album" id="album" class="form-select">
                <option value="">-- Select Album --</option>
                @foreach ($albums as $album)
                    <option 
                        value="{{ $album->AlbumId }}"
                        {{ (string) $album->AlbumId === old('album') ? "selected" : "" }}
                    >
                        {{ $album->Title }}
                    </option>
                @endforeach
            </select>
            @error ('album')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="mediatype" class="form-label">Media-Type</label>
            <select name="mediatype" id="mediatype" class="form-select">
                <option value="">-- Select Media-Type --</option>
                @foreach ($mediatypes as $mediatype)
                    <option 
                        value="{{ $mediatype->MediaTypeId }}"
                        {{ (string) $mediatype->MediaTypeId === old('mediatype') ? "selected" : "" }}
                    >
                        {{ $mediatype->Name }}
                    </option>
                @endforeach
            </select>
            @error ('mediatype')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="genre" class="form-label">Genre</label>
            <select name="genre" id="genre" class="form-select">
                <option value="">-- Select Genre --</option>
                @foreach ($genres as $genre)
                    <option 
                        value="{{ $genre->GenreId }}"
                        {{ (string) $genre->GenreId === old('genre') ? "selected" : "" }}
                    >
                        {{ $genre->Name }}
                    </option>
                @endforeach
            </select>
            @error ('genre')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="unit_price" class="form-label">Unit Price</label>
            <input type="number" name="unit_price" id="unit_price" class="form-control" value="{{ old('unit_price') }}" min="0.01" step="any">
            @error ('unit_price')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Time (in milliseconds)</label>
            <input type="number" name="time" id="time" class="form-control" value="{{ old('time') }}" min=0 step="any">
            @error ('time')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">
        Save
        </button>
    </form>
@endsection