<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParkirVehicleType;

class VehicleTypeController extends Controller
{
    public function index()
    {
        $vehicleTypes = ParkirVehicleType::all();
        return view('vehicletype.index', compact('vehicleTypes'));
    }

    public function create()
    {
        return view('vehicletype.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:motorcycle,car,other',
            'perjam_pertama' => 'required|integer|min:0',
            'perjam_berikutnya' => 'required|integer|min:0',
            'max_perhari' => 'required|integer|min:0',
        ]);

        $existingType = ParkirVehicleType::where('jenis', $request->jenis)->first();

        if ($existingType) {
            return redirect()->route('vehicletype.create')
                ->with('duplikat', 'Vehicle type for "' . ucfirst($request->jenis) . '" already exists. Please update the existing data instead.')
                ->withInput();
        }

        ParkirVehicleType::create($request->all());

        return redirect()->route('vehicletype.index')
            ->with('simpan', 'New Vehicle Type has been successfully saved.');
    }
}