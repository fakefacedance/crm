<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class StaffController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('add employee');

        return view('staff.create', [
            'roles' => Role::all()->pluck('name'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEmployeeRequest $request)
    {        
        $user = Staff::create([
            'full_name' => $request->full_name,
            'position' => $request->position,
            'phone_number' => $request->phone_number,            
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now()
        ]);
        $user->assignRole($request->role);

        return redirect()->route('contacts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Staff::find($id);

        return view('staff.show', [
            'employee' => $employee,
            'tasks' => $employee->tasksAssignedTo()->paginate(10),
            'deals' => $employee->deals()->paginate(8)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Staff::find($id);

        $this->authorize('delete', $employee);

        $employee->delete();

        return redirect()->route('contacts');
    }
}
