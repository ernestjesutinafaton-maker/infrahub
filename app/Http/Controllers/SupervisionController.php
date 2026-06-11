<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SupervisionController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'hostname' => 'required|string',
            'os'  => 'required|string',
            'cpu' => 'required|string',
            'ram' => 'required|string',
            'disque' => 'required|string',
            'uptime' => 'required|string',
        ]);

        // Log les données reçues
        Log::info('Supervision reçue', $data);

        return response()->json([
            'status' => 'ok',
            'message' => 'Données reçues avec succès'
        ]);
    }
}