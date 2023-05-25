<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LocationController extends Controller
{
    public function showLocations()
    {
        $locations = Location::all();
        return view("locations")
            ->with("locations", $locations);
    }

    public function showAddLocation()
    {
        return view("add-location");
    }

    public function doAddLocation(Request $request)
    {
        $request->validate([
            "city" => "required|max:30",
            "address" => "required|max:50",
            "opening_hours" => "required",
            "closing_hours" => "required|time_greater_than:opening_hours",
            "image" => "required|mimes:jpg,jpeg,png"
        ]);

        $image_path = Storage::disk('public')->put('image/location', $request->file('image'), 'public');
        Location::create([
            "city" => $request->city,
            "address" => $request->address,
            "opening_hours" => $request->opening_hours,
            "closing_hours" => $request->closing_hours,
            "image_path" => "storage/".$image_path,
        ]);

        return redirect()->back();
    }

    public function showEditLocation(Request $request, $location_id)
    {
        //TODO: add logic
        return view("edit-location");
    }

    public function doEditLocation(Request $request, $location_id)
    {
        //TODO: add logic
        return redirect()->back();
    }

    public function doDeleteLocation($location_id)
    {
        $location_id = intval($location_id);
        $seldctedLocation = Location::find($location_id);
        $seldctedLocation->delete();
        return redirect()->back();
    }
}
