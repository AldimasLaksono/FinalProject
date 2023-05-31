<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Log;

class LogController extends Controller
{
    public function show_data()
    {
        $dataLog = Log::all();

        return view('activity_log', compact('dataLog'));
    }
}
