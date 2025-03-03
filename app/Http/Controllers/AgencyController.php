<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            'secret' => bcrypt($request->get('secret'))
        ]);

        return response()->json(['id' => $agency->id], 201);
    }
}
