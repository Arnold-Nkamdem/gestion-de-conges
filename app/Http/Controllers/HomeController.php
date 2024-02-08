<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Demand;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();
        // $admins = User::count();
        $holidayDemands = Demand::count();
        $pendingHolidays = Demand::where('status', '=', 'pending')->count();
        $approuvedHolidays = Demand::where('status', '=', 'approuved')->count();
        $rejectedHolidays = Demand::where('status', '=', 'rejected')->count();

        return view('index', compact('users', 'holidayDemands', 'pendingHolidays', 'approuvedHolidays', 'rejectedHolidays'));
    }
}
