<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Demand;
use App\Models\Holiday;
use App\Models\Service;
use App\Models\Position;
use App\Models\Credential;
use App\Models\HolidayType;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HolidayController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $holidaysType = HolidayType::get();
        $credentials = Credential::get();

        return view('holidays.create', compact('holidaysType', 'credentials'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation flieds
        if ($request->credential == "") {
            $validator = Validator::make($request->all(), [
                'holidayType' => 'required',
                'startDate' => 'required|date',
                'endDate' => 'required|date',
                'credential' => 'nullable|image|max:2048|mimes:jpg,jpeg,png',
                'user_id' => 'required|integer',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'holidayType' => 'required',
                'startDate' => 'required|date',
                'endDate' => 'required|date',
                'credential' => 'nullable|image|max:2048|mimes:jpg,jpeg,png',
                'user_id' => 'required|integer',
            ]);
        }

        if ($validator->fails()) {
            return abort(401);
        }

        $validated = $validator->validated();

        // dd($validated);

        if ($request->hasFile('credential')) {
            // Delete current image
            if (isset($request->credential)) {
                Storage::disk('public')->delete($request->credential);
            }

            // Store the new image in the public storage
            $filePath = Storage::disk('public')->put('images/credentials', request()->file('credential'));
            $validated['credential'] = $filePath;
        }

        // Create new holiday demand
        if (isset($validated['credential'])) {
            $credential = Credential::create([
                'file_name' => $validated['credential']
            ]);

            $holiday = Holiday::create([
                'start_date' => $validated['startDate'],
                'end_date' => $validated['endDate'],
                'holiday_type_id' => $validated['holidayType'],
                'credential_id' => $credential->id,
            ]);

            Demand::create([
                'date' => $holiday->created_at,
                'user_id' => $validated['user_id'],
                'holiday_id' => $holiday->id,
            ]);

            return redirect()->route('holidays.index')->with('success','Holiday demand created successfully');
        }
        else {
            $holiday = Holiday::create([
                'start_date' => $validated['startDate'],
                'end_date' => $validated['endDate'],
                'holiday_type_id' => $validated['holidayType'],
            ]);

            Demand::create([
                'date' => $holiday->created_at,
                'user_id' => $validated['user_id'],
                'holiday_id' => $holiday->id,
            ]);

            return redirect()->route('holidays.index')->with('success','Holiday demand created successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Holiday $holiday)
    {
        return response()->view('Holidays.show', [
            'Holiday' => Holiday::findOrFail($holiday),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Holiday $holiday)
    {
        // $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        // $userRole = $user->roles->pluck('name','name')->all();
        
        // dd($roles);

        return view('holidays.edit', compact('holiday', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Holiday $holiday)
    {
        // Validation flieds
        if ($request->credential == "") {
            $validator = Validator::make($request->all(), [
                'holidayType' => 'required',
                'startDate' => 'required|date',
                'endDate' => 'required|date',
                'credential' => 'nullable|image|max:2048|mimes:jpg,jpeg,png',
                'user_id' => 'required|integer',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'holidayType' => 'required',
                'startDate' => 'required|date',
                'endDate' => 'required|date',
                'credential' => 'nullable|image|max:2048|mimes:jpg,jpeg,png',
                'user_id' => 'required|integer',
            ]);
        }

        $validated = $validator->validated();

        // dd($validated);

        if ($request->hasFile('credential')) {
            // Delete current image
            if (isset($request->credential)) {
                Storage::disk('public')->delete($request->credential);
            }

            // Store the new image in the public storage
            $filePath = Storage::disk('public')->put('images/credentials', request()->file('credential'));
            $validated['credential'] = $filePath;
        }

        // Update Holiday Demand
        if (isset($validated['credential'])) {
            $credential = Credential::updateOrcreate([
                'file_name' => $validated['credential']
            ]);

            $holiday = Holiday::forceFill([
                'start_date' => $validated['startDate'],
                'end_date' => $validated['endDate'],
                'holiday_type_id' => $validated['holidayType'],
                'credential_id' => $credential->id,
            ]);

            Demand::forceFill([
                'date' => $holiday->created_at,
                'user_id' => $validated['user_id'],
                'holiday_id' => $holiday->id,
            ]);
            
            return redirect('holidays')->with('success','Holiday demand updated successfully');
        }
        else {
            $holiday = Holiday::forceFill([
                'start_date' => $validated['startDate'],
                'end_date' => $validated['endDate'],
                'holiday_type_id' => $validated['holidayType'],
                'credential_id' => $credential->id,
            ]);

            Demand::forceFill([
                'date' => $holiday->created_at,
                'user_id' => $validated['user_id'],
                'holiday_id' => $holiday->id,
            ]);
            
            return redirect('holidays')->with('success','Holiday demand updated successfully');
        }
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Holiday $holiday)
    {
        // Delete image
        // if (isset($holiday->credential)) {
        //     Storage::disk('public')->delete($holiday->credential);
        // }

        // We delete Holiday
        $holiday->delete();

        return redirect()->route('network');
    }
}
