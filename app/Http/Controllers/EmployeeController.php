<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Skill;
use App\Models\Country;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Enums\SeniorityRating;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

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
                foreach ($request->skills as $key => $skill) {
                    $employee->skills()->attach($request->skills[$key], [
                        'years' => $request->years[$key],
                        'seniority_rating' => $request->rating[$key]
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
                'employee' => $employee->load(['skills', 'country']),
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
                    foreach ($request->skills as $key => $skill) {
                        $employee->skills()->attach($request->skills[$key], [
                            'years' => $request->years[$key],
                            'seniority_rating' => $request->rating[$key]
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
            $skills = Skill::all();
            $countries = Country::all();
            $ratings = SeniorityRating::getArrayOfArrays();

            return view('employees.edit', [
                'skills' => $skills,
                'ratings' => $ratings,
                'countries' => $countries,
                'employee' => $employee->load(['skills', 'country']),
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
        $countries = Country::all();
        $ratings = SeniorityRating::getArrayOfArrays();

        return view('employees.create', [
            'skills' => $skills,
            'ratings' => $ratings,
            'countries' => $countries,
        ]);
    }

    /**
     * Delete employee from database
     *
     * @param Request $request
     * @param integer $id
     * @return View
     */
    public function destroy(Request $request, $id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            $employee->delete();
        }

        return redirect('/');
    }
}
