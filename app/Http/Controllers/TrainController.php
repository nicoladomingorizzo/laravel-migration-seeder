<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Train;
use Illuminate\Support\Facades\DB;

class TrainController extends Controller
{
    public function index()
    {
        $today = date('Y-m-d');

        $trains = Train::where('departure_date', '>=', $today)
            ->orderBy('departure_date')
            ->orderBy('departure_time')
            ->get();

        return view('home', compact('trains'));
    }
}
