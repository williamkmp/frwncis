<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showHome(Request $request)
    {
        return view("home");
    }

    public function doSearch(Request $request)
    {
        $request->validate(["search" => "required|string"]);

        $searchString = $request->search;
        $locations = Location::where("city", "LIKE", '%'.$searchString."%")->get();
        $products = Product::where("name", "LIKE", '%'.$searchString."%")->get();

        return view("search-result")
            ->with("searchString", $searchString)
            ->with("locationSearchResults", $locations)
            ->with("productSearchResults", $products);
    }

    public function showDump(Request $request)
    {
        $request->validate(["search" => "required|string"]);
        return view("dump");
    }
}
