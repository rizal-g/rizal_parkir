<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParkirLocation;

class LocationController extends Controller
{
    public function index()
    {
        $locations = ParkirLocation::all();
        return view('location.index', compact('locations'));
    }

    public function create()
    {
        return view('location.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'location_name' => 'required|string|max:100',
            'max_motorcycle' => 'required|integer|min:0',
            'max_car' => 'required|integer|min:0',
            'max_other' => 'required|integer|min:0',
        ]);

        $existingLocation = ParkirLocation::where('location_name', $request->location_name)->first();

        if ($existingLocation) {
            return redirect()->route('location.create')
                ->with('duplikat', 'Location data with the name "' . $request->location_name . '" already exists. Please use different data.')
                ->withInput();
        }

        ParkirLocation::create($request->all());

        return redirect()->route('location.index')
            ->with('simpan', 'New Location Data has been successfully saved.');
    }
}