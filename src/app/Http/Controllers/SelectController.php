<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Country;
use App\Models\Genre;
use Illuminate\Http\Request;

class SelectController extends Controller
{
    public function index(Request $request)
    {
        return view('select', [
            'artists' => Artist::all(),
            'countries' => Country::all(),
            'genres' => Genre::all(),
        ]);
    }
}
