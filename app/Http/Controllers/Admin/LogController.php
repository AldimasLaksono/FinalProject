<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Log;

class LogController extends Controller
{
    public function show_data(Request $request)
    {
        $user = $request->session()->get('user');
        
        // Mendapatkan nama user (name_mut)
        $data = [
            'name_mut' => $user->name_mut,
            'foto_mut' => $user->foto_mut,
            'role_mut' => $user->role_mut
        ];

        $dataLog = Log::all();

        return view('activity_log', compact('dataLog'), ['data' => $data]);
    }
}
