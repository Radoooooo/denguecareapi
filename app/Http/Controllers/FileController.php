<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function uploadFile(Request $request)
    {
        $file = $request->file('file'); // Assuming you're sending 'file' in the request

        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,csv|max:2048', // Adjust the validation rules
        ]);

        // Store the file in the storage/app/public directory
        $filePath = $file->store('public');

        // Extract data from the file and store it in the database
        // You'll need to use appropriate libraries for this step

        return response()->json(['message' => 'File uploaded and processed successfully'], 200);
    }
}
