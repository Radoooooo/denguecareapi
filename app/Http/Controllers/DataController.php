<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function getData()
    {
        // Fetch data from the database using your model
        $data = Data::all(); // Use the correct model name

        return response()->json($data, 200);
    }
}
