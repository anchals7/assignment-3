@extends('layout')

@section('title', 'Tracks')

@section('main')
    <h1>Tracks ({{ $tracksCount }})</h1>
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ url('/tracks/new') }}" class="btn btn-primary mt-1">Add new track</a>
    <table class="table table-striped">
      <thead>
        <tr>
          <td>Track</td>
          <td>Album</td>
          <td>Artist</td>
          <td>Media Type</td>
          <td>Genre</td>
          <td>Unit Price</td>
          <td>Time</td>
        </tr>
      </thead>
      <tbody>
        @foreach ($tracks as $track)
        <tr>
          <td>{{ $track->TrackName }}</td>
          <td>{{ $track->AlbumTitle }}</td>
          <td>{{ $track->ArtistName }}</td>
          <td>{{ $track->MediaTypeName }}</td>
          <td>{{ $track->GenreName }}</td>
          <td>{{ $track->UnitPrice}}</td>
          <td>
            @php
                $seconds = floor($track->Milliseconds / 1000);
                $minutes = floor($seconds / 60);
                $seconds = $seconds % 60;
                echo sprintf('%02d:%02d', $minutes, $seconds);
            @endphp
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
@endsection