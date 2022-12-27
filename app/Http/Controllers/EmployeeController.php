<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeeRequest;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('add employee');

        return view('employees.create', [
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
        $user = Employee::create([
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
        $employee = Employee::find($id);

        return view('employees.show', [
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
        $employee = Employee::find($id);

        $this->authorize('delete', $employee);

        $employee->delete();

        return redirect()->route('contacts');
    }
}
