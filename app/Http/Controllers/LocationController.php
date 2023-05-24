<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function showLocations()
    {
        //TODO: implement show location logic
        return view("locations");
    }

    public function showAddLocation()
    {
        return view("add-location");
    }

    public function doAddLocation(Request $request)
    {
        //TODO: implement add location logic
        return redirect()->back();
    }
}
