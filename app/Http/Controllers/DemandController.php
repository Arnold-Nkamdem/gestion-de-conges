<?php

namespace App\Http\Controllers;

use App\Models\HolidayType;
use Illuminate\Http\Request;

class DemandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        $roles = Role::pluck('name','name')->all();
        $functions = Position::get();
        $services = Service::get();
        $demands = Demand::paginate('10');
        $holidaysType = HolidayType::get();
        $holidays = Holiday::paginate('10');
        $credentials = Credential::get();

        return view('holidays.index', compact('users', 'roles', 'functions', 'services', 'demands', 'holidaysType', 'holidays', 'credentials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function changeHolidayDemandStatus(Request $request, Demand $demand)
    {
        // Validation flieds
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|max:15',
        ]);

        if ($validator->fails()) {
            return abort(401);
        }

        $validated = $validator->validated();

        // Change holiday demand status
        if ($request->status == "approuved") {
            $demand->update($validated);
            return redirect('holidays')->with('success','Holiday demand approuved successfully');
        } elseif ($request->status == "rejected") {
            $demand->update($validated);
            return redirect('holidays')->with('success','Holiday demand rejected successfully');
        }
    }
}
