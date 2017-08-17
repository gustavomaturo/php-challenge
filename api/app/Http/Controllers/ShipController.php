<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShipController extends Controller
{
    public function index() {
        return response()->json(['success' => true]);
    }
}
