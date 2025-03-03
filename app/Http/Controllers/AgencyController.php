<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Agency;

class AgencyController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:agencies,email',
            'name' => 'required|string|max:64',
            'secret' => 'required|string'
        ]);

        $agency = Agency::create([
            'id' => \Illuminate\Support\Str::uuid(),
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'secret' => Crypt::encryptString($request->get('secret'))
        ]);

        return response()->json(['id' => $agency->id], 201);
    }

    public function show(Request $request)
    {
        $email = $request->get('email');

        if (!$email) {
            return response()->json(['message' => 'Email is required'], 400);
        }

        $agency = Agency::where('email', $email)->first();

        if (!$agency) {
            return response()->json([
                'error' => 'Agency not found'
            ], 404);
        }

        return response()->json([
            'id' => $agency->id,
            'name' => $agency->name,
            'email' => $agency->email,
            'secret' => Crypt::decryptString($agency->secret)
        ]);
    }
}
