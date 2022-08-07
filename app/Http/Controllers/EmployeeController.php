<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeeRequest;

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

    /**
     * Store new employee
     *
     * @param StoreEmployeeRequest $request
     * @return View
     */
    public function store(StoreEmployeeRequest $request)
    {
        try {
            $employee = Employee::create([
                'city' => $request->city,
                'country_id' => $request->country,
                'last_name' => $request->last_name,
                'first_name' => $request->first_name,
                'postal_code' => $request->postal_code,
                'date_of_birth' => $request->date_of_birth,
                'email_address' => $request->email_address,
                'contact_number' => $request->contact_number,
                'street_address' => $request->street_address,
            ]);

            if (!empty($request->skills)) {
                foreach ($request->skills as $skill) {
                    $employee->skills()->attach($skill['skill_id'], [
                        'years' => $skill['years'],
                        'seniority_rating' => $skill['rating']
                    ]);
                }
            }

            return redirect('/employees/' . $employee->id);
        } catch (Exception $e) {
            report($e);
        }

        return redirect()
            ->back()
            ->withInput();
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
