<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Return all employees
     *
     * @param Request $request
     * @return View
     */
    public function index()
    {
        $employees = Employee::all();

        return view('employees.index', ['employees' => $employees]);
    }

    public function store(Request $request)
    {
        # code...
    }

    public function show(Request $request)
    {
        # code...
    }

    public function update(Request $request)
    {
        # code...
    }

    public function edit(Request $request)
    {
        # code...
    }
}
