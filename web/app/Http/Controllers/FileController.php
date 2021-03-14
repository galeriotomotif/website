<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function showFile($file_name)
    {
        return response()->file(Storage::disk('local')->path($file_name));
    }
}
