<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TracksController extends Controller
{
    public function index() 
    {
        $tracks = DB::table('tracks')
            ->select(
                'tracks.Name as TrackName',
                'albums.Title as AlbumTitle',
                'artists.Name as ArtistName',
                'tracks.UnitPrice',
                'genres.Name as GenreName',
                'media_types.Name as MediaTypeName',
                'tracks.Milliseconds as Milliseconds'
            )
            ->join('albums', 'tracks.AlbumId', '=', 'albums.AlbumId')
            ->join('artists', 'albums.ArtistId', '=', 'artists.ArtistId')
            ->join('genres', 'tracks.GenreId', '=', 'genres.GenreId')
            ->join('media_types', 'media_types.MediaTypeId', '=', 'tracks.MediaTypeId')
            ->orderBy('tracks.Name', 'ASC')
            ->get();
        
        return view('tracks.index', [
            'tracks' => $tracks,
            'tracksCount' => count($tracks),
        ]);

        
    }

    public function create()
    {
        return view('tracks.create', [
            'albums' => DB::table('albums')->orderBy('Title')->get(),
            'mediatypes' => DB::table('media_types')->orderBy('Name')->get(),
            'genres' => DB::table('genres')->orderBy('Name')->get()
        ]);
    }

    public function store(Request $request)
    {
        // dd([
        //     'title' => $request->input('title'),
        //     'album' => $request->input('album'),
        //     'media_type' => $request->input('mediatype'),
        //     'genre' => $request->input('genre'),
        // ]);

        $request->validate([
            'title' => 'required|max:20',
            'album' => 'required|exists:albums,AlbumId',
            'mediatype' => 'required|exists:media_types,MediaTypeId',
            'genre' => 'required|exists:genres,GenreId',
            'unit_price' => 'required|numeric|min:0.01',
            'time' => 'required|numeric|min:0',
        ]);

        DB::table('tracks')->insert([
            'Name' => $request->input('title'),
            'AlbumId' => $request->input('album'),
            'MediaTypeId' => $request->input('mediatype'),
            'GenreId' => $request->input('genre'),
            'UnitPrice' => $request->input('unit_price'),
            'Milliseconds' => $request->input('time'),
        ]);

        // $album = DB::table('albums')
        //     ->where('ArtistId', '=', $request->input('artist'))
        //     ->first();

        return redirect()
            ->route('tracks.index')
            ->with('success', "Successfully created album {$request->input('title')}");
    }
}