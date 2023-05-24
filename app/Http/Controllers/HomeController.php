<?php

namespace App\Http\Controllers;

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

        //TODO: implement logic
        $locations = [];
        $products = [];

        return view("search-result")
            ->with("locationSearchResult", $locations)
            ->with("productSearchResults", $products);
    }

    public function showDump(Request $request)
    {
        $request->validate(["search" => "required|string"]);
        return view("dump");
    }
}
