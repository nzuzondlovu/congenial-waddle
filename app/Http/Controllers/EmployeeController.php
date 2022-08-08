<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Skill;

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
        $employees = Employee::paginate(10);

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

    /**
     * Show employee details
     *
     * @param Request $request
     * @param integer $id
     * @return View
     */
    public function show(Request $request, $id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            return view('employees.show', [
                'employee' => $employee,
                'skills' => $employee->skills,
            ]);
        }

        return redirect('/');
    }

    /**
     * Update the employee details
     *
     * @param UpdateEmployeeRequest $request
     * @param integer $id
     * @return View
     */
    public function update(UpdateEmployeeRequest $request, $id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            try {

                $employee->city = $request->city;
                $employee->country_id = $request->country;
                $employee->last_name = $request->last_name;
                $employee->first_name = $request->first_name;
                $employee->postal_code = $request->postal_code;
                $employee->date_of_birth = $request->date_of_birth;
                $employee->email_address = $request->email_address;
                $employee->contact_number = $request->contact_number;
                $employee->street_address = $request->street_address;
                $employee->save();

                if (!empty($request->skills)) {
                    $employee->skills()->detach();
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
        }

        return redirect('/');
    }

    /**
     * Edit employee
     *
     * @param Request $request
     * @param integer $id
     * @return View
     */
    public function edit(Request $request, $id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            return view('employees.edit', [
                'employee' => $employee,
                'skills' => $employee->skills,
            ]);
        }

        return redirect('/');
    }

    /**
     * Create employee view
     *
     * @param Request $request
     * @return View
     */
    public function create(Request $request)
    {
        $skills = Skill::all();

        return view('employees.create', ['skills' => $skills]);
    }
}
