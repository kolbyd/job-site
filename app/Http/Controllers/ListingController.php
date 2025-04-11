<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()
    {
        // TODO: Inject listing data from the database

        return view('index');
    }
}
