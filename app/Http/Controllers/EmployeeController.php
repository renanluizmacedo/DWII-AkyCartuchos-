<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreemployeesRequest;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->authorizeResource(Employee::class, 'employee');
    }

    public function index()
    {

        $employees = Employee::with('role')->get();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreemployeesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreemployeesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employees  $Employees
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $Employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employees  $Employees
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {

        $roles  =  Role::all();
        return view('employees.edit', compact(['roles', 'employee']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateemployeesRequest  $request
     * @param  \App\Models\Employees  $Employees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {

        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->role()->associate($request->role);

        $employee->save();

        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employees  $Employees
     * @return \Illuminate\Http\Response
     */
    public function showEmployeeLog()
    {

        return view('employees.showEmployeeLog');
    }
    public function destroy(Employee $employee)
    {
        //
    }
}
