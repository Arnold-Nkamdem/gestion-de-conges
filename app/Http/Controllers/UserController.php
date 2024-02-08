<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Position;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        $roles = Role::pluck('name','name')->all();
        $functions = Position::get();

        return view('users.index', compact('users', 'roles', 'functions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $roles = Role::pluck('name','name')->all();
        // return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation flieds
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|min:3|max:25',
            'last_name' => 'required|string|min:3|max:25',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|max:9',
            'function' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return abort(401);
        }

        $validated = $validator->validated();

        // Create user
        if ($validated['role'] == 'admin') {
            $user = User::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'],
                'password' => Hash::make('Admin@2024'),
                'position_id' => $validated['function'],
            ]);
            $user->assignRole($request->input('role'));
    
            return redirect()->route('users.index')->with('success','User created successfully');
        }
        if ($validated['role'] == 'moderator') {
            $user = User::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'],
                'password' => Hash::make('Moderator@2024'),
                'position_id' => $validated['function'],
            ]);
            $user->assignRole($request->input('role'));
    
            return redirect()->route('users.index')->with('success','User created successfully');
        }
        if ($validated['role'] == 'user') {
            $user = User::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'],
                'password' => Hash::make('User@2024'),
                'position_id' => $validated['function'],
            ]);
            $user->assignRole($request->input('role'));
    
            return redirect()->route('users.index')->with('success','User created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $role = Role::find($id);

        return view('users.index',compact('user, role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        // $userRole = $user->roles->pluck('name','name')->all();
        
        // dd($roles);

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validation flieds
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'min:3', 'max:25'],
            'last_name' => ['required', 'string', 'min:3', 'max:25'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone_number' => ['required', 'max:9', Rule::unique('users')->ignore($user->id)],
            'function' => ['required'],
            'role' => ['required'],
        ]);

        if ($validator->fails()) {
            return abort(401);
        }

        $validated = $validator->validated();
        
        // Upate user
        if ($validated['role'] == 'admin') {
            $user->forceFill([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'],
                'password' => Hash::make('Admin@2024'),
                'position_id' => $validated['function'],
            ])->save();
            DB::table('model_has_roles')->where('model_id', $user->id)->delete();
            $user->assignRole($request->input('role'));

            return redirect('users')->with('success','User updated successfully');
        }
        if ($validated['role'] == 'moderator') {
            $user->forceFill([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'],
                'password' => Hash::make('Moderator@2024'),
                'position_id' => $validated['function'],
            ])->save();
            DB::table('model_has_roles')->where('model_id', $user->id)->delete();
            $user->assignRole($request->input('role'));

            return redirect('users')->with('success','User updated successfully');
        }
        if ($validated['role'] == 'user') {
            $user->forceFill([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'],
                'password' => Hash::make('User@2024'),
                'position_id' => $validated['function'],
            ])->save();
            DB::table('model_has_roles')->where('model_id', $user->id)->delete();
            $user->assignRole($request->input('role'));

            return redirect('users')->with('success','User updated successfully');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $this->validate($request, [
    //         'role' => 'required'
    //     ]);
    
    //     $user = User::find($id);
    //     DB::table('model_has_roles')->where('model_id', $id)->delete();
    
    //     $user->assignRole($request->input('role'));
    
    //     return redirect('users')->with('success','User updated successfully');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Delete profile photo
        if (isset($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        // We delete user
        $user->delete();

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id, Request $request)
    // {
    //     User::find($id)->delete();
    //     return redirect('users')->with('success','User deleted successfully');
    // }
}
